<!DOCTYPE html>
<html>
<head>
	<title>Inicio de Sesión</title>
	<meta charset="utf-8">
	<meta description="Hoja de Ruta - Login">
	<meta author="Damián Rotta">
</head>
<body>
<form>
	<p>
		<label>Usuario:</label>
		<input type="text" name="user">
	</p>
	<p>
		<label>Contraseña:</label>
		<input type="text" name="password">
	</p>
	<p>
		<input type="submit" value="Ingresar">
	</p>
</form>
</body>
</html>

<?php
session_start();
require_once("DB.php");
$db = new DB;
$conn = $db->getConnection();
$username = mysqli_real_escape_string($_POST['user']);
$password = mysql_real_escape_string($_POST['password']);
$query = "SELECT * FROM usuarios WHERE usuario=$user AND password=$password";
$result = mysqli_query($conn, $query);
if (!$result) {
    mysqli_error($conn);
} else {
	if (mysqli_num_rows($result) > 0) {
		$row = mysql_fetch_assoc($result);
		if (password_verify($password, $row['password'])) {
			login($username);
		}
	} 
}

function login($username) {
	$_SESSION['loggedin'] = true;
	$_SESSION['username'] = $username;
	$_SESSION['start'] = time();
	$_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
}