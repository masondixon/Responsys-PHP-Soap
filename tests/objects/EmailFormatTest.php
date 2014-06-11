<?php

class EmailFormatTest extends PHPUnit_Framework_TestCase
{
	public $format;
	
	public function setup()
	{
		$this->format = new EmailFormat();
	}
	
	public function testIsEmaiLFormat()
	{
		$this->assertInstanceOf( 'EmailFormat', $this->format);
	}
	
	public function testGetHTMLConstant()
	{
		$this->assertEquals( 'HTML' , EmailFormat::HTML_FORMAT );
	}
	
	public function testGetTEXTConstant()
	{
		$this->assertEquals( 'TEXT' , EmailFormat::TEXT_FORMAT );
	}
	
	public function testGetNOFORMATConstant()
	{
		$this->assertEquals( 'NO_FORMAT' , EmailFormat::NO_FORMAT );
	}
}