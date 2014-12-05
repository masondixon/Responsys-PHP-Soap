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

	$fields  = array( 'EMAIL_ADDRESS',  'AGE', 'CITY', 'DATE_MASON' );
	$record_data = array( 'mason.dixon@oracle.com', 'somestring', 'SanBruno', '2014-08-25T02:00:00.000-08:00' );
	$record = new Record();
	$record->setFieldValues( $record_data );
	

	$merge_table_obj = new mergeTableRecordsWithPK();
	$merge_table_obj->setInsertOnNoMatchParam( true );
	$merge_table_obj->setUpdateOnMatch( UpdateOnMatch::REPLACE );
	$merge_table_obj->setTableParam($table_object);
	
	$records[] = $record;
	
	$recordData = new RecordData();
	$recordData->setFieldNames( $fields );
	$recordData->setRecords( $records );
	
	$merge_table_obj->setRecordDataParam( $recordData );
	
	print_r( $merge_table_obj );
	
	$response = $instance->execute( $merge_table_obj );
	
	$instance->logout();
	
}