<?php

include (dirname(__FILE__) . '/../includes/login_required.php');
require_once(dirname(__FILE__) . '/../controllers/DBController.php');
$biblio = new BiblioData();
echo $biblio->getBiblioData();

class BiblioData {
    private $conn;
    private $db;

    function __construct() {
        $this->db = new DBController();
        $this->conn = $this->db->getConnection(); 
         
    }

    function getBiblioData() {  
        $stockNumber = $_POST['stockNumber'];  
        $sql = "SELECT i.autor, i.titulo, e.estado
                                FROM item i
                                INNER JOIN estado_item ei
                                INNER JOIN estado e
                                ON i.nro_inventario=ei.nro_inventario
                                AND e.id=ei.id_estado
                                WHERE i.nro_inventario = ?";
        $stmt = $this->conn->prepare($sql);
        $execResult = $stmt->execute(array($stockNumber));
        if ($execResult) {
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             return $this->prepareResponse($row);
        } else {
            return $this->conn->error;
        }
    }

function prepareResponse($row) {    
    $author = $row['autor'];    
    $title = $row['titulo'];
    $state = $row['estado'];
    $arrayToEncode = Array ("author" => $author, "title" => $title, "state" => $state);
    return json_encode($arrayToEncode,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}

}

