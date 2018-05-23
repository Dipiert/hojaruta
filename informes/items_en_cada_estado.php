<?php
$types = $_POST['type'];
for ($i=0; $i < count($types); $i++) {
	if ($types[$i] === 'browser') {
		makeBrowserReport();		
	} else if ($types[$i] === 'xls') {
		makeXLSReport();
	} else if ($types[$i] === 'pdf') {
		makePDFReport();
	} 
}

function makeBrowserReport() {
	require_once('BrowserReportHandler.php');
	require_once(dirname(__FILE__) . "/../models/State.php");
    require_once(dirname(__FILE__) . "/../models/Item.php");
    $itemModel = new Item();
	$items = $itemModel->getItemsForEachState();
	echo "<!doctype html>\n";
    echo "<table style='width=100%' border='1'>\n";
    echo "<tr>\n";
    echo "<th>Estado</th>\n";
    echo "<th>Nro. Inventario</th>\n";
	echo "</tr>\n";
    foreach($items as $item) {
        echo "<tr>\n";
	    echo "<td>" . $item['estado'] . "</td>\n";
        echo "<td>" . $item['nro_inventario'] . "</td>\n";
    }
    echo "</table>\n";

}
