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
			$username = mysqli_real_escape_string($this->conn,$user);
			$password = md5(mysqli_real_escape_string($this->conn,$password));
			$query = 'SELECT * 
					  FROM usuarios
					  WHERE usuario='. "'$username' " . 'AND contrasena=' . "'$password'";
			$result = mysqli_query($this->conn, $query);
			if (!$result) {
				mysqli_error($this->conn);
			} else {
				if (mysqli_num_rows($result) > 0) {
					$this->session->login($username);
					$home = 'menu.php';
					header('Location: '. $home);
				} else {
					echo "Nombre de usuario y/o contraseña incorrecta";
				}
			}
		} else {
			echo "Login incorrecto";
		}		
	}

	private function isCorrectDataLogin() {
		return (isset($_POST['user']) && isset($_POST['password']));
	}
}