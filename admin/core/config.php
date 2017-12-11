<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	$GLOBALS['config'] = array(
	    'mysql_config' => array(
	        'host'      => 'localhost',
            'dbUser'    => 'root',
            'dbPass'    => 'root',
            'dbName'    => 'shopping'
        ),
        'session_config' => array(
            'session_name'  => 'user',
            'session_token' => 'token'
        )
    );
	spl_autoload_register(function($class){
		require_once 'classes/' . $class . '.php';
	});

	$db = new Database();
	$user = new Users();
 ?>