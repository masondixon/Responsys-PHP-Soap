<?php

include '../bootstrap.php';

try
{
	
	$login = "some_login";
	$pass  = "some_pass";
	
	$folder = "Mark_J";
	$list   = "MJlist4";

	$instance = new interact();

	$instance->debug = true;

	$instance->intitializeSoapClient( $config_file['location']['wsdl'],
								      $config_file['location']['endpoint']  );

	if ( $instance->login( $login, $pass ) )
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
		
		$fieldNames = array( "EMAIL_ADDRESS_", "CUSTOMER_ID_" );
		
		$record_1 = new Record();
		$record_1->setFieldValues( array( "scooby@oracle.com", "TEST_MDIXON") );
		
		$record_2 = new Record();
		$record_2->setFieldValues( array( "wilma@gmail.com", "TEST_MDIXON") );
		
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

		$custom_event->setEventName("DEV_SUPP_TEST");
		
		$custom_obj->setCustomEventParam( $custom_event );
		
		$identifier = new RecipientIdentifier();
		$identifier->setValue( RecipientIdentifier::RECIPIENT_ID );
		
		
		/*
		 * Transient data is optionalData in Responsys Jargon
		 * These name value pairs can be used to display in the 
		 * campaign body and/or evaluated by program logic as ETV or "ENTRY TRACKING VARIABLES"
		 * 
		 */
		$transientData = array( 'FIRST_NAME' => 'Scooby',
								'LAST_NAME'  => 'Doo' );
		
		$transientData1 = array( 'FIRST_NAME' => 'Wilma',
								 'LAST_NAME'  => 'SmartyPants' );
		
		$transientDataArray[] = $transientData;
		$transientDataArray[] = $transientData1;
		
		
		/*
		 * Obtain recipient id from merge call result!
		 */
	
		
		if( is_array( $merge_result_ids->recipientResult ) )
		{
			foreach( $merge_result_ids->recipientResult as $result )
			{
		
				print_r($result);
				foreach( $result as $name => $value )
				{
					if( $name == 'recipientId' )
					{
						$recipient_ids[] = $value;
					}
				}
			}
		}
		elseif( is_object( $merge_result_ids->recipientResult ) )
		{
			$recipient_ids[] = $merge_result_ids->recipientResult->recipientId;
		}
		else 
		{
			throw new Exception("Merge result was an unexpected format, its not safe to trigger custom event!");
		}

		
		$custom_obj->setRecipientDataParam( $folder, $list, $identifier, $recipient_ids, $transientDataArray );
		
		$trigger_result = $instance->execute( $custom_obj );

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
