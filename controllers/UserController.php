<?php
require_once(dirname(__FILE__) . "/DBController.php");
require_once(dirname(__FILE__) . "/SessionController.php");

class UserController {
	private $db;
	private $conn;
	private $session;
	private $user;
	private $password;

	public function __construct() {
		$this->db = new DBController();
		$this->conn = $this->db->getConnection();
		$this->session = new SessionController();
	}

	public function setUser($user) {
		$this->user = $user;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	public function getAllUsers() {
		$sql = "SELECT usuario FROM usuarios";
		$stmt = $this->conn->prepare($sql);
		$execResult = $stmt->execute();
		$usuarios = [];
		if ($execResult) {
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				array_push($usuarios, $row['usuario']);		
			}
		}

		return $usuarios;
	}

	public function login() {
		if ($this->isCorrectDataLogin()) {
			$this->password = md5($this->password);
			$sql = "SELECT admin FROM usuarios WHERE usuario = ? AND contrasena = ?";			
			$stmt = $this->conn->prepare($sql);
			$execResult = $stmt->execute(array($this->user, $this->password));
			if ($execResult) {
				$row = $stmt->fetch(PDO::FETCH_ASSOC);				
				if ($row & count($row) > 0) {
					$isAdmin = $row['admin'];
					$this->session->login($this->user, intval($isAdmin));
					$home = 'menu.php';
					header('Location: '. $home);
				} else {
					echo "Nombre de usuario y/o contraseña incorrecta";
				}
			} else {
				echo $this->conn->error;
			}
		} else {
			echo "Login incorrecto";
		}
	}

	private function isCorrectDataLogin() {
		return (isset($_POST['user']) && isset($_POST['password']));
	}
}