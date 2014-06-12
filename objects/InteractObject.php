<?php

class InteractObject
{
	public $folderName,
		   $objectName;
			
	public function setFolderName( $name )
	{
		$this->folderName = $name;
	}
	
	public function setObjectName( $name )
	{
		$this->objectName = $name;
	}
	
}