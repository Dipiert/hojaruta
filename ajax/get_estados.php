<?php

include ('../includes/login_required.php');
require_once("../controllers/DBController.php");
$state = new State();
echo $state->getStates();

class State { 
    private $conn;
    private $db;

    function __construct() {
        $this->db = new DBController();
        $this->conn = $this->db->getConnection();
    }

    function getStates() {
        $sql = "SELECT estado, id FROM estado";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute()) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $this->prepareResponse($rows);
        } else {
            return $conn->error;
        }   
    }

    function prepareResponse($rows) {
        $states = [];
        foreach($rows as $row) {
            $state = $row['estado'];
            $states += [$state => $row['id']];
        }
        return json_encode($states,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);   
    }

}

