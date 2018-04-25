<a href="./../menu.php">Menú Principal</a> / Registrar Item
<!-- BREADCRUMBS -->
<?php


http://localhost/hojaruta/frm_registrar_item.php

include('includes/login_required.php');
require_once(dirname(__FILE__) . '/models/Item.php');

if($_SERVER['REQUEST_METHOD'] === "POST" and areFieldsSent()) {
    storeItem();
}

function storeItem() {
    $item = new Item();
    $author = $_POST['author'];
    $title = $_POST['title'];
    $stockNumber = $_POST['stockNumber'];
    $item->storeItem($author, $title, $stockNumber);    
}

function areFieldsSent() {
    return ( isset($_POST['author'])
             and isset($_POST['title'])
             and isset($_POST['stockNumber'])
           );
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrar item</title>
    <meta charset="utf-8">
    <meta name="description" content="Roadmap for Libraries">
</head>
<body>
<form action="frm_registrar_item.php" method="POST">
    <p>
        <label>Autor: </label>
        <input type="text" name="author" title="Ingrese el nombre y apellido del autor" required>
    </p>
    <p>
        <label>Título: </label>
        <input type="text" name="title" title="Ingrese el título del item" required>
    </p>
    <p>
        <label>Inventario:</label>
        <input type="text" name="stockNumber" title="Ingrese el número de inventario del item" required>
    </p>
    <p>
        <input type="submit" value="Registrar">
    </p>
</form>
</body>
</html>
