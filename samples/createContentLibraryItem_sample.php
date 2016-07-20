<?php

include '../bootstrap.php';

$instance = new interact();

// print out the XML of the requests and responses!
$instance->debug = true;

$instance->intitializeSoapClient( $config_file['location']['wsdl'], 
								  $config_file['location']['endpoint']  );

if ( $instance->login( $config_file['auth_content_library']['login'], $config_file['auth_content_library']['pass'] ) )
{
	// init some vars - these are pre-existing objects in my test account
	$content_folder_location = '/contentlibrary/1_mason';
	
	$int_obj = new InteractObject();
	$int_obj->setFolderName( $content_folder_location );
	$int_obj->setObjectName( "some_mason_pic.jpg" );
	
	$create_cl_item_obj = new createContentLibraryItem();
	$create_cl_item_obj->setLocationParam( $int_obj );
	$create_cl_item_obj->setTypeParam('jpg');
	
	$image_data = file_get_contents('pic1.jpg');

	$item = new ItemData();
	$item->setItem( $image_data );
	
	$create_cl_item_obj->setItemDataParam( $item );
	
	$response = $instance->execute( $create_cl_item_obj );
	
	$instance->logout();
	
	return $response;
}
