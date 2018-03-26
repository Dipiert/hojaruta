<?php

include ('../includes/login_required.php');
require_once("../controllers/DB.php");
echo getStates();

function getStates() {
	$db = new DB;
    $conn = $db->getConnection();
    $stmt = $conn->prepare("SELECT estado, id FROM estado");
	if ($stmt->execute()) {
        $result = $stmt->get_result();
        return prepareResponse($result);
    } else {
        return $conn->error;
    }   
}

function prepareResponse($result) {
    $states = [];
    while ($row = $result->fetch_assoc()) {
        $state = $row['estado'];
        $state = iconv('ISO-8859-1', 'UTF-8', $state);
    	$states += [$state => $row['id']];
    }
    return json_encode($states);	
}