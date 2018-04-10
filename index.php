<?php
	require_once('controllers/UserController.php');
	session_start();
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {	
	    header('Location: menu.php');
	} elseif (areFieldsSent()) {
		$user = $_POST['user'];
		$password = $_POST['password'];
		$userInstance = new UserController($user, $password);
		$userInstance->login();
	}

	function areFieldsSent() {
		return isset($_POST['user']) && isset($_POST['password']);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Inicio de Sesión</title>
	<meta charset="utf-8">
	<meta description="Hoja de Ruta - Login">
	<meta author="Damián Rotta">
	<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
    </script>
</head>
<body>
<form action="index.php" method="POST">
	<p>
		<label>Usuario:</label>
		<input type="text" name="user">
	</p>
	<p>
		<label>Contraseña:</label>
		<input type="password" name="password">
	</p>
	<p>
		<input type="submit" id="sendLoginData" value="Ingresar">
	</p>

</form>
</body>
</html>