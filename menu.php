<?php
include('includes/login_required.php');
include('controllers/SessionController.php');
if (isset($_POST['logout']) && $_POST['logout'] == "Cerrar Sesión") {
    $session = new SessionController();
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
   <a href="frm_mover_item.html">Mover Item</a>
   <a href="informes/listar_informes.php">Informes</a>
   <!--
   <a href="admin/states_abm.php">Gestionar Estados</a>
   <a href="informes/users_abm.php">Gestionar Usuarios</a>
   -->
   <form method="post">
		<input type='submit' value='Cerrar Sesión' name='logout'>
   </form>
</body>
</html>
