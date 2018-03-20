<?php

include ('../includes/login_required.php');
require_once("../controllers/DB.php");
echo getStates();

function getStates() {
	$db = new DB;
    $conn = $db->getConnection();
	$query = "SELECT estado, id FROM estado";
	$result = mysqli_query($conn, $query);
	if (!$result) {
        mysqli_error($conn);
    } else {
        $result = prepareResponse($result);
    }    
    return $result;
}

function prepareResponse($result) {
    $states = [];
    while ($row = mysqli_fetch_assoc($result)) {
    	$states += [utf8_encode($row['estado']) => $row['id']];
    }
    return json_encode($states);	
}