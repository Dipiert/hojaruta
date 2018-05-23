<?php 

include ( dirname(__FILE__) .  '/../includes/login_required.php');
require_once(dirname(__FILE__) . '/../controllers/DBController.php');
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
    		$this->storeMovement();
    	} else {
            return "Ha ocurrido un error al actualizar el estado";
        }
	}

	function isValidResponsible($responsible) {
		$isValid = true;
		if (is_null($responsible)){
			echo "<script type='text/javascript'>alert(\"Ha ocurrido un error con la sesión\")</script>";
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
			if ($idOldState !== false) {
				$stockNumber = $_POST['stockNumber'];
				$actualState = $_POST['newState'];
				$fecha = $this->getFecha();
				$sql = "INSERT INTO movimientos(id_responsable, fecha, nro_inventario, id_estado_anterior, id_estado_nuevo) VALUES(?, ?, ?, ?, ?)";
				$stmt = $this->conn->prepare($sql);
                try {
         			$stmt->execute(array($idResponsible, $fecha, $stockNumber, $idOldState, $actualState));
      			} catch (PDOException $e) {
      				if ($e->errorInfo[1] === 1062) {
      					echo "<script type='text/javascript'>alert(\"Cuidado: El movimiento que intenta llevar a cabo para ese número de item ya fue realizado hoy y no se registrará.\")</script>";
      				} else {
      					echo $e->getMessage();
      				}
      			}
			}			
		} else {
			echo "<script type='text/javascript'>alert(\"Ha ocurrido un error al obtener el responsable del movimiento\")</script>";
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
		return 'Ha ocurrido un error con el usuario';
	}

	function getIdState($oldState) {
		defined('INVALID_STATE') || define('INVALID_STATE', -1);
		$sql = "SELECT id FROM estado WHERE estado LIKE :estado collate utf8_general_ci";
		$stmt = $this->conn->prepare($sql);		
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

