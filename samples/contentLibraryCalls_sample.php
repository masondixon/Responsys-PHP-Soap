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
	$content_folder_file     = 'randomFile_' . rand( 1, 100 ) . '.htm';
	
	$some_random_html        = '<html><header><title>Masons api example</title></header><body><div><h1>Hello World!</h1></div><div>Goodbye cruel world</div></body></html>';
	
	
	// sample of create document call
	$create_document_obj = new createDocument();
	$int_obj = new InteractObject();
	$int_obj->setFolderName( $content_folder_location );
	$int_obj->setObjectName( $content_folder_file );
	
	$create_document_obj->setDocumentParam( $int_obj );
	$create_document_obj->setContentParam( $some_random_html );
	$create_document_obj->setEncodingParameter( $create_document_obj->char_sets[10] );
	

	$create_doc_result = $instance->execute( $create_document_obj );

	
	// sample of setDocumentContent
	$set_content_obj = new setDocumentContent();
	
	$int_obj = new InteractObject();
	$int_obj->setFolderName( $content_folder_location );
	$int_obj->setObjectName( $content_folder_file );
	
	$set_content_obj->setDocumentParam( $int_obj );
	$set_content_obj->setContentParam( $some_random_html );
	
	$set_document_response = $instance->execute( $set_content_obj );
	
	// sample of getDocumentContent
	$get_content_obj = new getDocumentContent();
	
	$folder_location = $content_folder_location;
	$object_name     = $content_folder_file;
	
	$get_content_obj->setDocumentParam( $int_obj );
	
	$result = $instance->execute( $get_content_obj );
	
	print_r( $result );
	
	$set_document_images_obj = new setDocumentImages();
	
	$set_document_images_obj->setDocumentParam( $int_obj );
	
	$image_1_name = "random_pic1.jpg";
	$image_2_name = "random_pic2.jpg";
	
	$image_1 = file_get_contents('pic1.jpg');
	$image_2 = file_get_contents('pic2.jpg');
	
	$image_array = array();
	
	$imgData_obj_1 = new ImageData();
	$imgData_obj_1->setImage( $image_1 );
	$imgData_obj_1->setImageName( $image_1_name );
	
	$imgData_obj_2 = new ImageData();
	$imgData_obj_2->setImage( $image_2 );
	$imgData_obj_2->setImageName( $image_2_name );
	
	$image_array[] = $imgData_obj_1;
	$image_array[] = $imgData_obj_2;
	
	$set_document_images_obj->setImageDataParam( $image_array );
	
	$set_images_response = $instance->execute( $set_document_images_obj );
	
	$instance->logout();
}
