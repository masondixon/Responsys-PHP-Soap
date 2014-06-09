<?php

class ProofLaunchType
{
	CONST TO_ADDRESS   = "LAUNCH_TO_ADDRESS";
	CONST TO_PROOFLIST = "LAUNCH_TO_PROOFLIST";
	CONST TO_ADDRESS_USING_PROOFLIST = "LAUNCH_TO_ADDRESS_USING_PROOFLIST";
	
	public $proofLaunchType;

	public function setProofLaunchType( $type )
	{
		$this->proofLaunchType = $type;
	}
	
	public function getProofLaunchType()
	{
		return $this->proofLaunchType;
	}
}