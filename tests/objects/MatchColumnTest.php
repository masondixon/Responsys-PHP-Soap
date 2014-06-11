<?php

class MatchColumnTest extends PHPUnit_Framework_TestCase
{
	public $column;
	
	CONST EMAIL = "EMAIL_ADDRESS_";
	CONST CUST  = "CUSTOMER_ID_";
	CONST RIID  = "RIID_";
	
	public function setup()
	{
		$this->column = new MatchColumn();
	}
	
	public function testIsMatchColumn()
	{
		$this->assertInstanceOf( 'MatchColumn', $this->column );
	}

	public function testGetEmailConstant()
	{
		$this->assertEquals( constant( get_class( $this->column )."::EMAIL" )  , self::EMAIL );
	}
	
	public function testGetCustomeridConstant()
	{
		$this->assertEquals( constant( get_class( $this->column )."::CUSTOMER_ID" )  , self::CUST );
	}
	
	public function testGetRIIDConstant()
	{
		$this->assertEquals( constant( get_class( $this->column )."::RECIPIENT_ID" )  , self::RIID );
	}
}