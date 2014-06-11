<?php

class UpdateOnMatchTest extends PHPUnit_Framework_TestCase
{
	public $update;
	
	CONST IGNORE  = 'NO_UPDATE';
	CONST REPLACE = 'REPLACE_ALL'; 
	
	public function setup()
	{
		$this->update = new UpdateOnMatch();
	}
	
	public function testIsUpdateOnMatch()
	{
		$this->assertInstanceOf( 'UpdateOnMatch', $this->update );
	}
	
	public function testGetIgnoreConstant()
	{
		$this->assertEquals( self::IGNORE, constant( get_class( $this->update )."::IGNORE" ) );
	}
	
	public function testGetReplaceConstant()
	{
		$this->assertEquals( self::REPLACE, constant( get_class( $this->update )."::REPLACE" ) );
	}
}