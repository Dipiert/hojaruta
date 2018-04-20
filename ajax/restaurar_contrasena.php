<?php
require_once(dirname(__FILE__) . "/../controllers/DBController.php");

define('PASSWORD_LENGTH', 8);
echo restorePassword();

function restorePassword() {
    $newPassword = generateRandomPassword();
    updatePassword($newPassword);
    return $newPassword;
}

function generateRandomPassword() {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $pass = [];
    $charsLength = strlen($chars) - 1;
    for ($i = 0 ; $i < PASSWORD_LENGTH; $i++) {
        $index = rand(0, $charsLength);
        $pass[] = $chars[$index];
    }
    return implode($pass);
}

function updatePassword($newPassword) {
    $db = new DBController();
    $conn = $db->getConnection();
    $user = $_POST['user'];
    $sql = "UPDATE usuarios SET contrasena = ? WHERE usuario LIKE ?";
    $stmt = $conn->prepare($sql);
    $newPassword = md5($newPassword);
    $stmt->execute(array($newPassword, $user));
}