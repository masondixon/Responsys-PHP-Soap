<?php

include '../bootstrap.php';

try
{

	$folder = "Mason";
	$list   = "masonList1";

	$instance = new interact();

	$instance->debug = true;

	$instance->intitializeSoapClient( $config_file['location']['wsdl'],
		                              $config_file['location']['endpoint']  );

	if ( $instance->login( $config_file['auth_regular']['login'], $config_file['auth_regular']['pass'] ) )
	{

		/*
		 * merge call begin
		*/
		$merge_obj = new mergeListMembersRIID();

		$interact_object = new InteractObject();
		$interact_object->setFolderName( $folder );
		$interact_object->setObjectName( $list );

		$merge_obj->setListParam( $interact_object );

		$status = new DefaultPermissionStatus();
		$status->defaultPermissionStatus = DefaultPermissionStatus::OPT_IN;

		$match1 = new MatchColumn();
		$match1->matchColumn = $match1::EMAIL;
		
		$match_op = new MatchOperator();
		$match_op->matchOperator = $match_op::_NONE_;
		
		$reject_channel = new RejectChannel();
		$reject_channel->rejectChannel = $reject_channel::EMAIL;
		
		$update = new UpdateOnMatch();
		$update->updateOnMatch = $update::REPLACE;
		
		$rule = new ListMergeRule();
		$rule->setDefaultPermissionStatus( $status );
		$rule->setInsertOnNoMatch( true );
		$rule->setMatchColumn1( $match1 );
		$rule->setMatchOperator( $match_op );
		$rule->setRejectChannel( $reject_channel );
		$rule->setUpdateOnMatch( $update );

		$merge_obj->setMergeRuleParam( $rule );

		$fieldNames = array( "EMAIL_ADDRESS_", "CITY_" );

		$record_1 = new Record();
		$record_1->setFieldValues( array( "mdixon@responsys.com", "martinez") );

		$records[] = $record_1;

		$merge_obj->setRecordDataParam( $fieldNames, $records );
		$merge_result_ids = $instance->execute( $merge_obj );
		
		// Now we make a secondary merge call to opt out the newly inserted record....
		// for brevity i will reuse some of the variables above
		
		$fieldNames2 = array( "EMAIL_ADDRESS_", "EMAIL_PERMISSION_STATUS_", "CITY_" );

		$record_2 = new Record();
		$record_2->setFieldValues( array( "mdixon@responsys.com", "OPTOUT") );
		$records2[] = $record_2;
		
		$merge_obj->setRecordDataParam( $fieldNames2, $records2 );
		$merge_result_ids_2 = $instance->execute( $merge_obj );
		
		// Now lets use retrieveListMembers to confirm that the change took place
		$retrieve_obj = new retrieveListMembers();
		$retrieve_obj->setFieldListParam( $fieldNames2 );
		$retrieve_obj->setIdsToRetrieve( array( "mdixon@responsys.com" ) ); // shortcut for mdixon@resp
		$retrieve_obj->setListParam( $interact_object );
		$retrieve_obj->setQueryColumn( "EMAIL_ADDRESS" );
		
		$retrieve_results = $instance->execute( $retrieve_obj );

		$instance->logout();

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