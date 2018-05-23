
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $_POST['title'] ?></title>
    <meta charset="utf-8">
    <meta name="author" content="Damián Rotta">
    <meta name="description" content="Roadmap for Libraries - Reports">
</head>
<body>
<form action='<?php echo $_POST['report_name']?>.php' method="POST">
    <input type="checkbox" name="type[]" value="browser" id="browser"><label for="browser">Mostrar en Navegador</label><br/>
    <input type="checkbox" name="type[]" value="xls" id="xls"><label for="xls">Descargar archivo Excel</label><br/>
    <input type="checkbox" name="type[]" value="pdf" id="pdf"><label for="pdf">Descargar archivo PDF</label><br/>
    <input type="submit" value="Generar Informe">
</form>
</body>
</html>
