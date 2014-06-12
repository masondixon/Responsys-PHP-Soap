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
		
		$rule = new ListMergeRule();
		
		$status = new DefaultPermissionStatus();
		$status->defaultPermissionStatus = DefaultPermissionStatus::OPT_IN;
		$rule->setDefaultPermissionStatus( $status );
		
		$rule->setInsertOnNoMatch( true );
		
		$match1 = new MatchColumn();
		$match1->matchColumn = $match1::EMAIL;
		$rule->setMatchColumn1( $match1 );
		
		$match_op = new MatchOperator();
		$match_op->matchOperator = $match_op::_NONE_;
		$rule->setMatchOperator( $match_op );
		
		$reject_channel = new RejectChannel();
		$reject_channel->rejectChannel = $reject_channel::EMAIL;
		$rule->setRejectChannel( $reject_channel );
		
		$update = new UpdateOnMatch();
		$update->updateOnMatch = $update::REPLACE;
		$rule->setUpdateOnMatch( $update );
		
		$merge_obj->setMergeRuleParam($rule);
		
		$fieldNames = array( "EMAIL_ADDRESS_", "CITY_" );
		
		$record_1 = new Record();
		$record_1->setFieldValues( array( "mdixon@responsys.com", "mallard") );
		
		$record_2 = new Record();
		$record_2->setFieldValues( array( "mdixon7@responsys.com", "mallard") );
		
		$records[] = $record_1;
		$records[] = $record_2;
		
		$merge_obj->setRecordDataParam( $fieldNames, $records );
		
		$merge_result_ids = $instance->execute( $merge_obj );
		
		/*
		 * merge call end
		 */
		
		/*
		 * trigger event call begin
		 */
		
		$custom_obj = new triggerCustomEvent();
		
		$custom_event = new CustomEvent();
		$custom_event->setEventName("Welcome");
		
		$custom_obj->setCustomEventParam( $custom_event );
		
		$identifier = new RecipientIdentifier();
		$identifier->setValue( RecipientIdentifier::RECIPIENT_ID );
		
		$transientDataArray[] = array( "FIRST_NAME" => "Sam" );
		$transientDataArray[] = array( "LAST_NAME" => "Capote" );
		
		/*
		 * Obtain recipient id from merge call result!
		 */
		foreach( $merge_result_ids->recipientResult as $result )
		{
			$recipient_ids[] = $result->recipientId;
		}
		
		$custom_obj->setRecipientDataParam( $folder, $list, $identifier, $recipient_ids, $transientDataArray );
		
		$trigger_result = $instance->execute( $custom_obj );
		
		//print_r( $trigger_result );
		
		/*
		 * trigger event call end
		*/
		
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