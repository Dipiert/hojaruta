<?php
include ('../includes/login_required.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Listar Informes</title>
    <?php include('../includes/header.php') ?>
</head>
<body>
<div class="breadcrumbs">
    <a href="../menu.php">Menú Principal</a> / Listar Informes</body> <br /><br />
</div>
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
    <form action="frm_desde_hasta.php" method="POST">
        <input type="hidden" name="title" value="Items movidos por fecha">
        <input type="hidden" name="report_name" value="items_movidos_por_fecha">
        <input type="submit" value="Items movidos por fecha"/>
    </form>
    <form action="frm_desde_hasta.php" method="POST">
        <input type="hidden" name="title" value="Items movidos por responsable">
        <input type="hidden" name="report_name" value="items_movidos_por_responsable">
        <input type="submit" value="Items movidos por Responsable"/>
    </form>
    <form action="frm_desde_hasta.php" method="POST">
        <input type="hidden" name="title" value="Items creados por fecha">
        <input type="hidden" name="report_name" value="items_creados_por_fecha">
        <input type="submit" value="Items creados por fecha"/>
    </form>
    <form action="frm_desde_hasta.php" method="POST">
        <input type="hidden" name="title" value="Items creadps por responsable">
        <input type="hidden" name="report_name" value="items_creados_por_responsable">
        <input type="submit" value="Items creados por Responsable"/>
    </form>
</body>
</html>