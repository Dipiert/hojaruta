
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $_POST['title'] ?></title>
    <?php include('../includes/header.php') ?>
</head>
<body>

<div class="breadcrumbs">
    <a href="../menu.php">Menú Principal</a> / <a href="listar_informes.php">Listar Informes</a></body> <br /><br />
</div>

<form action='<?php echo $_POST['report_name']?>.php' method="POST">
    <input type="checkbox" name="type[]" value="browser" id="browser"><label for="browser">Mostrar en Navegador</label><br/>
    <!--<input type="checkbox" name="type[]" value="xls" id="xls"><label for="xls">Descargar archivo Excel</label><br/>
    <input type="checkbox" name="type[]" value="pdf" id="pdf"><label for="pdf">Descargar archivo PDF</label><br/>-->
    <input type="submit" value="Generar Informe">
</form>
</body>
</html>
