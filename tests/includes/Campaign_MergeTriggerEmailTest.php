<?php

include "../../bootstrap.php";

class Campaign_MergeTriggerEmailTest extends PHPUnit_Framework_TestCase
{
	public $trigger;
	public $params = array( 'recordData'  => array( 'fieldNames' => null, 'records' => null ),
							'mergeRule'   => null,
							'campaign'    => null,
							'triggerData' => null );
	
	public function setup()
	{
		$this->trigger = new mergeTriggerEmail();
	}
	
	public function teardown()
	{
		$this->trigger = null;
	}
	
	/**
	 * Lets make sure that the Unit test array and base class param array match up!
	 */
	public function testParamArraySanity()
	{
		$new_merge_obj = new mergeTriggerEmail();
		$this->assertEquals( $this->trigger->params, $new_merge_obj->params );
	}
	
	public function testSetMergeRuleParam()
	{
		$rule = new ListMergeRule();
		$this->trigger->setMergeRuleParam( $rule );
		$this->assertInstanceOf('ListMergeRule', $this->trigger->params['mergeRule'] );
	}
	
	public function testSetRecordDataParam()
	{
		$fieldNames = array("FIRSTNAME", "EMAIL_ADDRESS_");
		$records    = array( 	array( "Mason", "mason@email.com", 
								array( "Tommy", "tommy@email.com" ) ) 
						   );

		$this->trigger->setRecordDataParam($fieldNames, $records);
		$this->assertTrue(  is_array( $this->trigger->params['recordData'] ) );
		$this->assertTrue( isset($this->trigger->params['recordData']['fieldNames']) );
		$this->assertTrue( isset($this->trigger->params['recordData']['records']) );
		
	}
	
	public function testSetCampaignParam()
	{
		$campaign_obj = new InteractObject();
		$campaign_obj->setFolderName("some_folder");
		$campaign_obj->setObjectName("my_campaign_name");
		$this->trigger->setCampaignParam( $campaign_obj );
		
		$this->assertInstanceOf('InteractObject', $this->trigger->params['campaign'] );
	}
	
	public function testSetTriggerData()
	{
		$transientData[] = array( "FIRST_NAME" => "MASON", "LAST_NAME" => "DIXON" );
		$transientData[] = array( "FIRST_NAME" => "JASMIN", "LAST_NAME" => "GUY" );
		
		for( $tmp = 0; $tmp < count( $transientData ); $tmp++ )
		{
			$optionalDataArray = null;
				
			foreach( $transientData[ $tmp ] as $name => $value )
			{
				$optionalData = new optionalData();
				$optionalData->name  = $name;
				$optionalData->value = $value;

				$optionalDataArray[] = $optionalData;
			}
				
			$triggerDataArray[] = $optionalDataArray;
		}
		
		$this->trigger->setTriggerDataParam( $triggerDataArray );
		
		$this->assertTrue( is_array( $this->trigger->params['triggerData'] ) );
		$this->assertInstanceOf( 'OptionalData', $this->trigger->params['triggerData'][0][0] );
	}
	
}