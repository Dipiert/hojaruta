<?php

class DB {
	private $_connection;

	public function __construct() {
		$conf = require_once('DBConfig.php');
		$this->_connection = new mysqli(
									$conf["server"],
									$conf["user"],
									$conf["password"],
			 						$conf["db"]
			 					);
		if(mysqli_connect_error()) {
			trigger_error("Failed to connect to MySQL: " . mysql_connect_error(),
				 E_USER_ERROR);
		}
	}

	public function getConnection() {
		return $this->_connection;
	}

}