<?php

echo "*** BOOTSTRAP ***\n";

//include base
include 'interact.php';

// Include the call type classes
$sdk_files = glob( '../../includes/*.php');

foreach( $sdk_files as $file )
{
	echo "Including file: " . $file . "\n";
	include( $file );
}

// Include objects

// Include the call type classes
$objects = glob( '../../objects/*.php');

foreach( $objects as $object )
{
	echo "Including object ( file/class ): " . $object . "\n";
	include( $object );
}

