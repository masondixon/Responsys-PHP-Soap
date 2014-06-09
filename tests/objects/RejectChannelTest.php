<?php

include '../../objects/RejectChannel.php';

class RejectChannelTest extends PHPUnit_Framework_TestCase
{
	public $channel;
	CONST EMAIL  = "E";
	CONST POSTAL = "P";
	CONST MOBILE = "M";
	CONST NONE   = null;
	
	public function setup()
	{
		$this->channel = new RejectChannel();
	}
	
	public function testIsChannel()
	{
		$this->assertInstanceOf( 'RejectChannel', $this->channel );
	}
	
	
	public function testGetEmailConstant()
	{
		$this->assertEquals( self::EMAIL, constant( get_class( $this->channel )."::EMAIL" ) );
	}
	
	public function testGetPostalConstant()
	{
		$this->assertEquals( self::POSTAL, constant( get_class( $this->channel )."::POSTAL" ) );
	}
	
	public function testGetMobileConstant()
	{
		$this->assertEquals( self::MOBILE, constant( get_class( $this->channel )."::MOBILE" ) );
	}
	
	public function testGetNoneConstant()
	{
		$this->assertEquals( self::NONE, constant( get_class( $this->channel )."::NONE" ) );
	}

}