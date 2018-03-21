<?php
require_once("controllers/DB.php");
require_once("controllers/Session.php");

class User {
	private $db;
	private $conn;
	private $session;

	public function __construct() {
		$this->db = new DB;
		$this->conn = $this->db->getConnection();
		$this->session = new Session;
	}

	public function login($user, $password) {
		if ($this->isCorrectDataLogin()) {
			$password = md5($password);
			$stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ?");
			$stmt->bind_param("ss", $user, $password);
			if ($stmt->execute()) {
				$result = $stmt->get_result();
				if (mysqli_num_rows($result) > 0) {
					$this->session->login($username);
					$home = 'menu.php';
					header('Location: '. $home);
				} else {
					echo "Nombre de usuario y/o contraseña incorrecta";
				}
			} else {
				mysqli_error($this->conn);
			}
		} else {
			echo "Login incorrecto";
		}
	}

	private function isCorrectDataLogin() {
		return (isset($_POST['user']) && isset($_POST['password']));
	}
}