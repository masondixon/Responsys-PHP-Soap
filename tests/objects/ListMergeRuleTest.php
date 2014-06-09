<?php

$object_includes = glob('../../objects/*.php');

foreach( $object_includes as $include )
{
	include $include;
}


class ListMergeRuleTest extends PHPUnit_Framework_TestCase
{
	public $list_merge_rule;
	
	public function setup()
	{
		$this->list_merge_rule = new ListMergeRule();
	}
	
	public function teardown()
	{
		$this->list_merge_rule = null;
	}
	
	public function testIslist_merge_ruleObject()
	{
		$this->assertInstanceOf( 'ListMergeRule', $this->list_merge_rule );
	}
	
	public function testConstructor_aka_SetDefaults()
	{
		$this->assertEquals( 'I', $this->list_merge_rule->optinValue );
		$this->assertEquals( 'O', $this->list_merge_rule->optoutValue );
		$this->assertEquals( 'H', $this->list_merge_rule->htmlValue );
		$this->assertEquals( 'T', $this->list_merge_rule->textValue );
	}
	
	public function testSetInsertOnNoMatch()
	{
		$this->list_merge_rule->setInsertOnNoMatch( true );
		$this->assertEquals( true, $this->list_merge_rule->insertOnNoMatch );
		$this->list_merge_rule->setInsertOnNoMatch( false );
		$this->assertEquals( false, $this->list_merge_rule->insertOnNoMatch );
	}

	public function testSetInsertOnNoMatchFail()
	{
		try{
			$this->list_merge_rule->setInsertOnNoMatch(null);
			$this->fail("Expected exception not thrown");
		}catch(Exception $e){
			$this->assertEquals("InsertOnNoMatch must be boolean value",$e->getMessage());
		}
	}
	
	public function testSetUpdateOnMatch()
	{
		$this->list_merge_rule->setUpdateOnMatch( UpdateOnMatch::REPLACE );
		$this->assertEquals( UpdateOnMatch::REPLACE, $this->list_merge_rule->updateOnMatch );
	
		$this->list_merge_rule->setUpdateOnMatch( UpdateOnMatch::IGNORE );
		$this->assertEquals( UpdateOnMatch::IGNORE, $this->list_merge_rule->updateOnMatch );
	}
	
	public function testSetMatchOperator()
	{
		$this->list_merge_rule->setMatchOperator( MatchOperator::_AND_ );
		$this->assertEquals( MatchOperator::_AND_, $this->list_merge_rule->matchOperator );
		
		$this->list_merge_rule->setMatchOperator( MatchOperator::_NONE_ );
		$this->assertEquals( MatchOperator::_NONE_, $this->list_merge_rule->matchOperator );
	}
	
	public function testSetRejectChannel()
	{

		$this->list_merge_rule->setRejectChannel( RejectChannel::EMAIL );
		$this->assertEquals( RejectChannel::EMAIL, $this->list_merge_rule->rejectRecordIfChannelEmpty );
		
		$this->list_merge_rule->setRejectChannel( RejectChannel::MOBILE );
		$this->assertEquals( RejectChannel::MOBILE, $this->list_merge_rule->rejectRecordIfChannelEmpty );
		
		$this->list_merge_rule->setRejectChannel( RejectChannel::NONE );
		$this->assertEquals( RejectChannel::NONE, $this->list_merge_rule->rejectRecordIfChannelEmpty );
		
		$this->list_merge_rule->setRejectChannel( RejectChannel::POSTAL );
		$this->assertEquals( RejectChannel::POSTAL, $this->list_merge_rule->rejectRecordIfChannelEmpty );
	}
	
	public  function testSetDefaultPermissionStatus()
	{
		$this->list_merge_rule->setDefaultPermissionStatus( DefaultPermissionStatus::OPT_IN );
		$this->assertEquals( DefaultPermissionStatus::OPT_IN, $this->list_merge_rule->defaultPermissionStatus );
		
		$this->list_merge_rule->setDefaultPermissionStatus( DefaultPermissionStatus::OPT_OUT );
		$this->assertEquals( DefaultPermissionStatus::OPT_OUT, $this->list_merge_rule->defaultPermissionStatus );
	}
	
	public function testSetMatchColumn1()
	{
		$this->list_merge_rule->setMatchColumn1( MatchColumn::CUSTOMER_ID );
		$this->assertEquals( MatchColumn::CUSTOMER_ID, $this->list_merge_rule->matchColumnName1 );
		
		$this->list_merge_rule->setMatchColumn1( MatchColumn::EMAIL );
		$this->assertEquals( MatchColumn::EMAIL, $this->list_merge_rule->matchColumnName1 );
		
		$this->list_merge_rule->setMatchColumn1( MatchColumn::RECIPIENT_ID );
		$this->assertEquals( MatchColumn::RECIPIENT_ID, $this->list_merge_rule->matchColumnName1 );
	}
	
	public function testSetMatchColumn2()
	{
		$this->list_merge_rule->setmatchColumn2( MatchColumn::CUSTOMER_ID );
		$this->assertEquals( MatchColumn::CUSTOMER_ID, $this->list_merge_rule->matchColumnName2 );

		$this->list_merge_rule->setmatchColumn2( MatchColumn::EMAIL );
		$this->assertEquals( MatchColumn::EMAIL, $this->list_merge_rule->matchColumnName2 );

		$this->list_merge_rule->setmatchColumn2( MatchColumn::RECIPIENT_ID );
		$this->assertEquals( MatchColumn::RECIPIENT_ID, $this->list_merge_rule->matchColumnName2 );
	}
	
	
}