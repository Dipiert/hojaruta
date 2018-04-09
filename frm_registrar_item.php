<?php

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
    <meta description="Roadmap for Libraries">
</head>
<body>
<form action="frm_registrar_item.php" method="POST">
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
