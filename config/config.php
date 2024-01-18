<?php
require 'environment.php';
global $config;
if(ENVIRONMENT == 'development') {
	$config['dbname'] = 'dbname';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'user';
	$config['dbpass'] = 'pass';
} else {
	$config['dbname'] = 'dbname';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'user';
	$config['dbpass'] = 'pass';
}

?>
