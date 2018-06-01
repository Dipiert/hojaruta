<?php

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
makeBrowserReport($desde, $hasta);

function makeHtmlEnd($table) {
    if ($table) {
        echo "</table>";
    }
    echo "</body>";
    echo "</html>";
}

function makeBrowserReport($desde, $hasta) {
    require_once(dirname(__FILE__) . "/../models/Movement.php");
    $movementModel = new Movement();
    $movements = $movementModel->getItemsMoved($desde, $hasta);
    if (empty($movements)) {
        echo "No hay registros";
        makeHtmlEnd($table=0);
    } else {
        echo "<table style='width=100%' border='1'>\n";
        echo "<tr>\n";
        echo "<th>Nro. de inventarios movidos</th>\n";
        echo "</tr>\n";
        foreach($movements as $movement) {
            echo "<tr>\n";
            echo "<td>" . $movement['nro_inventario'] . "</td>\n";
        }
        echo "<p>Desde: " . $desde . "</p>";
        echo "<p>Hasta: " . $hasta . "</p>";
        echo "<p>Total: " . count($movements) . "</p>";
        makeHtmlEnd($table=1);
    }
}