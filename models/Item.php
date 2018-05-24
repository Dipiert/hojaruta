<?php

require_once(dirname(__FILE__) . "/../controllers/DBController.php");
require_once(dirname(__FILE__) . "/../controllers/ItemController.php");

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
        $sql = "INSERT INTO item (autor, titulo, nro_inventario, creado_el) VALUES (?, ?, ?, ?)";
    	$stmt = $this->conn->prepare($sql);
        try {
            $execResult = $stmt->execute(array($author, $title, $stockNumber, NULL));
            if ($execResult) {
                $sql = "INSERT INTO estado_item (nro_inventario, id_estado) VALUES (?, 0)";
                $stmt = $this->conn->prepare($sql);
                $execResult = $stmt->execute(array($stockNumber));
                $msg = $execResult? "Se ha agregado un item exitosamente" : "Ha ocurrido un error al registrar el estado inicial del item";
                echo "<script type='text/javascript'>alert('" . $msg . "')</script>";
            } else {
                echo "<script type='text/javascript'>alert(\"Ha ocurrido un error al insertar el item\")</script>";
            }
        } catch(PDOException $e) {
            $msg = $e->getMessage();
            switch($e->errorInfo[1]) {
                case 1062:
                    $msg = "El número de inventario que intenta registrar ya está asociado a un Item";
                    break;
                case 1452:
                    $msg = "Asegúrese de tener registrados los estados posibles del item en la DB";
                    break;
                default:
                    $msg = $e->getMessage();
            }
            echo "<script type='text/javascript'>alert('" . $msg . "')</script>";
        }
	}

	public function getAllCounts() {
        $sql = "SELECT estado, COUNT(estado) as cantidad FROM estado_item ei, estado e WHERE ei.id_estado=e.id GROUP BY id_estado";
        return $this->getRows($sql);
    }

    public function getItemsForEachState() {
        $sql = "SELECT estado, nro_inventario FROM estado_item ei, estado e WHERE e.id=ei.id_estado ORDER BY id_estado";
        return $this->getRows($sql);
    }

    private function getRows($sql){
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }
    }




}