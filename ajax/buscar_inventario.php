<?php

include ('../includes/login_required.php');
require_once("../controllers/DB.php");
echo getBiblioData();

function getBiblioData() {  
    $stockNumber = $_POST['stockNumber'];  
    $db = new DB;
    $conn = $db->getConnection();
    $stmt = $conn->prepare("SELECT i.autor, i.titulo, e.estado
                            FROM item i
                            INNER JOIN estado_item ei
                            INNER JOIN estado e
                            ON i.nro_inventario=ei.nro_inventario
                            AND e.id=ei.id_estado
                            WHERE i.nro_inventario = ?");
    $stmt->bind_param("s", $stockNumber);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return prepareResponse($result);
    } else {
        return $this->conn->error;
    }
}

function prepareResponse($result) {    
    $row = $result->fetch_assoc();;
    $author = $row['autor'];
    $title = $row['titulo'];
    $state = $row['estado'];
    $author = iconv('ISO-8859-1', 'UTF-8', $author);
    $title = iconv('ISO-8859-1', 'UTF-8', $title);
    $state = iconv('ISO-8859-1', 'UTF-8', $state);
    return json_encode(Array ("author" => $author, "title" => $title, "state" => $state));
}