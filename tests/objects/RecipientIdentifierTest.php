<?php

class RecipientIdentifierTest extends PHPUnit_Framework_TestCase
{
	public $recipientIdentifier;
	
	public function setup()
	{
		$this->recipientIdentifier = new RecipientIdentifier();
	}
	
	public function testIsRecipientIdentifer()
	{
		$this->assertInstanceOf( 'recipientIdentifier', $this->recipientIdentifier);
	}
	
	public function testGetEmailAddressConstant()
	{
		$this->assertEquals( 'emailAddress' , RecipientIdentifier::EMAIL_ADDRESS );
	}
	
	public function testGetCustomerIdConstant()
	{
		$this->assertEquals( 'customerId' , RecipientIdentifier::CUSTOMER_ID );
	}
	
	public function testGetRecipientIdConstant()
	{
		$this->assertEquals( 'recipientId' , RecipientIdentifier::RECIPIENT_ID );
	}
}