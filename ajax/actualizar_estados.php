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

	function isValidResponsible($responsible) {
		$isValid = true;
		if (is_null($responsible)){
			echo "Ha ocurrido un error con la sesión";
			$isValid = false;
		}
		return $isValid;
	}

	function storeMovement() {		
		$responsible = $this->getResponsible();
		if ($this->isValidResponsible($responsible)) {
			$idResponsible = $this->getIdResponsible($responsible);
			$oldState = $_POST['oldState'];
			
			$idOldState = $this->getIdState($oldState);

			$stockNumber = $_POST['stockNumber'];
			$actualState = $_POST['newState'];
			$fecha = $this->getFecha();
			$stmt = $this->conn->prepare("INSERT INTO movimientos(id_responsable, fecha, nro_inventario, id_estado_anterior, id_estado_nuevo) VALUES(?, ?, ?, ?, ?)");
			$stmt->bind_param("issii", $idResponsible, $fecha, $stockNumber, $idOldState, $actualState);
			if ($stmt->execute()) {
				echo "Se ha cambiado el estado satisfactoriamente";
			} else {
				return mysqli_error($this->conn);
			}
		} else {
			echo "ERROR";
		}	
	}

	function getIdState($oldState) {
		echo "oldState es $oldState";
		defined('INVALID_STATE') || define('INVALID_STATE', -1);
		//mysqli_set_charset($this->conn,"utf8");
		var_dump($this->conn);
		$stmt = $this->conn->prepare("SELECT id FROM estado WHERE estado = ?");
		$stmt->bind_param("s", $oldState);
		var_dump($stmt);
		if ($stmt->execute()) {
			$result = $stmt->get_result();

			$row = mysqli_fetch_assoc($result);
			
			return $row['id'];
		} else {
			return INVALID_STATE;
		}
	}

	function getIdResponsible($responsible) {
		//defined('INVALID_RESPONSIBLE') || define('INVALID_RESPONSIBLE', -1);
		$stmt = $this->conn->prepare("SELECT id FROM usuarios WHERE usuario LIKE ?");
		$stmt->bind_param("s", $responsible);
		if ($stmt->execute()) {
			$result = $stmt->get_result();
			$row = mysqli_fetch_assoc($result);	
			return $row['id'];
		} else {
			echo "Ha ocurrido un error con el usuario";
			return null;
		}
	}

	function getResponsible() {
		require_once(dirname(__FILE__) . "/../controllers/Session.php");
		$session = new Session;
		return $session->getUsername();
	}

	function getFecha() {
		return date('Y-m-d');	
	}

}

