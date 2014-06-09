<?php

class getLaunchStatus extends interact
{
	public $params = array( 'launchIds' => null );

	public function setLaunchIdsParam( array $launch_ids )
	{
		$this->params['launchIds'] = $launch_ids;
	}

}

class launchCampaign extends interact
{
	public $params = array( 'campaign'           => null,
							'proofLaunchOptions' => null,
							'launchPreferences'  => null );
	
	public function setCampaignParam( InteractObject $campaign_object )
	{
		$this->params['campaign'] = $campaign_object;
	}
	
	public function setProofLaunchOptions( ProofLaunchOptions $options )
	{
		$this->params['proofLaunchOptions'] = $options;
	}
	
	public function setLaunchPreferences( LaunchPreferences $preferences )
	{
		$this->params['launchPreferences'] = $preferences;
	}
	
}

class mergeTriggerEmail extends interact
{

	public $params = array( 'recordData'  => array( 'fieldNames' => null, 'records' => null ),
							'mergeRule'   => null,
							'campaign'    => null,
							'triggerData' => null );
	
	public function setMergeRuleParam( ListMergeRule $rule )
	{
		$this->params['mergeRule'] = $rule;
	}
	
	public function setRecordDataParam( array $fieldNames, array $records )
	{
		$this->params['recordData']['fieldNames'] = $fieldNames;
		$this->params['recordData']['records'] = $records;
	}
	
	public function setCampaignParam( InteractObject $campaign_object )
	{
		$this->params['campaign'] = $campaign_object;
	}
	
	public function setTriggerDataParam( array $trigger_data )
	{
		$this->params['triggerData'] = $trigger_data;
	}
	
}


class scheduleCampaignLaunch extends interact
{
	public $params = array( 'campaign' => null,
							'proofLaunchOptions' => null,
							'launchPreferences'  => null,
							'scheduleDate' => null );

	public function setCampaignParam( InteractObject $campaign_object )
	{
		$this->params['campaign'] = $campaign_object;
	}

	public function setProofLaunchOptionsParam( ProofLaunchOptions $options )
	{
		$this->params['proofLaunchOptions'] = $options;
	}

	public function setLaunchPreferencesParam( LaunchPreferences $preferences )
	{
		$this->params['launchPreferences'] = $preferences;
	}
	
	public function setScheduleDateParams( $date_time )
	{
		$time = strtotime( $date_time );
		$this->params['scheduleDate'] = date( "Y-m-d\TH:i:s", $time );
	}
}

/**
 * This creates an entry into a program, via custom event name or id mapping
 * Remember that entry variables must be passed in the optional data tags!
 *
 */
class triggerCustomEvent extends interact
{	
	
	public $params = array( 'customEvent' => null, 'recipientData' => null );
	
	public function setCustomEventParam( CustomEvent $event )
	{
		$this->params[ 'customEvent'] = $event;
	}
	
	public function setRecipientDataParam( InteractObject $listName, RecipientIdentifier $recipientIdentifier, array $recipient_ids, array $transientData  )
	{
		$recipientDataArray = array();
		$optionalDataArray  = array();
		
		$recipientCount = count( $recipient_ids );
		$recipient_obj  = new RecipientIdentifier();
		
		for( $cnt = 0; $cnt < $recipientCount; $cnt++ )
		{
			$optionalDataArray = null;
			$recipient = new recipient();
			$recipient->setListName( $listName );
				
			$recipient->setEmailFormat( EmailFormat::NO_FORMAT );
			$recipient->{ "set". $recipientIdentifier->getValue() }( $recipient_ids[ $cnt ] );
				
			// Build optionalData array
			foreach( $transientData[ 0 ] as $name => $value )
			{
				$optionalData = new optionalData();
				$optionalData->setName($name);
				$optionalData->setValue($value);
				$optionalDataArray[] = $optionalData;
			}
			
			$recipient->setOptionalData( $optionalDataArray );
			$recipientDataArray[] = $recipient;
		}
		
		$this->params['recipientData'] = $recipientDataArray;
	}
	 
}

/**
 * Send an email to a record already in the contact list
 * 
 */
class triggerCampaignMessage extends interact
{
	public $params = array( 'campaign' => null, 'recipientData' => null );

	public function setCampaignParam( InteractObject $campaign )
	{
		$this->params[ 'campaign'] = $campaign;
	}
	
	public function setRecipientDataParam( InteractObject $listName, RecipientIdentifier $recipientIdentifier, array $recipient_ids, array $transientData  )
	{
		$recipientDataArray = array();
		$optionalDataArray  = array();
		
		$recipientCount = count( $recipient_ids );
		$recipient_obj  = new RecipientIdentifier();
		
		for( $cnt = 0; $cnt < $recipientCount; $cnt++ )
		{
			$optionalDataArray = null;
			$recipient = new recipient();
			$recipient->setListName( $listName );
				
			$recipient->setEmailFormat( EmailFormat::NO_FORMAT );
			$recipient->{ "set". $recipientIdentifier->getValue() }( $recipient_ids[ $cnt ] );
				
			// Build optionalData array
			foreach( $transientData[ 0 ] as $name => $value )
			{
				$optionalData = new optionalData();
				$optionalData->setName($name);
				$optionalData->setValue($value);
				$optionalDataArray[] = $optionalData;
			}
			
			$recipient->setOptionalData( $optionalDataArray );
			$recipientDataArray[] = $recipient;
		}
		
		$this->params['recipientData'] = $recipientDataArray;
	}
}