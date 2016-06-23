<?php

class interact
{		
	
	CONST SOAP_NS         = 'ws.rsys.com';
	CONST SOAP_NS_URSA    = 'ws57.responsys';//
	CONST SOAP_URI_URSA   = 'urn:ws57.responsys';
	CONST SOAP_SESS       = 'SessionHeader';
	CONST AUTH_SOAP_SESS  = 'AuthSessionHeader';
	CONST SOAP_JID        = 'JSESSIONID';
	
	CONST SOAP_ERROR_CLIENT    = " Failed to create soap client ";
	CONST SOAP_ERROR_LOGIN     = " API Login failed, please check credentials and verify wsdl values. ";
	CONST SOAP_ERROR_HEADER    = " An error occurred during soap client creation - check soap header and cookie ";
	CONST SOAP_ERROR_CALL_NAME = " Interact_API requires a soap call name in order to run API. " ;
	
 	protected $endPoint,
 			  $wsdl,
 			  $uri,
 			  $soapNameSpace,
 			  $sessionId,
 			  $jsessionId,
 			  $apiCallName,
 			  $apiCallParamData,
 			  $params;
 	
 	public static $isLoggedIn = false,
 				  $soapClient;
 	
	public $result,
		   $debug = false;
	
	function __construct(){}
	
	/**
	 * Constructor responsible for creating PHP dynamic soap client
	 * Will throw an exception if there is a problem...
	 * @param unknown $pod_number WILL BE A 2 or 5 depending on the account location ws5.responsys.net* or ws2.responsys.net*
	 * @throws Exception
	 */
	public function intitializeSoapClient( $wsdl, $end_point )
	{
		$this->setSoapParams( $wsdl, $end_point  );
	
		if( !$this->setSoapClient() )
			throw new Exception(" *** Soap Client Init Failed *** ");
	}

	private function setSoapParams( $wsdl, $end_point )
	{
		$this->wsdl          = $wsdl;
		$this->endPoint      = $end_point;
		$this->uri           = ( stristr("ws3", $wsdl) || stristr("ws4", $wsdl) ) ? self::SOAP_URI_URSA : null;
		$this->soapNameSpace = ( stristr("ws3", $wsdl) || stristr("ws4", $wsdl) ) ? self::SOAP_NS_URSA : self::SOAP_NS;
	}
	
	private function setSoapHeaders( $authId = null )
	{
		$result = false;

		$nameSpace = self::SOAP_NS;
		
		$headerArray   = array();

		$soap_header_name = isset( $authId ) ? 'authSessionId' : 'sessionId';
		$this->sessionId  = isset( $authId ) ? $authId : $this->sessionId;
			
		$sessionId     = array( $soap_header_name => new SoapVar( $this->sessionId, XSD_STRING, null, null, null, $this->soapNameSpace ));
		$sessionHeader = new SoapVar($sessionId, SOAP_ENC_OBJECT);
		$headerArray[] = new SoapHeader( $this->soapNameSpace, self::SOAP_SESS, $sessionHeader);
		
		
		// nullify headers here
		self::$soapClient->__setSoapHeaders();
		
		// set new values
		if ( self::$soapClient->__setSoapHeaders( $headerArray ) )
			$result = true;
		
		return $result;
	}

	private function setSessionCookie()
	{
		$result = false;
		
		$jsessionId = self::$soapClient->_cookies[ self::SOAP_JID ][ 0 ];
		
		if( $jsessionId )
		{
			self::$soapClient->__setCookie( self::SOAP_JID, $jsessionId );
			$result = true;
		}
		
		return $result;
	}
	
	private function setSoapClient()
	{	
		$result = false;
		
		$soapClientParams = array(   'location'   => $this->endPoint,
									 'uri'        => $this->uri,
                                     'trace'      => TRUE,
									 'connection_timeout' => 500000,
				                     'keep_alive' => TRUE,
				                     //'ssl_method' => SOAP_SSL_METHOD_SSLv3,
                                     //'proxy_host' => "127.0.0.1",
                                     //'proxy_port' => '8888',
				     				 'cache_wsdl' => WSDL_CACHE_NONE, ) ;

		self::$soapClient = new SoapClient( $this->wsdl, $soapClientParams );
		
		if( self::$soapClient instanceof SoapClient)
		{
			$result = true;
		}
		
		return $result;
	}
	
	
	private function print_xml()
	{	
		if( $this->debug == true )
		{
			echo " ************************* \n";
			echo "REQUEST HEADERS: \n";
			echo $this::$soapClient->__getLastRequestHeaders();
			echo " ************************* \n\n";
			
			echo " ************************* \n";
			echo "REQUEST: \n";
			echo $this::$soapClient->__getLastRequest();
			echo " ************************* \n\n";
			
			echo " ************************* \n";
			echo " RESPONSE HEADERS: \n";
			echo $this::$soapClient->__getLastResponseHeaders();
			echo " ************************* \n\n";
			
			echo " ************************* \n";
			echo " RESPONSE: \n";
			echo $this::$soapClient->__getLastResponse();
			echo " ************************* \n\n";

		}
	}
	
