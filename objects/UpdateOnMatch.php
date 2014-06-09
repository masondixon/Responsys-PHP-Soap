<?php

/**
 * If a record is found or matched on, dictate the behavior.
 * You can either replace the column values that are supplied in the call or chose not to update at all
 */
class UpdateOnMatch
{
	public $updateOnMatch;
	CONST REPLACE = "REPLACE_ALL";
	CONST IGNORE  = "NO_UPDATE";
}