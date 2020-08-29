<?php

use Jaw\GauntCore\Request;
use Jaw\GauntCore\App;

// Set the App Root, to be used throughout and to let the bootstrap file know it's ok to proceed
define('APP_ROOT', dirname(__FILE__));

// Get the bootstrap file to get this going
require APP_ROOT . '/config/bootstrap.php';

// Are we in dev mode?
$is_dev_mode = ( $_GET['dev_mode'] == 1 );

$request = Request::create();
App::run( $request, $is_dev_mode );