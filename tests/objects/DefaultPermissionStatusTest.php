<?php

include '../../objects/DefaultPermissionStatus.php';

class DefaultPermissionStatusTest extends PHPUnit_Framework_TestCase
{
	public $status;
	
	public function setup()
	{
		$this->status = new DefaultPermissionStatus();
	}
	
	public function testIsDefaultPermissionStatus()
	{
		$this->assertInstanceOf( 'DefaultPermissionStatus', $this->status);
	}
	
	public function testGetOPTIN()
	{
		$this->assertEquals( 'OPTIN' , DefaultPermissionStatus::OPT_IN );
	}
	
	public function testGetOPTOUT()
	{
		$this->assertEquals( 'OPTOUT' , DefaultPermissionStatus::OPT_OUT );
	}
}