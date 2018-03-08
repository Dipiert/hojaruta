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
    if (store($conn, $sql)) {
        $sql = 'INSERT INTO estado_item VALUES' . "($stockNumber, 0)";
        if(store($conn, $sql));     {
            echo nl2br("Se ha registrado el item correctamente");
        }
    }
}

function store($conn, $sql) {
    define('MYSQL_CODE_DUPLICATE_KEY',1062);    
    if (!mysqli_query($conn, $sql)) {
        if (mysqli_errno($conn) == MYSQL_CODE_DUPLICATE_KEY) {            
            echo nl2br("El número de inventario cargado ya existe");
        } else {
            echo nl2br("Ocurrio un error con la consulta SQL");
        }        
    } else {
        return true;
    }
}