<!DOCTYPE html>
<html>
<head>
	<title>Gestión de Usuarios</title>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
	<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
	<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css">
</head>
<body>

	<select class="chosen-select" title="Seleccione un usuario">
		<?php
		require_once(dirname(__FILE__) . "/../controllers/UserController.php");
		$user = new UserController();
		$users = $user->getAllUsers();
		echo "<script>console.log(" .  json_encode($users) .  ")</script>";
		foreach ($users as $user) {
			echo "<option>" . $user . "</option>";
		}
		?>
	</select>
</body>
</html>
<script type="text/javascript">
$(".chosen-select").chosen();
</script>