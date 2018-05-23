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
	$counts = $itemModel->getAllCounts();
	foreach($counts as $count) {
		echo $count['estado'] . "\t" . $count['cantidad'] . "<br />";
    }

}
