<?php

class InteractObject
{
	public function setFolderName( $name )
	{
		$this->folderName = $name;
	}
	
	public function setObjectName( $name )
	{
		$this->objectName = $name;
	}
	
	public function setListName( InteractObject $int_obj )
	{
		$this->listName = $int_obj;
	}
	
}