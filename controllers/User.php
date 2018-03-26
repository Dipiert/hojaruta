<?php
require_once("controllers/DB.php");
require_once("controllers/Session.php");

class User {
	private $db;
	private $conn;
	private $session;
	private $user;
	private $password;

	public function __construct($user, $password) {
		$this->db = new DB;
		$this->conn = $this->db->getConnection();
		$this->session = new Session;
		$this->user = $user;
		$this->password = $password;
	}

	public function login() {
		if ($this->isCorrectDataLogin()) {
			$this->password = md5($this->password);
			$stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ?");
			$stmt->bind_param("ss", $this->user, $this->password);
			if ($stmt->execute()) {
				$result = $stmt->get_result();
				if ($result->num_rows > 0) {
					$this->session->login($this->user);
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