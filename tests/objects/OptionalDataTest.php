<?php

class OptionalDataTest extends PHPUnit_Framework_TestCase
{
	public $opt_data;
	
	public function setup()
	{
		$this->opt_data = new optionalData();
	}
	
	public function testIsOptionalData()
	{
		$this->assertInstanceOf( 'optionalData', $this->opt_data );
	}
	
	public function testSetName()
	{
		$name = "test";
		$this->opt_data->setName($name);
		$this->assertEquals( $name, $this->opt_data->name );
	}
	
	public function testSetValue()
	{
		$value = "test";
		$this->opt_data->setValue($value);
		$this->assertEquals( $value, $this->opt_data->value );
	}
}