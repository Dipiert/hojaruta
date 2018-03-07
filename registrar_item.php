<?php
require_once("DB.php");
storeItem();

function storeItem() {
    $db = new DB;
    $conn = $db->getConnection();
    $stockNumber = mysqli_real_escape_string($conn, $_POST['stockNumber']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $title = mysqli_real_escape_string($conn, $_POST['title']); 
    $sql = 'INSERT INTO item VALUES' . "('$author', '$title', $stockNumber);";
    store($conn, $sql);
    $sql = 'INSERT INTO estado_item VALUES' . "($stockNumber, 0)";
    store($conn, $sql);
}

function store($conn, $sql) {
    if (!mysqli_query($conn, $sql)) {
        echo nl2br("Ocurrio un error con la consulta: " . $sql . "\n");
    } else {
        echo nl2br("Se ha insertado un nuevo registro correctamente\n");
    }
}