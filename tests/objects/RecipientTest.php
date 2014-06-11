<?php

class RecipientTest extends PHPUnit_Framework_TestCase
{
	public $recipient;
	
	public function setup()
	{
		$this->recipient = new recipient();
	}
	
	public function testIsRecipient()
	{
		$this->assertInstanceOf( 'recipient', $this->recipient );
	}
	
	public function testSetListName()
	{
		$int_obj = new interactObject();
		$int_obj->setFolderName("mason");
		$int_obj->setObjectName("masonList");

		$this->recipient->setListName($int_obj);
		
		$this->assertInstanceOf( 'interactObject' , $this->recipient->listName );

	}
	
	public function testSetRecipientId()
	{
		$id = 123;
		$this->recipient->setRecipientId( $id );
		$this->assertEquals( $id, $this->recipient->recipientId );
	}
	
	public function testSetCustomerId()
	{
		$id = 123;
		$this->recipient->setCustomerId(123);
		$this->assertEquals( $id, $this->recipient->customerId );
	}
	
	public function testSetEmailAddress()
	{
		$email = 'mdixon@gmail.com';
		$this->recipient->setEmailAddress( $email );
		$this->assertEquals( $email, $this->recipient->emailAddress );
	}
	
	public function testSetMobileNumber()
	{
		$mobile = '5104836754';
		$this->recipient->setMobileNumber( $mobile );
		$this->assertEquals( $mobile, $this->recipient->mobileNumber );
	}
	
	public function testSetOptionalData()
	{
		$data = array( new optionalData() );
		$this->recipient->setOptionalData( $data );
		$this->assertTrue( is_array( $this->recipient->optionalData) );
		$this->assertInstanceOf( 'optionalData', $this->recipient->optionalData[0]);
	}
	
	public function testSetEmailFormat()
	{
		$this->recipient->setEmailFormat( EmailFormat::NO_FORMAT );
		$this->assertEquals( $this->recipient->emailFormat, EmailFormat::NO_FORMAT );
	}
}