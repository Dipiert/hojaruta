<?php

//namespace models;

require_once(dirname(__FILE__) . "/../controllers/DBController.php");
require_once(dirname(__FILE__) . "/../controllers/ItemController.php");
//require_once(dirname(__FILE__) . "/../models/Item.php");
//require("../vendor/autoload.php");
//require(dirname(__FILE__) . "/../vendor/autoload.php");
//use controllers\DB;
//use controllers\Item;

class Item {
	private $db;
    private $conn;
    private $item;

    public function __construct() {
        $this->db = new DBController();
        $this->conn = $this->db->getConnection();
        $this->item = new ItemController();
    }

	public function storeItem($author, $title, $stockNumber) {
		$this->item->prepareStrings([$author, $title, $stockNumber]);

		$sql = $this->conn->prepare("INSERT INTO item (autor, titulo, nro_inventario) VALUES (?, ?, ?)");
		$sql->bind_param("sss", $author, $title, $stockNumber);
		if ($sql->execute()) {
			$sql = $this->conn->prepare("INSERT INTO estado_item (nro_inventario, id_estado) VALUES (?, 0)");
			$sql->bind_param("s", $stockNumber);
			if ($sql->execute()) {
				echo nl2br("Se ha registrado el item correctamente");
			}
		}
        $this->conn->close();
	}

    private function store($conn, $sql) {
        defined('MYSQL_CODE_DUPLICATE_KEY') || define('MYSQL_CODE_DUPLICATE_KEY',1062);   
        if (!$this->conn->query($sql)) {
            if ($this->conn->mysqli_errno == MYSQL_CODE_DUPLICATE_KEY) {            
                echo nl2br("El número de inventario cargado ya existe");
            } else {
                echo nl2br("Ocurrio un error con la consulta SQL");
            }        
        } else {
            return true;
        }
    }

}