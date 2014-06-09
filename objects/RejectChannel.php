<?php

/**
 *This will cause the record to be rejected if E or EMAIL_ADDRESS_ field isnt in the payload ( Possible values are "E"mail,"M"obile, or "P"ostal ), also allows null
 */

class RejectChannel
{
	public $rejectChannel;
	
	CONST EMAIL  = "E";
	CONST POSTAL = "P";
	CONST MOBILE = "M";
	CONST NONE   = null;
}