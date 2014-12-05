<?php

/**
 * The FieldType is a string restricted to one of the values listed below.
 * Type Values
 * String STR500 NUMBER STR4000 TIMESTAMP INTEGER
 */
class Field
{
	const STR500    = 'STR500';
	const STR4000   = 'STR4000';
	const NUMBER    = 'NUMBER';
	const TIMESTAMP = 'TIMESTAMP';
	const INTEGER   = 'INTEGER';
	
	public  $fieldName,
			$fieldType,
			$Custom,
			$dataExtractionKey;
	
	
}