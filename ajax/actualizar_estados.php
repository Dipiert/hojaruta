<?php 

include ('../includes/login_required.php');
require_once("../controllers/DBController.php");
$state = new State();
echo $state->updateState();

class State {
	private $conn;
	private $db;

	function __construct() {
		$this->db = new DBController();
		$this->conn = $this->db->getConnection();
	}

	function updateState() {	
		$newState = $_POST['newState'];
		$stockNumber = $_POST['stockNumber'];
		$sql = 'UPDATE estado_item
    			SET id_estado = :id_estado
    			WHERE nro_inventario = :nro_inventario';
    	$stmt = $this->conn->prepare($sql);
    	$execResult = $stmt->execute(array(':id_estado' => $newState, ':nro_inventario' => $stockNumber));
    	if ($execResult) {
    		return $this->storeMovement();
    	} else {
    		echo "Ha ocurrido un error";
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
			if ($idOldState === false) {
				return "No puedo seguir";
			} else {
				$stockNumber = $_POST['stockNumber'];
				$actualState = $_POST['newState'];
				$fecha = $this->getFecha();
				$sql = "INSERT INTO movimientos(id_responsable, fecha, nro_inventario, id_estado_anterior, id_estado_nuevo) VALUES(?, ?, ?, ?, ?)";
				$stmt = $this->conn->prepare($sql);
				$execResult = $stmt->execute(array($idResponsible, $fecha, $stockNumber, $idOldState, $actualState));
				if ($execResult) {
					return "Se ha cambiado el estado satisfactoriamente";
				} else {
					return "error";
				}
			}			
		} else {
			return "ERROR";
		}	
	}

	function getIdResponsible($responsible) {
		defined('INVALID_RESPONSIBLE') || define('INVALID_RESPONSIBLE', -1);
		$sql = "SELECT id FROM usuarios WHERE usuario = '$responsible'";
		$stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);		
		if ($stmt) {
			$row = $stmt->fetch();
			return $row['id'];	
		}
		else {
			echo "Ha ocurrido un error con el usuario";
		}
	}

	function getIdState($oldState) {
		defined('INVALID_STATE') || define('INVALID_STATE', -1);
		$sql = "SELECT id FROM estado WHERE estado LIKE :estado collate utf8_general_ci";
		$stmt = $this->conn->prepare($sql);		
		//$stmt->bindParam(':estado', $oldState, PDO::PARAM_STR);
		//var_dump($stmt);
		$execResult = $stmt->execute(array(':estado' => $oldState));
		if ($execResult) {		
			$row = $stmt->fetch();
			return $row['id'];	
		} else {
			return INVALID_STATE;
		}
	}

	function getResponsible() {
		require_once(dirname(__FILE__) . "/../controllers/SessionController.php");
		$session = new SessionController();
		return $session->getUsername();
	}

	function getFecha() {
		return date('Y-m-d');	
	}

}