	/**
	 * The soapClient call depends on class naming convention
	 * The get_class variable name will be the actual soapRequest method name
	 */
	public function execute( $instance )
	{
		$result = null;
		
		try
		{
			$result =  self::$soapClient->{ get_class( $instance ) }( $instance->params );
			$this->print_xml();
		}
		catch( SoapFault $fault )
		{
			echo " *** SOAPFAULT *** \n";
			$this->print_xml();
		
		}
		catch( Exception $exception )
		{
			echo " *** EXCEPTION *** \n";
			echo $exception->getMessage();
		}
			
		//if( $this->debug == true )
		//	print_r( $result );
		
		return $result;
	}
	
	/**
	 * Include all native objects for calls
	 */
	private function loadObjects()
	{
		// Include the call type classes
		$objects = glob( 'objects/*.php');
		
		foreach( $objects as $object )
		{
			echo "Including object ( file/class ): " . $object . "\n";
			include( $object );
		}
	}
	
	/**
	 * 
	 * @param unknown $username
	 * @param unknown $password
	 * @throws Exception
	 * @return boolean
	 * 
	 * Wrapper for login call, that persists session for you
	 * The sessionId in the soap header and jsessionId cookie need to be persisted in order for subsequent calls to work
	 */
	public function login( $username, $password )
	{
		$result = false;
	
		if( !self::$isLoggedIn )
		{
			$loginParamArray = array( 'username' => $username,'password' => $password );
				
			$sessionDetails = self::$soapClient->login( $loginParamArray );
				
			if( $sessionDetails )
			{
				$this->sessionId = $sessionDetails->result->sessionId;
	
				/**
				 * This part is critical to the API session persistence piece..
				 */
				if( !$this->setSoapHeaders() || !$this->setSessionCookie() )
				{
					throw new Exception( self::SOAP_ERROR_HEADER );
				}
				else
				{	
					echo "Logged in -> session_id : " . $this->sessionId . "\n";
					self::$isLoggedIn = true;
					$result = true;
					
					if( $this->debug == true )
						$this->print_xml();
				}
			}
		}
	
		return $result;
	}
	
	
	/**
	 * Wrapper for logout
	 * There is a max concurrent session allowance which if exceeded, will lock out the api user
	 * Its IMPORTANT to logout in other words
	 */
	public function logout()
	{
		$result = false;
	
		if( self::$isLoggedIn )
		{
			$loggedOut = self::$soapClient->logout();
		
			if( $this->debug == true )
				$this->print_xml();
			
			if( $loggedOut->result == 1 )
			{
				self::$isLoggedIn = false;
				self::$soapClient = null;
				echo "Logged Out from sessionId : " . $this->sessionId . "\n";
				$result = true;
			}
		}
	
		return $result;
	}
	

	public function getSoapFunctions()
	{
		$functions = self::$soapClient->__getFunctions();
		
		return $functions;
	}
	
	
	
	/** START LOGINWITHCERTIFICATE FUNCTIONS
	 * These functions deal exclusively with the loginWithCertificate call 
	 * The call is meant to add extra security to the login process, but actually is more trouble than its worth
	 * Regular login with password over ssh is the main login method used by most consumers
	 */
	
	//FUNCTION THAT RECURSIVELY PACKS ARRAY INTO BINARY STRING
	private function packer( $array )
	{
		return call_user_func_array('pack', array_merge(array('C*'), $array ));
	}
	
	/**
	 * Returns boolean
	 * The auth session id and challenges will be accessible in $this->result property
	 * 
	 * This function is called first to receive a temporary session for the actual login call
	 * Also verifies that user exists and is configured for login with certificate process on the Responsys side
	 */
	private function authServer( $user, $challenge, $wsdl, $endpoint)
	{
	
		$result = null;
		
		$this->setSoapParams( $wsdl, $endpoint );
	
		if( $this->setSoapClient() )
		{
			$instance = new authenticateServer($user, $challenge);
			$result = $this->execute( $instance );
		}
		else
		{
			die( self::SOAP_ERROR_CLIENT );
		}
	
		return $result;
	
	}
	
