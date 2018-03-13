<?php

include ('../includes/login_required.php');
require_once("../DB.php");
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
		$query = "UPDATE estado_item SET id_estado = '" . $newState . '\' WHERE nro_inventario = \''. $stockNumber. "'";
		$result = mysqli_query($this->conn, $query);
		if (!$result) {
	        mysqli_error($conn);
	    }
	    return $this->storeMovement();
	    //return $query; 
	}

	function storeMovement() {
		$responsable = $this->getResponsable();
		$idResponsable = $this->getIdResponsable($responsable);
		
		$oldState = $_POST['oldState'];
		$idOldState = $this->getIdState($oldState);

		$stockNumber = $_POST['stockNumber'];
		$actualState = $_POST['newState'];

		$fecha = $this->getFecha();
		$query = "INSERT INTO movimientos
				  VALUES('$idResponsable', $fecha, $stockNumber, $idOldState, $actualState)";
		return $query;
	}

//INSERT INTO movimientos VALUES(-1, 2018-03-13, 0, -1, 0)

	function getIdState($oldState) {
		$query = "SELECT id FROM estados WHERE estado LIKE '$oldState'";
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

