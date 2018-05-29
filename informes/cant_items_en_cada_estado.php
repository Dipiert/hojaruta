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

function makeHtmlEnd($table) {
    if ($table) {
        echo "</table>";
    }
    echo "</body>";
    echo "</html>";
}

function makeBrowserReport() {
	require_once(dirname(__FILE__) . "/../models/State.php");
    require_once(dirname(__FILE__) . "/../models/Item.php");
    $itemModel = new Item();
	$counts = $itemModel->getAllCounts();
    require_once ("../includes/complete_header.php");
    if (empty($counts)) {
	    echo "No hay registros";
        makeHtmlEnd($table=0);
    } else {
        echo "<table style='width=100%' border='1'>\n";
        echo "<tr>\n";
        echo "<th>Estado</th>\n";
        echo "<th>Cantidad</th>\n";
        echo "</tr>\n";
        foreach($counts as $count) {
            echo "<tr>\n";
            echo "<td>" . $count['estado'] . "</td>\n";
            echo "<td>" . $count['cantidad'] . "</td>\n";
        }
        makeHtmlEnd($table=1);
    }

}
