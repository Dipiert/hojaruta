<?php
include ('includes/login_required.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrar item</title>
    <meta charset="utf-8">
    <meta description="Roadmap for Libraries">
</head>
<body>
<form action="registrar_item.php" method="POST">
    <p>
        <label>Autor: </label>
        <input type="text" name="author">
    </p>
    <p>
        <label>Título: </label>
        <input type="text" name="title">
    </p>
    <p>
        <label>Inventario:</label>
        <input type="text" name="stockNumber">
    </p>
    <p>
        <input type="submit" value="Registrar">
    </p>
</form>
</body>
</html>
