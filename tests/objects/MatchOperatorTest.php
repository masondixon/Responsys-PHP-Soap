<?php

class MatchOperatorTest extends PHPUnit_Framework_TestCase
{
	public $operator;
	
	CONST _AND_ = "AND";
	CONST NONE  = "NONE";
	
	public function setup()
	{
		$this->operator = new MatchOperator();
	}
	
	public function testIsOperator()
	{
		$this->assertInstanceOf( 'MatchOperator', $this->operator );
	}
	
	public function testGetAndConstant()
	{
		$this->assertEquals( self::_AND_, constant( get_class( $this->operator )."::_AND_") );
	}
	
	public function testGetNONEConstant()
	{
		$this->assertEquals( self::NONE, constant( get_class( $this->operator )."::_NONE_") );
	}
}