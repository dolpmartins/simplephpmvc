<?php
namespace App\Core;

use \PDO;

class Database{
	
	protected $conn;

	public function __construct() {
		global $config;
        $this->conn = new PDO("sqlsrv:Server=".$config['host'].";Database=".$config['dbname'], $config['dbuser'],$config['dbpass']);
	}

}
?>