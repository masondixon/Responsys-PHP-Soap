<?php     

include '../bootstrap.php';

$instance = new interact();

// print out the XML of the requests and responses!
$instance->debug = true;

$instance->intitializeSoapClient( $config_file['location']['wsdl'], $config_file['location']['endpoint']  );

if ( $instance->login( $config_file['auth_regular']['login'], $config_file['auth_regular']['pass'] ) )
{
	
	$table_object = new InteractObject();
	$table_object->setFolderName("Mason");
	$table_object->setObjectName("temp_supp_table");

	$field_details = array( array('fieldName' => 'Email_address', 'fieldType' => 'STR500', 'custom' => false, 'dataExtractionKey' => true ),
							array('fieldName' => 'age',           'fieldType' => 'STR500', 'custom' => false, 'dataExtractionKey' => false ), 
							array('fieldName' => 'city',          'fieldType' => 'STR500', 'custom' => false, 'dataExtractionKey' => false ), );
	
	$primary_keys = array( 'Email_address' );
	
	$create_table_obj = new createTableWithPK();
	$create_table_obj->setFieldsParam($field_details);
	$create_table_obj->setPrimaryKeysParam($primary_keys);
	$create_table_obj->setTableParam($table_object);
	
	$response = $instance->execute( $create_table_obj );
	
	$instance->logout();
	
}