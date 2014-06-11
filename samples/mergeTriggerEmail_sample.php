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
		
		$merge_trigger_obj = new mergeTriggerEmail();
		
		// Print out XML transmissions - nice to have!
		$merge_trigger_obj->debug = true;
		
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
	
		$merge_trigger_obj->setMergeRuleParam( $rule );
		
		$interact_object = new InteractObject();
		$interact_object->setFolderName("Mason");
		$interact_object->setObjectName("masonCampaign1");
		
		$merge_trigger_obj->setCampaignParam($interact_object);
	
		$fields   = array('EMAIL_ADDRESS_', 'CITY_');
		$values[] = array("mason.dixon@oracle.com", "mike");
		$values[] = array("email@address.com", "tony");
		
		foreach( $values as $array )
		{
			$record = new Record();
			$record->setFieldValues( $array );
			$records[] = $record;
		}
	
		$transientDataArray[] = array("FIRSTNAME" => "Mason");
		$transientDataArray[] = array("FIRSTNAME" => "Sam");
		
		for( $tmp = 0; $tmp < count( $transientDataArray ); $tmp++ )
		{
			$optionalDataArray = null;
		
			foreach( $transientDataArray[ $tmp ] as $name => $value )
			{
				$optionalData = new optionalData();
				$optionalData->name  = $name;
				$optionalData->value = $value;
		
				$optionalDataArray[] = $optionalData;
			}
		
			$triggerDataArray[] = $optionalDataArray;
		}
		
		$merge_trigger_obj->setRecordDataParam( $fields, $values );
		
		$merge_trigger_obj->setTriggerDataParam($triggerDataArray);
	
		$result = $instance->execute( $merge_trigger_obj );
		
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
