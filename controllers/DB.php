<?php

class DB {
   private $_connection;

   public function __construct() {
      $conf = require_once(dirname(__FILE__) . "/../config/DBConfig.php");
      $this->connection = new mysqli(
                           $conf["server"],
                           $conf["user"],
                           $conf["password"],
                           $conf["db"]
                        );
      $this->connection->set_charset("utf-8");     
      if($this->connection->connect_error) {
         trigger_error("Failed to connect to MySQL: " . $this->connection->connect_error,
             E_USER_ERROR);
      }
   }

   public function getConnection() {
      return $this->connection;
   }

}
