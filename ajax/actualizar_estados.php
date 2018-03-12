<?php

include ('includes/login_required.php');
require_once("DB.php");
echo updateState();

function updateState() {
	$db = new DB;
    $conn = $db->getConnection();
	$newState = $_POST['newState'];
	$stockNumber = $_POST['stockNumber'];
	$query = "UPDATE estado_item SET id_estado = '" . $newState . '\' WHERE nro_inventario = \''. $stockNumber. "'";
	$result = mysqli_query($conn, $query);
	if (!$result) {
        mysqli_error($conn);
    }
    return $query; 
}
