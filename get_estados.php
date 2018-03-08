<?php
require_once("DB.php");
echo getStates();

function getStates() {
	$db = new DB;
    $conn = $db->getConnection();
	$query = "SELECT estado FROM estado";
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
    	array_push($states, utf8_encode($row['estado']));
    }
    return json_encode(Array ("states" => $states));	
}