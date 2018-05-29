<?php

require_once(dirname(__FILE__) . "/../controllers/DBController.php");
//require_once(dirname(__FILE__) . "/../controllers/ItemController.php");

class Movement {
	private $db;
    private $conn;
    //private $item;

    public function __construct() {
        $this->db = new DBController();
        $this->conn = $this->db->getConnection();
        //$this->item = new ItemController();
    }

	public function storeMovement($author, $title, $stockNumber) {

	}

	public function getAllCounts() {

    }

    public function getItemsForEachState() {
        /*$sql = "SELECT estado, nro_inventario FROM estado_item ei, estado e WHERE e.id=ei.id_estado ORDER BY id_estado";
        return $this->getRows($sql);*/
    }

    public function getItemsMoved($desde, $hasta) {
        $sql = "SELECT nro_inventario FROM movimientos WHERE fecha BETWEEN \"$desde\" AND \"$hasta\" GROUP BY nro_inventario";
        echo "<script>console.log('" . $sql .  "')</script>";
        return $this->getRows($sql);
    }

    public function getItemsMovedByResponsible($desde, $hasta) {
        $sql = "SELECT u.usuario as responsable, COUNT(nro_inventario) as total
                FROM movimientos m INNER JOIN usuarios u ON u.id = m.id_responsable 
                WHERE m.fecha BETWEEN \"$desde\" AND \"$hasta\" GROUP BY u.usuario";
        return $this->getRows($sql);
        //echo "<script>console.log('" . $sql .  "')</script>";
        //return $this->getRows($sql);
    }


    private function getRows($sql){
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }
    }




}