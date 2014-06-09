<?php

class RecipientIdentifier
{
	public $value;
	
	CONST EMAIL_ADDRESS = 'emailAddress';
	CONST CUSTOMER_ID   = 'customerId';
	CONST RECIPIENT_ID  = 'recipientId';
	
	public function setValue( $value )
	{
		$this->value = $value;
	}
	
	public function getValue()
	{
		return $this->value;
	}
	
}