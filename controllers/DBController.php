<?php

class DBController {
   private $connection;

   public function __construct() { 
      $conf = require_once(dirname(__FILE__) . "/../config/DBConfig.php");
      $dsn = $conf["db_engine"] . ":host=" . $conf["host"] . ";dbname=" . $conf["dbname"];
      try {
         $this->connection = new PDO($dsn, $conf['user'], $conf['password'], $conf['options']);
         
      } catch (PDOException $e) {
         echo 'Falló la conexión: ' . $e->getMessage();
      }
      $this->connection->exec("set names utf8");
   }

   public function getConnection() {
      return $this->connection;
   }

}
