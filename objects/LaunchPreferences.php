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
	
}