<?php

include '../bootstrap.php';

try
{

	$instance = new interact();
	
	$instance->debug == true;
	
	$instance->intitializeSoapClient( $config_file['location']['wsdl'], 
									  $config_file['location']['endpoint']  );
	
	if ( $instance->login( $config_file['auth_regular']['login'], $config_file['auth_regular']['pass'] ) )
	{
		
		$listFolders_object = new listFolders();
		$listFolders_result = $instance->execute( $listFolders_object );
		
		/*
		foreach( $listFolders_result->result as $folder )
		{
			echo $folder->name . "\n";
		}
		*/
		
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