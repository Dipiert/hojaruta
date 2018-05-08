<?php
	require_once('controllers/UserController.php');
	session_start();
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {	
	    header('Location: menu.php');
	} elseif (areFieldsSent()) {
		$user = $_POST['user'];
		$password = $_POST['password'];
		$userInstance = new UserController();
		$userInstance->setUser($user);
		$userInstance->setPassword($password);
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
	<meta name="description" content="Hoja de Ruta - Login">
	<meta name="author" content="Damián Rotta">
	<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="assets/styles/style.css"/>
</head>
<body>
<h1 class="title">Hoja de ruta BPM</h1>
<div class="login-box">
    <img src="assets/images/avatar.png" class="avatar">
    <form action="index.php" method="POST">
        <p>
            <label>Usuario</label>
            <input type="text" name="user" title="Ingrese su usuario" required placeholder="Ingrese su usuario">
        </p>
        <p>
            <label>Contraseña</label>
            <input type="password" name="password" title="Ingrese su contraseña" required placeholder="Ingrese su contraseña">
        </p>
        <p>
            <input type="submit" id="sendLoginData" value="Ingresar">
        </p>
    </form>
</div>
</body>
</html>