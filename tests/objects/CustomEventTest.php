<?php

class CustomEventTest extends PHPUnit_Framework_TestCase
{
	public $event;
	
	public function setup()
	{
		$this->event = new CustomEvent();
	}
	
	public function testIsCustomEvent()
	{
		$this->assertInstanceOf( 'CustomEvent', $this->event );
	}
	
	public function testSetEventName()
	{
		$event_name = "test";
		$this->event->setEventName($event_name);
		$this->assertEquals( $event_name, $this->event->eventName );
	}
	
	public function testSetEventId()
	{
		$event_id = 12;
		$this->event->setEventId($event_id);
		$this->assertEquals( $event_id, $this->event->eventId );
	}
	
}