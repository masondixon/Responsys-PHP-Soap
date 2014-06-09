<?php


class deleteFolder extends interact
{
	public $params = array( 'folderName' => null );
	
	public function setFolderNameParam( $folderName )
	{
		$this->params['folderName'] = $folderName;
	}
}

class listFolders extends interact
{
	public $params = array();
}
