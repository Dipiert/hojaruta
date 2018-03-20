<?php
include('includes/login_required.php');
include('controllers/Session.php');
if (isset($_POST['logout']) && $_POST['logout'] == "Cerrar Sesión") {
    $session = new Session;
    $session->logout();
}
?>

<!DOCTYPE html>
<html>
<head>
   <title>Menú Principal</title>
</head>
<body>
   <a href="frm_registrar_item.php">Ingresar Item</a>
   <a href="mover_item.html">Mover Item</a>
   <a href="informes/listar_informes.php">Informes</a>
   <form method="post">
		<input type='submit' value='Cerrar Sesión' name='logout'>
   </form>
</body>
</html>
