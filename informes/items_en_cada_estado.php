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
	$modelState = new State();
	$states = $modelState->getStates();
	//$counts = $itemStates->getAllCounts();
	foreach($states as $state) {
		echo $state['estado'] . "<br />";
    }

}
