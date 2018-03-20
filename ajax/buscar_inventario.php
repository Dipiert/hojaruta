<?php

include ('../includes/login_required.php');
require_once("../controllers/DB.php");
echo getBiblioData();

function getBiblioData() {  
    $stockNumber = $_POST['stockNumber'];  
    $db = new DB;
    $conn = $db->getConnection();
    $query = 'SELECT i.autor, i.titulo, e.estado
            FROM item i
            INNER JOIN estado_item ei
            INNER JOIN estado e
            ON i.nro_inventario=ei.nro_inventario
            AND e.id=ei.id_estado
            WHERE i.nro_inventario =' . "'$stockNumber'";
    
    $result = mysqli_query($conn, $query);
    if (!$result) {
        mysqli_error($conn);
    } else {
        $result = prepareResponse($result);
    }    
    return $result;
}

function prepareResponse($result) {
    $row = mysqli_fetch_assoc($result);
    $author = utf8_encode($row['autor']);
    $title = utf8_encode($row['titulo']);
    $state = utf8_encode($row['estado']);
    return json_encode(Array ("author" => $author, "title" => $title, "state" => $state));
}