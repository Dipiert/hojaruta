<?php

require_once('../controllers/DB.php');

class Estado {

    public function __construct() {
        $this->db = new DB;
        $this->conn = $this->db->getConnection();
    }

    function getEstados() {
        $query = "SELECT id, estado FROM estado";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_num_rows($result) > 0) {
             return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            echo nl2br("Ocurrio un error con la consulta SQL");
        }
    }
    
}