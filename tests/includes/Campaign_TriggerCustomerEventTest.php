<?php

include "../../bootstrap.php";

class Campaign_TriggerCustomEventTest extends PHPUnit_Framework_TestCase
{
	public $event;
	public $params = array( 'customEvent' => null, 'recipientData' => null );
	
	public function setup()
	{
		$this->event = new triggerCustomEvent();
	}
	
	public function teardown()
	{
		$this->event = null;
	}
	
	public function testParamsDefaultValues()
	{
		$this->assertEquals( $this->params, $this->event->params );
	}
	
	public function testSetCustomEventParam()
	{
		$custom_event_obj = new CustomEvent();
		$custom_event_obj->setEventName('some_name');
		
		$this->event->setCustomEventParam( $custom_event_obj );
		
		$this->assertInstanceOf( 'CustomEvent', $this->event->params['customEvent'] );
		
		$this->assertEquals( 'some_name', $this->event->params['customEvent']->eventName );
	}
	
	public function testSetRecipientData()
	{
		$int_obj = new InteractObject();
		$int_obj->setFolderName("some_folder");
		$int_obj->setObjectName("some_contact_list");
		
		$identifier = new RecipientIdentifier();
		$identifier->setValue( RecipientIdentifier::EMAIL_ADDRESS );
		
		$ids = array("mdixon@gmail.com", "mdixon+1@gmail.com");
		
		$optionalData = array( array( "FIRST_NAME" => "Mason", "ZIP" => "12345" ), array( "FIRST_NAME" => "Tom", "Zip" => "54321" ) );
		
		$this->event->setRecipientDataParam( $int_obj, $identifier, $ids, $optionalData );
		
		$this->assertTrue( is_array( $this->event->params['recipientData'] ) );
		
		foreach( $this->event->params['recipientData'] as $key => $recipientObject )
		{
			$this->assertInstanceOf( 'recipient', $recipientObject );
		}
	}
	
	
	
}