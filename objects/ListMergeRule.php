<?php

/**
 * MergeRules help define the behavior of a record when you attempt to merge it into a contact list
 * Every list update call requires a listMergeRule
 **/

class ListMergeRule
{
	public $insertOnNoMatch,
	       $updateOnMatch,
	       $matchOperator,
	       $rejectRecordIfChannelEmpty,
	       $defaultPermissionStatus,
	       $matchColumnName1,
	       $matchColumnName2,
	       $optinValue,
	       $optoutValue,
	       $htmlValue,
	       $textValue;

	function __construct()
	{
		$this->setOptinValue();
		$this->setOptoutValue();
		$this->setHTMLvalue();
		$this->setTEXTvalue();
	}
	
	public function setInsertOnNoMatch( $insert )
	{
		if( is_bool( $insert ) )
		{
			$this->insertOnNoMatch = $insert;
		}
		else 
		{
			throw new InvalidArgumentException( "InsertOnNoMatch must be boolean value");
		}
	}
	
	public function setUpdateOnMatch( UpdateOnMatch $update )
	{
		$this->updateOnMatch = $update->updateOnMatch;
	}
	
	public function setMatchOperator( MatchOperator $match )
	{
		$this->matchOperator = $match->matchOperator;
	}
	
	public function setRejectChannel( RejectChannel $channel )
	{
		$this->rejectRecordIfChannelEmpty = $channel->rejectChannel;
	}
	
	public  function setDefaultPermissionStatus( DefaultPermissionStatus $status )
	{
		$this->defaultPermissionStatus = $status->defaultPermissionStatus;
	}
	
	public function setMatchColumn1( MatchColumn $match_column )
	{
		$this->matchColumnName1 = $match_column->matchColumn;
	}
	
	public function setMatchColumn2( MatchColumn $match_column )
	{
		$this->matchColumnName2 = $match_column->matchColumn;
	}
	
	private function setOptinValue()
	{
		$this->optinValue = "I";
	}
	
	private function setOptoutValue()
	{
		$this->optoutValue = "O";
	}
	
	private function setHTMLvalue()
	{
		$this->htmlValue = "H";
	}
	
	private function setTEXTvalue()
	{
		$this->textValue = "T";
	}

		
}