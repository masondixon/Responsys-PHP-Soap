<?php

class mergeListMembersRIID extends interact
{
	public $params = array( 'recordData'  => array( 'fieldNames' => null, 'records' => null ),
							'mergeRule'   => null,
							'list'        => null );
		
	public function setMergeRuleParam( ListMergeRule $rule )
	{
		$this->params['mergeRule'] = $rule;
	}
	
	public function setRecordDataParam( array $fieldNames, array $records )
	{
		$this->params['recordData']['fieldNames'] = $fieldNames;
		$this->params['recordData']['records']    = $records;
	}
	
	public function setListParam( InteractObject $interact_object )
	{
		$this->params['list'] = $interact_object;
	}
	
}

/**
 * Retrieve a record or set of records by its QueryColumn value
 */
class retrieveListMembers extends interact
{
	public $params = array( 'list'          => null,
						    'fieldList'     => null,
						    'idsToRetrieve' => null,
						    'queryColumn'   => null );
	
	public function setListParam( InteractObject $list_obj )
	{
		$this->params['list'] = $list_obj;
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

/**
 * Retrieve a record or set of records by its QueryColumn value
 */
class deleteListMembers extends interact
{
	public $params = array( 'list'          => null,
							'idsToDelete'   => null,
							'queryColumn'   => null );

	public function setListParam( InteractObject $list_obj )
	{
		$this->params['list'] = $list_obj;
	}

	public function setFieldListParam( array $fields )
	{
		$this->params['fieldList'] = $fields;
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
