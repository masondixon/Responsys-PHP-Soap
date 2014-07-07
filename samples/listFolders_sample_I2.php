<?php

include '../bootstrap.php';

try
{

	$instance = new interact();
	
	$instance->debug == true;
	
	$instance->intitializeSoapClient( 'https://ws2.responsys.net/webservices/wsdl/ResponsysWS_Level1.wsdl', 
									  'https://ws2.responsys.net/webservices/services/ResponsysWSService' );
	
	if ( $instance->login( 'masonTest', 'XixXcbF30j' ) )
	{
		
		$listFolders_object = new listFolders();
		$listFolders_result = $instance->execute( $listFolders_object );
		
		
		foreach( $listFolders_result->result as $folder )
		{
			echo $folder->name . "\n";
		}
		
		
		$instance->logout();
		
	}
	else
	{
		die( "Login failed, no reason to go on..." );
	}
	
}
catch( SoapFault $fault )
{
	print_r( $fault );
}
catch( Exception $exception )
{
	print_r( $exception );
}