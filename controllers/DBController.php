<?php

class DBController {
   private $connection;

   public function __construct() {
       if (is_null($this->connection)) {
           $conf = require_once(dirname(__FILE__) . "/../config/DBConfig.php");
           $dsn = $conf["db_engine"] . ":host=" . $conf["host"] . ";dbname=" . $conf["dbname"];
           try {
               $this->connection = new PDO($dsn, $conf['user'], $conf['password'], $conf['options']);
               $this->connection->exec("set names utf8");
           } catch (PDOException $e) {
               echo "<script type='text/javascript'>alert(\"Falló la conexión: " . $e->getMessage() . "\")</script>";
               $this->connection->close();
           }

       } else {
           return getConnection();
       }
   }

   public function getConnection() {
      return $this->connection;
   }

}
