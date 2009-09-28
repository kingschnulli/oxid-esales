<?php

// Setting error reporting mode
    error_reporting( E_ALL ^ E_NOTICE );

/**
 * Returns shop base path.
 *
 * @return string
 */
function getShopBasePath()
{
    return dirname(__FILE__).'/';
}

/**
 * Returns false.
 *
 * @return bool
 */
if ( !function_exists( 'isAdmin' )) {
    function isAdmin()
    {
        return false;
    }
}

// custom functions file
include getShopBasePath() . 'modules/functions.php';

// Generic utility method file
require_once getShopBasePath() . 'core/oxfunctions.php';


// Including main ADODB include
require_once getShopBasePath() . 'core/adodblite/adodb.inc.php';
// set the exception handler already here to catch everything, also uncaught exceptions from the config or utils

// initializes singleton config class
$myConfig = oxConfig::getInstance();

if ( ! defined( "PATH_SEPARATOR" ) ) {
  if ( strpos( $_ENV[ "OS" ], "Win" ) !== false )
    define( "PATH_SEPARATOR", ";" );
  else
    define( "PATH_SEPARATOR", ":" );
}

set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__). "/core/");

require_once 'Zend/Controller/Front.php';
Zend_Controller_Front::run('views');