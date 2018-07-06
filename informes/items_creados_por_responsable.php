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
    $movements = $movementModel->getItemsMovedByResponsible($desde, $hasta);
    if (empty($movements)) {
        echo "No se dieron de alta nuevos items en esa fecha";
        makeHtmlEnd($table=0);
    } else {
        echo "<table style='width=100%' border='1'>\n";
        echo "<tr>\n";
        echo "<th>Responsable</th>\n";
        echo "<th>Total items creados</th>\n";
        echo "</tr>\n";
        foreach($movements as $movement) {
            echo "<tr>\n";
            echo "<td>" . $movement['responsable'] . "</td>\n";
            echo "<td>" . $movement['total'] . "</td>\n";
        }
        echo "<p>Desde: " . $desde . "</p>";
        echo "<p>Hasta: " . $hasta . "</p>";
        makeHtmlEnd($table=1);
    }
}