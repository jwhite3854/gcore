<?php

// Die if accessed directly
if ( defined( 'APP_ROOT' ) ) {
	require_once APP_ROOT . '/vendor/autoload.php';
} else {
    die('No.');
}

define('APP_DOMAIN', 'http://localhost:8084');
define('APP_REDIRECT_BASE', '/');
define('APP_MAIN_TITLE', 'Pickles');