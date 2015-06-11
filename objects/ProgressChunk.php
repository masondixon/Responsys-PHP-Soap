<?php

class ProgressChunk
{
	CONST CHUNK_10K  = "CHUNK_10K";
	CONST CHUNK_50K  = "CHUNK_50K";
	CONST CHUNK_100K = "CHUNK_100K";
	CONST CHUNK_500K = "CHUNK_500K";
	CONST CHUNK_1M   = "CHUNK_1M";
	
	private $progressChunk;

	public function setProgressChunk( $chunk )
	{
		$this->progressChunk = $chunk;
	}
	
	public function getProgressChunk()
	{
		return $this->progressChunk;
	}
}