<?php

// Lets be helpful and set up include paths with the proper separator based on OS
if ( ! defined( "PATH_SEPARATOR" ) ) 
{
	if ( strpos( $_ENV[ "OS" ], "Win" ) !== false )
	{
		define( "PATH_SEPARATOR", ";" );
	}
	else 
	{
		define( "PATH_SEPARATOR", ":" );
	}
}

// Set base include path to directory containing this file
$base_include_path = __DIR__;

// set new runtime include path for requires includes
set_include_path( $base_include_path . "/includes" . PATH_SEPARATOR . $base_include_path . "/objects" );

echo " *** INCLUDING REQUIRED FILES/CLASSES *** \n";

//echo " New include path : " . get_include_path() . "\n";

//include base
echo " Including interact base class interact.php \n";
include 'interact.php';


$include_paths = get_include_path();

//print_r( $get_include_paths );

$include_paths_array = explode( PATH_SEPARATOR, $include_paths );

foreach ( $include_paths_array as $path )
{
	$includes = glob( $path . "/*.php" );
	
	foreach( $includes as $include )
	{
		echo " including " . $include . "\n";
		include $include;	
	}
}

// Set up a global config file for api user values and soap client wsdl and endpoint values
global $config_file;
echo " *** Loading config file *** \n";
$config_file = parse_ini_file( "config.inc", TRUE );