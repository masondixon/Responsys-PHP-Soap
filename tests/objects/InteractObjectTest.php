<?php

include '../../objects/InteractObject.php';

class InteractObjectTest extends PHPUnit_Framework_TestCase
{
	public $int_obj;
	
	public function setup()
	{
		$this->int_obj = new InteractObject();
	}
	
	public function testIsInteractObject()
	{
		$this->assertInstanceOf( 'InteractObject', $this->int_obj );
	}
	
	public function testSetFolderName()
	{
		$folder_name = "test";
		$this->int_obj->setFolderName($folder_name);
		$this->assertEquals( $folder_name, $this->int_obj->folderName );
	}
	
	public function testSetObjectName()
	{
		$object_name = "test";
		$this->int_obj->setObjectName($object_name);
		$this->assertEquals( $object_name, $this->int_obj->objectName );
	}
	
	public function testSetListName()
	{
		$new_int_obj = new InteractObject();
		$this->int_obj->setListName( $new_int_obj );
		$this->assertInstanceOf('InteractObject', $this->int_obj->listName );
	}
}