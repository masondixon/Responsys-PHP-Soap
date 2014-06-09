<?php

class ProofLaunchOptions
{
	public $proofEmailAddress,
		   $proofLaunchType;
	
	public function setProofEmailAddresses( $csv_email_list )
	{
		$this->proofEmailAddress = $csv_email_list;
	}
	
	public function setProofLaunchType( ProofLaunchType $type )
	{
		$this->proofLaunchType = $type->getProofLaunchType();
	}
}