	/**
	 * 
	 * @param string $user
	 * @param string $byte_array_challenge
	 * @param string $wsdl
	 * @param string $endpoint
	 * @param string $responsys_public_cert_path
	 * @param string $client_private_key_path
	 */
	public function loginWithCertificate( $user, $byte_array_challenge, $wsdl, $endpoint, $responsys_public_cert_path, $client_private_key_path)
	{
	
		// RESPONSYS PUBLIC CERT
		$responsys_certificate_file = file_get_contents( $responsys_public_cert_path );
	
		// PRIVATE KEY REQUIRED FOR ENCRYPTING SERVER CHALLENGE - obtained from openssl cert & key creation process
		$mdixon_certificate_file = file_get_contents( $client_private_key_path );
	
		$byte_array = array();
		$container  = array();
		$container2 = array();
		$container3 = array();
	
		// Convert to integer for java
		$len = strlen( $byte_array_challenge );
		for( $i = 0; $i < $len; $i++ )
		{
			$byte_array[] = ord( $byte_array_challenge[ $i ]);
		}
	
		// Run authServer call to verify user and get a temporary sessionId for login call
		$result = $this->authServer( $user, $byte_array, $wsdl, $endpoint );
		
		//print_r( $result );
		
		$authId             = $result->result->authSessionId;
		$encServerChallenge = $result->result->encryptedClientChallenge;
		$serverChallenge    = $result->result->serverChallenge;

		// Hack to deal with null returns in challenge strings ( weak! )
		// The trick is setting the null value to 128 - which should actually be out of range for java since it uses -128 through 127 but it works...
		foreach ( $encServerChallenge as $key => $val )
		{
			$val = trim($val);
	
			if( isset( $val ) && $val!== null && $val !== "" )
			{
				$container[] = $val;
			}
			else
			{
				$container[] = 128;
			}
		}
	
	
		// Now we have to decrypt the binary string
		$decryptMe = $this->packer( $container );
	
		// USE RESP CERT TO DECYRPT THE VALUE AND DIFF ON ORIGINAL STRING VALUE !!!
		// GET A X509 INSTANCE, THEN GET THE PUBLIC KEY FOR openssl_public_decrypt
		$x509 = openssl_x509_read( $responsys_certificate_file );
		openssl_x509_export($x509, $newX509 );
		$pubKey = openssl_get_publickey( $newX509 );
	
		if ( openssl_public_decrypt( $decryptMe, $decrypted, $pubKey, OPENSSL_PKCS1_PADDING ) )
		{
			$data = $decrypted;
		}
		else
		{
			echo openssl_error_string();
			die( "Failed to decrypt the challenge - exiting" );
		}
	
	
		// Compare the original string to the decrypted data string
		// If this matches then the decryption logic is proper, and we proceed to login call
		if( $byte_array_challenge == $data)
		{
			// Get the private key for encrypting the return
			$private_key = openssl_get_privatekey( $mdixon_certificate_file );
	
			foreach( $serverChallenge as $j => $b )
			{
				$val2 = trim($b);
	
				if( isset( $val2 ) && $val2!== null && $val2 !== "" )
				{
					$container2[] = $val2;
				}
				else
				{
					$container2[] = 128;
				}
			}
	
			$encryptMe = $this->packer( $container2 );
	
			if ( !openssl_private_encrypt($encryptMe, $encryptedData, $private_key, OPENSSL_PKCS1_PADDING ) )
			{
				die( "Failed to Encrypt data with Private Key - exiting");
			}
	
			// Now we have to unpack data which converts unsigned encrypted data to signed byte type
			// to play nice with java signed byte type
			$unpackedData = unpack('c*', $encryptedData );
	
			// Now iterate through bytes, and set the 128 values to null since API allows / sends nulls
			foreach ( $unpackedData as $m => $d )
			{
				$val3 = trim( $d );
				if( $val3 == 128 )
				{
					$container3[] = null;
				}
				else
				{
					$container3[] = $val3;
				}
			}
	
			// Now we have all of the parts, set the authId as the session id for the login call, and send in the prepared encrypted server challenge
			// If all goes well we will get a sessionId in the result of the upcoming call.
			$this->setSoapHeaders( $authId );
			$this->setSessionCookie();
			
			$loginWithCertObj = new loginWithCertificate( $container3 );
	
			$result = $this->execute( $loginWithCertObj );

			if ($result) {
				$this->sessionId = $result->result->sessionId;
				if( !$this->setSoapHeaders() || !$this->setSessionCookie() )
				{
					throw new Exception( self::SOAP_ERROR_HEADER );
				}
			}

			//print_r( $result );
			return $result;
	
		}
		else
		{
			die("Problem during handshake - exiting");
		}
	}
	
}




?>
