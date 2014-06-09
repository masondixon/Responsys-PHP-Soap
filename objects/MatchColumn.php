<?php

/**
 * Match on the Responsys unique id 'RIID_' or 'EMAIL_ADDRESS_' or 'CUSTOMER_ID_'
 * Its possible to uses other columns to match on, if they are indexed properly ( UI thing )
 */
class MatchColumn
{
	public $matchColumn;
	
	CONST EMAIL        = "EMAIL_ADDRESS_";
	CONST CUSTOMER_ID  = "CUSTOMER_ID_";
	CONST RECIPIENT_ID = "RIID_";
}