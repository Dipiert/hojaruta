<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {	
    echo "Debe iniciar su sesión para ver esta página: <a href='index.php'>Iniciar sesión</a>";
    exit;
}