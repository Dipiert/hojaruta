<?php
/**
 * User: desarrollo
 * Date: 17/04/18
 * Time: 9:25
 */

define('PASSWORD_LENGTH', 8);
//echo "Contraseña cambiada";
echo restorePassword();

function restorePassword() {
    $newPassword = generateRandomPassword();
    return $newPassword;
    //updatePassword($newPassword);
}

function generateRandomPassword() {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $pass = [];
    $charsLength = strlen($chars);
    for ($i = 0 ; $i < PASSWORD_LENGTH; $i++) {
        $index = rand(0, $charsLength);
        $pass[] = $chars[$index];
    }
    return implode($pass);
}

function updatePassword($newPassword) {

}