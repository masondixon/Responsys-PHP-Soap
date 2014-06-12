<?php

class Recipient
{	
	
	public  $listName,
			$recipientId,
			$customerId,
			$emailAddress,
			$mobileNumber,
			$emailFormat;
	
	public function setListName( $folder, $list )
	{
		$this->listName->folderName = $folder;
		$this->listName->objectName = $list;
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
	
	public function setEmailFormat( $format )
	{
		$this->emailFormat = $format;
	}
}

