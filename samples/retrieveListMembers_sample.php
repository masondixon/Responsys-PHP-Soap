<?php

include '../bootstrap.php';

try
{

	$instance = new interact();
	
	$instance->debug = true;
	
	$instance->intitializeSoapClient( $config_file['location']['wsdl'], 
									  $config_file['location']['endpoint']  );
	
	if ( $instance->login( $config_file['auth_regular']['login'], $config_file['auth_regular']['pass'] ) )
	{
		
		$retrieve_obj = new retrieveListMembers();
		
		$int_obj = new InteractObject();	
		$int_obj->setFolderName("Mason");
		$int_obj->setObjectName("masonList1");
		
		$retrieve_obj->setFieldListParam( array( "RIID_", "EMAIL_ADDRESS_", "FIRST_NAME" ) );
		$retrieve_obj->setIdsToRetrieve( array( "mdixon7@gmail.com") );
		$retrieve_obj->setListParam( $int_obj );
		$retrieve_obj->setQueryColumn( QueryColumn::EMAIL2 );
		
		$results = $instance->execute( $retrieve_obj );
		
		// do something with results?
		print_r( $results );
		
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
