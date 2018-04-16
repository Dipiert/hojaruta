<!DOCTYPE html>
<html>
<head>
	<title>Gestión de Usuarios</title>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
    <script
            src="http://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script
            src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.jquery.min.js"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.5/chosen.min.css">
</head>
<body>

	<select class="chosen-select" title="Seleccione un usuario">
		<?php
		require_once(dirname(__FILE__) . "/../controllers/UserController.php");
		$user = new UserController();
		$users = $user->getAllUsers();
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