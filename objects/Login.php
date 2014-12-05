<?php

class authenticateServer
{
	public $params;

	function __construct( $userName, $byteArray )
	{
		$this->params['username'] = $userName;
		$this->params['clientChallenge'] = $byteArray;
	}
}

class loginWithCertificate
{
	public $params;
	
	function __construct( $encryptedServerChallenge )
	{
		$this->params['encryptedServerChallenge'] = $encryptedServerChallenge;
	}
}

?>