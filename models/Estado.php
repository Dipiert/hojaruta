<?php

require_once('../controllers/DB.php');

class Estado {

    public function __construct() {
        $this->db = new DB;
        $this->conn = $this->db->getConnection();
    }

    function getEstados() {
        $stmt = $this->conn->prepare("SELECT id, estado FROM estado");
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if (mysqli_num_rows($result) > 0) {
                return mysqli_fetch_all($result, MYSQLI_ASSOC);   
            } else {
                echo nl2br("Ocurrio un error con la consulta SQL");    
            }
        }
    }
    
}