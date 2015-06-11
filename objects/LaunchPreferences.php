<?php

/**
 * LaunchPreference object properties include: 
 * boolean enableLimit
 * int recipientLimit
 * boolean enableNthSampling
 * int samplingNthSelection
 * int samplingNthInterval
 * int samplingNthOffset
 * boolean enableProgressAlerts 
 * string progressEmailAddresses 
 * int progressChunk (>999)
 */
class LaunchPreferences
{

	public $enabledLimit,
		   $recipientLimit,
		   $enableNthSampling,
		   $samplingNthSelection,
		   $samplingNthInterval,
		   $samplingNthOffset,
		   $enableProgressAlerts,
		   $progressEmailAddresses,
		   $progressChunk;
	
	function __construct(){}
	

	public function setEnabledLimit( $flag=true )
	{
		$this->enabledLimit = $flag;
	}
	
	public function setRecipientLimit( $recipients )
	{
		$this->recipientLimit = $recipients;
	}
	
	public function setEnableNthSampling( $flag=true )
	{
		$this->enableNthSampling = $flag;
	}
	
	public function setSamplingNthSelection( $selections )
	{
		$this->samplingNthSelection = $selections;
	}
	
	public function setSamplingNthInterval( $intervals )
	{
		$this->samplingNthInterval = $intervals;
	}
	
	public function setSamplingNthOffset( $offsets )
	{
		$this->samplingNthOffset = $offsets;
	}
	
	public function setEnableProgressAlerts( $flag=true )
	{
		$this->enableProgressAlerts = $flag;
	}
	
	public function setProgressEmailAddresses( $addresses )
	{
		$this->progressEmailAddresses = $addresses;
	}
	
	public function setProgressChunk( ProgressChunk $chunk_size )
	{
		$this->progressChunk = $chunk_size->getProgressChunk();
	}
	
}