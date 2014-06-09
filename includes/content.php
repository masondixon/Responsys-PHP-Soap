<?php

/**
 * Doesnt exist?
 * @author mdixon
 *
 */
class copyContentLibraryItem extends interact
{
	public $params = array( 'srcPath' => null,
							'dstPath' => null );
}

/**
 * Doc is WAY off
 * type and itemData not documented at all
 * type is actually filetype so a .jpg becomes type = 'jpg';
 * @author mdixon
 */
class createContentLibraryItem extends interact
{
	public $params = array( 'contentLibraryLocation' => null,
							'type' =>     null,
							'itemData' => null );
	
	public function setLocationParam( InteractObject $int_obj )
	{
		$this->params['contentLibraryLocation'] = $int_obj;
	}
	
	public function setTypeParam( $type )
	{
		$this->params['type'] = $type;
	}
	
	public function setItemDataParam( ItemData $data )
	{
		$this->params['itemData'] = $data;
	}
}


class createDocument extends interact
{
	public $params = array( 'document' => null,
							'content'  => null, 
							'characterEncoding' => null );
	
	public $char_sets = array( "ISO_8859_1", 
							   "windows_1257",
							   "ISO_8859_2",
							   "gb2312",
							   "big5",
							   "ISO_8859_7",
							   "SJIS",
							   "euc_kr",
							   "koi8_r",
							   "ISO_8859_9",
							   "UTF_8" );
	
	public function setDocumentParam( InteractObject $location )
	{
		$this->params[ 'document' ] = $location;
	}
	
	public function setContentParam( $content )
	{
		$this->params[ 'content' ] = $content;
	}
	
	public function setEncodingParameter( $encoding )
	{	

		if( !in_array( $encoding, $this->char_sets ) )
		{
			echo " Allowed character sets : \n ";
			
			$cnt = 1;
			foreach( $allowed_charsets as $set )
			{
				echo  $cnt . ") " . $set . "\n";
				$cnt++;
			}
			
			throw new Exception( " Unknown character set in " . __CLASS__ . " : " . __FUNCTION__ . " at line " . __LINE__ );
		}
		
		$this->params[ 'characterEncoding' ] = $encoding;
	}
}

class deleteContentLibraryItem extends interact
{
	public $params = array( 'contentLibraryLocation' => null );
	
	public function setContentLibraryLocationParam( InteractObject $location )
	{
		$this->params[ 'contentLibraryLocation' ] = $location;
	}
}


class deleteDocument extends interact
{
	public $params = array( 'document' => null );
	
	public function setDocumentParam( InteractObject $location )
	{
		$this->params[ 'document' ] = $location;
	}
}


class getContentLibraryItem extends interact
{
	public $params = array( 'sourceObject' => null );
	
	public function setDocumentParam( InteractObject $int_obj )
	{
		$this->params[ 'sourceObject' ] = $int_obj;
	}
}

class getDocumentContent extends interact
{
	public $params = array( 'document' => null );
	
	public function setDocumentParam( InteractObject $int_obj )
	{
		$this->params[ 'document' ] = $int_obj;
	}

}


class getDocumentImages extends interact
{
	public $params = array( 'document' => null );
	
	public function setDocumentParam( InteractObject $doc_obj )
	{
		$this->params[ 'document' ] = $doc_obj;
	}
}


/*
 * Doesnt exist in the wsdl
 */
class moveContentLibraryItem extends interact
{
	public $params = array();
}

class setDocumentContent extends interact
{
	public $params = array( 'document' => null,
							'content'  => null );
	
	public function setDocumentParam( InteractObject $int_obj )
	{
		$this->params[ 'document' ] = $int_obj;
	}
	
	public function setContentParam( $content )
	{
		$this->params[ 'content' ] = $content;
	}

}

class setDocumentImages extends interact
{
	public $params = array( 'document'  => null,
							'imageData' => null );
	
	public function setDocumentParam( InteractObject $int_obj )
	{
		$this->params[ 'document' ] = $int_obj;
	}
	
	/**
	 * Array of ImageData objects
	 * @param array $imageDataArray
	 */
	public function setImageDataParam( array $imageDataArray )
	{
		$this->params[ 'imageData' ] = $imageDataArray;
	}
}

/*
 * Doesnt exist in the wsdl
 */
class updateContentLibraryItem extends interact
{
	public $params = array();
}