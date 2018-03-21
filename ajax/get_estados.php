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
        return mysqli_error($conn);
    }   
}

function prepareResponse($result) {
    $states = [];
    while ($row = mysqli_fetch_assoc($result)) {
    	$states += [utf8_encode($row['estado']) => $row['id']];
    }
    return json_encode($states);	
}