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
		<div id="result"></div>
</body>
</html>

<script type="text/javascript">

$("#searchStockNumber").click(function() {
	var stockNumber = $("#stockNumber").val();
	$.ajax({
		url: 'buscar_inventario.php',
		type: 'POST',
		async: false,
		data: {stockNumber: stockNumber},
		//data: {},
		success: function(biblioData) {
			getStates(biblioData);
			//showResult(JSON.parse(data));
		}, 
		error: function(error) {
  			console.log(error);
		},
	})
})

function getStates(biblioData) {
	return $.ajax({
		type: 'POST',
		url: 'get_estados.php',
		async: false,
		success: function(data) {
			states = JSON.parse(data);
			showResult(states, biblioData);
		},
		error: function(error) {
			console.log(error);
		}
	}); 
}

function showResult(states, data) {
	//var states = getStates();
	console.log(states);
	$("#result").append('<p>Autor: ' + data['author'] + '</p>');
	$("#result").append('<p>Título: ' + data['title'] + '</p>');
	$("#result").append('<p>Estado Actual: ' + data['state'] + '</p>');
	$("#result").append('Estado Nuevo:\
	<select> \
	<option>A</option>\
	</select>											\
	');
	$("#result").append('<button>Cambiar Estado</button>');
}

$(document).keypress(function(e){
	if(e.which == 13){
    	$('#searchStockNumber').click();
    }
});

</script>