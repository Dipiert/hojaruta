<?php 

require_once("controllers/DB.php");

class Item {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new DB;
        $this->conn = $this->db->getConnection();
    }

    private function prepareString($str) {
        $str = utf8_decode($str);
        return $str;
    }

    private function prepareStrings($strs) {
        foreach ($strs as &$str) {
            $str = $this->prepareString($str);
        }
    }

    public function storeItem($author, $title, $stockNumber) {
        $this->prepareStrings([$author, $title, $stockNumber]);       
        $sql = $this->conn->prepare("INSERT INTO item (autor, titulo, nro_inventario) VALUES (?, ?, ?)");
        $sql->bind_param("sss", $author, $title, $stockNumber);
        if ($sql->execute()) {
            $sql = $this->conn->prepare("INSERT INTO estado_item (nro_inventario, id_estado) VALUES (?, 0)");
            $sql->bind_param("s", $stockNumber);
            if ($sql->execute()) {
                echo nl2br("Se ha registrado el item correctamente");
            }
        }
    }

    private function store($conn, $sql) {
        defined('MYSQL_CODE_DUPLICATE_KEY') || define('MYSQL_CODE_DUPLICATE_KEY',1062);   
        if (!mysqli_query($conn, $sql)) {
            if (mysqli_errno($conn) == MYSQL_CODE_DUPLICATE_KEY) {            
                echo nl2br("El número de inventario cargado ya existe");
            } else {
                echo nl2br("Ocurrio un error con la consulta SQL");
            }        
        } else {
            return true;
        }
    }
}

