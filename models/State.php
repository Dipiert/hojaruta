<?php
require_once(dirname(__FILE__) . "/../controllers/DBController.php");

class State {
	
	public function __construct() {
    	$this->db = new DBController();
        $this->conn = $this->db->getConnection();
    }

    public function getStates() {
    	$sql = "SELECT id, estado FROM estado";
    	$stmt = $this->conn->prepare($sql);
    	if ($stmt->execute()) {
    		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    		return $rows;
    		//print_r($rows[1]);
    		//return $rows;
    	}
    }

}

