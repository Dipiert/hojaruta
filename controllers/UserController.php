<?php
require_once("controllers/DBController.php");
require_once("controllers/SessionController.php");

class UserController {
	private $db;
	private $conn;
	private $session;
	private $user;
	private $password;

	public function __construct($user, $password) {
		$this->db = new DBController();
		$this->conn = $this->db->getConnection();
		$this->session = new SessionController();
		$this->user = $user;
		$this->password = $password;
	}

	public function login() {
		if ($this->isCorrectDataLogin()) {
			$this->password = md5($this->password);
			$sql = "SELECT admin FROM usuarios WHERE usuario = ? AND contrasena = ?";
			
			$stmt = $this->conn->prepare($sql);
			$execResult = $stmt->execute(array($this->user, $this->password));
			if ($execResult) {
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				if (count($row) > 0) {
				//if ($stmt->fetchColumn() > 0) {
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