<?php
require_once("DB.php");
echo getBiblioData($_POST['barcode']);

function getBiblioData($barcode = '000307') {    
    $db = new DB;
    $conn = $db->getConnection();
    $query = 'SELECT b.author, b.title
              FROM biblio b, items i
              WHERE i.barcode =\'' . $barcode . '\' AND b.biblionumber = i.biblionumber;';
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
    $author = utf8_encode($row['author']);
    $title = utf8_encode($row['title']);
    return json_encode(Array ("author" => $author, "title" => $title));
}