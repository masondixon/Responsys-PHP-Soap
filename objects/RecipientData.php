<?php

class RecipientData
{
	public $recipient,
		   $optionalData;
	
	public function setRecipient( Recipient $recipient )
	{
		$this->recipient = $recipient;
	}
	
	public function setOptionalData( array $optional_data_array )
	{
		$this->optionalData = $optional_data_array;
	}
	
}