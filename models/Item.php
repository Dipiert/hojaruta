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
        $sql = "INSERT INTO item (autor, titulo, nro_inventario) VALUES (?, ?, ?)";
    	$stmt = $this->conn->prepare($sql);
        try {
            $execResult = $stmt->execute(array($author, $title, $stockNumber));
            if ($execResult) {
                $sql = "INSERT INTO estado_item (nro_inventario, id_estado) VALUES (?, 0)";
                $stmt = $this->conn->prepare($sql);
                $execResult = $stmt->execute(array($stockNumber));
                if ($execResult) {
                    echo "Exito";
                } else {
                    echo "Ha ocurrido un error al registrar el estado inicial del item";
                }
            } else {
                echo "Ha ocurrido un error al insertar el item";
            }
        } catch(PDOException $e) {
            echo "El número de inventario que intenta registrar ya está asociado a un Item.";
        }
	}
}