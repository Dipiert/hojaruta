<?php
session_start();
require_once("DB.php");
$db = new DB;
$conn = $db->getConnection();

if (isCorrectDataLogin()) {
	$username = mysqli_real_escape_string($conn,$_POST['user']);
	$password = md5(mysqli_real_escape_string($conn,$_POST['password']));
	$query = 'SELECT * FROM usuarios WHERE usuario='. "'$username' " . 'AND contrasena=' . "'$password'";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		mysqli_error($conn);
	} else {
		if (mysqli_num_rows($result) > 0) {
			login($username);
			$home = 'menu.php';
			header('Location: '. $home);
		} else {
			echo "Nombre de usuario y/o contraseña incorrecta";
		}
	}
} else {
	echo "Login incorrecto";
}

function isCorrectDataLogin() {
	return (isset($_POST['user']) && isset($_POST['password']));
}

function login($username) {
	$_SESSION['loggedin'] = true;
	$_SESSION['username'] = $username;
	$_SESSION['start'] = time();
	$_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
}