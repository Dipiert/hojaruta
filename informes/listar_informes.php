<?php
include ('../includes/login_required.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Listar Informes</title>
	<meta charset="utf-8">
	<meta name="description" content="Hoja de Ruta - Listar Informes">
	<meta author="Damián Rotta">
</head>
<body>
    <form action="frm_tipo_reporte.php" method="POST">
        <input type="hidden" name="title" value="Cant de Items en cada estado">
        <input type="hidden" name="report_name" value="cant_items_en_cada_estado">
        <input type="submit" value="Cant. de Items en cada estado"/>
    </form>
    <form action="frm_tipo_reporte.php" method="POST">
        <input type="hidden" name="title" value="Items en cada estado">
        <input type="hidden" name="report_name" value="items_en_cada_estado">
        <input type="submit" value="Items en cada estado"/>
    </form>


<p>
	<a>Items movidos por fecha</a>
</p>
<p>
	<a>Items movidos por responsable</a>
<p>
</body>
</html>