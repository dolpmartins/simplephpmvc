<?php
require 'environment.php';
global $config;
if(ENVIRONMENT == 'development') {
	$config['dbname'] = 'dbsellersys';
	$config['host'] = 'DESKTOP-F671MGP\SQLEXPRESS';
	$config['dbuser'] = 'sa';
	$config['dbpass'] = 'Mudar@123';
} else {
	$config['dbname'] = 'dbname';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'user';
	$config['dbpass'] = 'pass';
}

?>