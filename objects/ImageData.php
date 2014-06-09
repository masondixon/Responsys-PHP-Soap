<?php

class ImageData
{
	public $image,
		   $imageName;
	
	public function setImage( $imageData )
	{
		$this->image = $imageData;
	}
	
	public function setImageName( $imageName )
	{
		$this->imageName = $imageName;
	}
}