<?php

class createTable extends interact
{
	public $params = array( 'table' => null, 'fields' => null );
	
	public function setTableParma( InteractObject $table )
	{
		$this->params['table'] = $table;
	}
	
	public function setFieldsParam( array $fields_details )
	{
		foreach( $field_details as $field_ )
		{
		
			$field = new Field();
			$field->fieldName = $field_['column_name'];
			$fieldType        = new FieldType();
			$field->fieldType = constant( get_class( $fieldType ) . "::" . $field_['column_type'] );
			$field->Custom    = $field_['is_custom'];
			$field->dataExtractionKey = $field_['is_extraction'];
		
			$fields_array[] = $field;
		
		}
		
		$this->params['fields'] = $fields_array;
	}
}

class createTableWithPK extends interact
{
	public $params = array( 'table' => null, 
							'fields' => null, 
							'primaryKeys' => null );

	public function setTableParam( InteractObject $table )
	{
		$this->params['table'] = $table;
	}

	public function setFieldsParam( array $fields_details )
	{
		foreach( $field_details as $field_ )
		{

			$field = new Field();
			$field->fieldName = $field_['column_name'];
			$fieldType        = new FieldType();
			$field->fieldType = constant( get_class( $fieldType ) . "::" . $field_['column_type'] );
			$field->Custom    = $field_['is_custom'];
			$field->dataExtractionKey = $field_['is_extraction'];

			$fields_array[] = $field;

		}

		$this->params['fields'] = $fields_array;
	}
	
	public function setPrimaryKeysParam( array $primary_keys )
	{
		$this->params['primaryKeys'] = $primary_keys;
	}
}

class deleteProfileExtensionMembers extends interact
{
	public $params = array( 'listExtension' => null,
							'idsToDelete'   => null,
							'queryColumn'   => null );
	
	public function setListParam( InteractObject $list_obj )
	{
		$this->params['listExtension'] = $list_obj;
	}
	
	public function setIdsToDelete( array $ids )
	{
		$this->params['idsToDelete'] = $ids;
	}
	
	public function setQueryColumn( $column )
	{
		$this->params['queryColumn'] = $column;
	}
}


class deleteTable extends interact
{
	public $params = array('table' => null );

	public function setTableParam( InteractObject $interact_obj )
	{
		$this->params['table'] = $interact_obj;
	}
}
	
class mergeIntoProfileExtension extends interact
{
	public $params = array( 'profileExtension' => null,
							'recordData'       => null,
							'matchColumn'      => null,
							'insertOnNoMatch'  => null,
							'updateOnMatch'    => null );
	
	public function setProfileExtensionParam( InteractObject $int_obj )
	{
		$this->params['profileExtension'] = $int_obj;
	}
	
	public function setRecordDataParam( array $record_data )
	{
		$this->params['recordData'] = $record_data;
	}
	
	public function setMatchColumnParam( $match_column )
	{
		$this->params['matchColumn'] = $match_column;
	}
	
	public function setInsertOnNoMatchParam( $insertOnNoMatch )
	{
		$this->params['insertOnNoMatch'] = $insertOnNoMatch;
	}
	
	public function setUpdateOnMatch( $updateOnNoMatch )
	{
		$this->params['updateOnNoMatch'] = $updateOnNoMatch;
	}
}


class mergeTableRecords extends interact
{
	public $params = array( 'table'            => null,
							'records'          => null,
							'matchColumnNames' => null );
	
	public function setTableParam( InteractObject $interact_obj )
	{
		$this->params['table'] = $interact_obj;
	}
	
	public function setRecordsParam( array $records )
	{
		$this->param['records'] = $records;
	}
	
	public function setMatchColumnNames( array $columns )
	{
		$this->param['matchColumnNames'] = $columns;
	}
}

class mergeTableRecordsWithPK extends interact
{
	public $params = array( 'table'            => null,
							'recordData'       => null,
							'insertOnNoMatch'  => null,
							'updateOnMatch'    => null );

	public function setTableParam( InteractObject $interact_obj )
	{
		$this->params['table'] = $interact_obj;
	}

	public function setRecordDataParam( array $records )
	{
		$this->param['recordData'] = $records;
	}
	
	public function setInsertOnNoMatchParam( $insertOnNoMatch )
	{
		$this->params['insertOnNoMatch'] = $insertOnNoMatch;
	}
	
	public function setUpdateOnMatch( $updateOnNoMatch )
	{
		$this->params['updateOnNoMatch'] = $updateOnNoMatch;
	}
}

class deleteTableRecords extends interact
{
	public $params = array( 'list'          => null,
						    'fieldList'     => null,
						    'idsToRetrieve' => null,
						    'queryColumn'   => null );
	
	public function setTableParam( InteractObject $interact_obj )
	{
		$this->params['table'] = $interact_obj;
	}
	
	public function setIdsToDelete( array $ids )
	{
		$this->params['idsToDelete'] = $ids;
	}
	
	public function setQueryColumn( $column )
	{
		$this->params['queryColumn'] = $column;
	}
}

class retrieveTableRecords extends interact
{
	
	public $params = array( 'table'         => null,
							'fieldList'     => null,
							'idsToRetrieve' => null,
							'queryColumn'   => null );
	
	public function setFieldListParam( array $fields )
	{
		$this->params['fieldList'] = $fields;
	}
	
	public function setIdsToRetrieve( array $ids )
	{
		$this->params['idsToRetrieve'] = $ids;
	}
	
	public function setQueryColumn( $column )
	{
		$this->params['queryColumn'] = $column;
	}
}

/**
 * RetrieveResult = service.retrieveProfileExtensionRecords (InteractObject listExtension, QueryColumn queryColumn, String[] fieldList, String[] idsToRetrieve)
 * 
 */
	
class retrieveProfileExtensionRecords extends interact
{
	public $params = array( 'listExtension' => null,
							'queryColumn'   => null,
							'fieldList'     => null,
							'idsToRetreive' => null );
	
	public function setListExtensionParam( InteractObject $int_obj )
	{
		$this->params['listExtension'] = $int_obj;
	}
	
	public function setFieldListParam( array $fields )
	{
		$this->params['fieldList'] = $fields;
	}
	
	public function setIdsToRetrieve( array $ids )
	{
		$this->params['idsToRetrieve'] = $ids;
	}
	
	public function setQueryColumn( $column )
	{
		$this->params['queryColumn'] = $column;
	}
}

class truncateTable extends interact
{
	public $params = array('table' => null );

	public function setTableParam( InteractObject $interact_obj )
	{
		$this->params['table'] = $interact_obj;
	}
}
