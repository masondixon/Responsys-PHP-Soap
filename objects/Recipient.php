<?php

class Recipient
{	
	
	public  $listName,
			$recipientId,
			$customerId,
			$emailAddress,
			$mobileNumber,
			$optionalData,
			$emailFormat;
	
	public function setListName( interactObject $int_obj )
	{
		$this->listName = $int_obj;
	}
	
	public function setRecipientId( $id )
	{
		$this->recipientId = $id;
	}
	
	public function setCustomerId( $id )
	{
		$this->customerId = $id;
	}
	
	public function setEmailAddress( $email )
	{
		$this->emailAddress = $email;
	}
	
	public function setMobileNumber( $number )
	{
		$this->mobileNumber = $number;
	}
	
	public function setOptionalData( array $data )
	{
		$this->optionalData = $data;
	}
	
	public function setEmailFormat( $format )
	{
		$this->emailFormat = $format;
	}
}

