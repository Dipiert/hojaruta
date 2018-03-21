<?php

include ('../includes/login_required.php');
require_once("../controllers/DB.php");
$state = new State();
echo $state->updateState();

class State {
	private $conn;
	private $db;

	function __construct() {
		$this->db = new DB;
		$this->conn = $this->db->getConnection();
	}

	function updateState() {	
		$newState = $_POST['newState'];
		$stockNumber = $_POST['stockNumber'];
		$stmt = $this->conn->prepare("UPDATE estado_item SET id_estado = ? WHERE nro_inventario = ?");
		$stmt->bind_param("ss", $newState, $stockNumber);
		if ($stmt->execute()) {
			return $this->storeMovement();
		} else {
			return mysqli_error($this->conn);
		}
	}

	function storeMovement() {
		$responsable = $this->getResponsable();
		$idResponsable = $this->getIdResponsable($responsable);
		
		$oldState = $_POST['oldState'];
		$idOldState = $this->getIdState($oldState);
		$stockNumber = $_POST['stockNumber'];
		$actualState = $_POST['newState'];
		$fecha = $this->getFecha();
		$stmt = $this->conn->prepare("INSERT INTO movimientos(id_responsable, fecha, nro_inventario, id_estado_anterior, id_estado_nuevo) VALUES(?, ?, ?, ?, ?)");
		$stmt->bind_param("sssss", $idResponsable, $fecha, $stockNumber, $idOldState, $actualState);
		if ($stmt->execute()) {
			return "Se ha registrado un movimiento exitosamente";
		} else {
			return mysqli_error($this->conn);
		}
	}

	function getIdState($oldState) {
		$query = "SELECT id FROM estado WHERE estado LIKE '$oldState'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			return -1;
		} else {
			$row = mysqli_fetch_assoc($result);	
			return $row['id'];
		}
	}

	function getIdResponsable($responsable) {
		$query = "SELECT id FROM usuarios WHERE usuario LIKE '$responsable'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
			return -1;
		} else {
			$row = mysqli_fetch_assoc($result);	
			return $row['id'];
		}		
	}

	function getResponsable() {
		return $_SESSION['username'];
	}

	function getFecha() {
		return date('Y-m-d');	
	}

}

