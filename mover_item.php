<?php
include ('includes/login_required.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Mover Item</title>
	<meta charset="utf-8">
    <meta description="Roadmap for Libraries">
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
    </script>
</head>
<body>
		<label>Nro de Inventario:</label>
		<input type="text" id="stockNumber"/>
		<button type="submit" id="searchStockNumber">Buscar</button>
		<div id="result"></div><br/>
		<button type="submit" id="changeStatus" style="visibility: hidden">Cambiar Estado</button>
</body>
</html>

<script type="text/javascript">

$(document).keypress(function(e){
	if(e.which == 13){
    	$('#searchStockNumber').click();
    }
});

$("#searchStockNumber").click(function() {
	var stockNumber = $("#stockNumber").val();
	
	var defStates = $.ajax({
		type: 'GET',
		url: 'get_estados.php',
		async: false,
		cache: false,
		error: function(error) {
			console.log(error);
		}
	});

	var defBiblio = $.ajax({
		url: 'buscar_inventario.php',
		type: 'POST',
		async: false,
		data: {stockNumber: stockNumber},
		success: function(data) {
			console.log(data);
		},
		error: function(error) {
  			console.log(error);
		},
	});

	$.when(defStates,defBiblio).then(showResult);

})

function showResult(defStates, defBiblio) {
	var biblioData = JSON.parse(defBiblio[0]);
	showBiblioData(biblioData['author'], biblioData['title']);
	showStates(JSON.parse(defStates[0]), biblioData['state']);	
	$("#changeStatus").css("visibility", "visible");
}

function showBiblioData(author, title) {
	$("#result").empty();
	$("#result").append('<p>Autor: ' + author + '</p>');
	$("#result").append('<p>Título: ' + title + '</p>');
}

function showStates(states, actualStatus) {
	$("#result").append('<p>Estado Actual: ' + actualStatus + '</p>');
	$("#result").append('Estado Nuevo:' + getStateOptions(states, actualStatus));
}

function getStateOptions(states, actualStatus) {
	var html = ""
	html += "<select id='statesSelect'>";
	html += makeStateOptions(states, actualStatus);	
	html += "</select>";
	return html;
}

function makeStateOptions(states, actualStatus) {
	var html = "";
	var statesKeys = Object.keys(states);
	for (let stateKey of statesKeys) {
		if (actualStatus != stateKey) {
			html += "<option value='" + states[stateKey] +  "' >" + stateKey + "</option>";	
		}
	}
	return html;
}

$("#changeStatus").click(function() {
	var newState = $('#statesSelect option:selected').val();
	var stockNumber = $("#stockNumber").val();
	$.ajax({
		url: 'actualizar_estados.php',
		type: 'POST',
		data: { newState: newState, stockNumber: stockNumber},
	});
	alert("Se ha actualizado el estado correctamente");
	location.reload();
});

</script>