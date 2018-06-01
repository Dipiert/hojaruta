<?php
include ('includes/login_required.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Mover Item</title>
    <?php include('includes/header.php') ?>
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
    </script>
</head>
<body>
<div class="breadcrumbs">
    <a href="menu.php">Menú Principal</a> / Mover Item <br /><br />
</div>
		<label>Nro de Inventario:</label>
		<input type="text" id="stockNumber" title="Ingrese Nro. Inventario" required>
		<button type="submit" id="searchStockNumber">Buscar</button>
		<div id="result"></div><br/>
		<button type="submit" id="changeStatus" style="visibility: hidden">Cambiar Estado</button>
<script type="text/javascript">

    $(document).keypress(function(e){
        if(e.which === 13){
            $('#searchStockNumber').click();
        }
    });

    $("#searchStockNumber").click(function() {
        const stockNumber = $("#stockNumber").val();

        const defStates = $.ajax({
            type: 'GET',
            url: 'ajax/get_estados.php',
            async: false,
            cache: false,
            error: function(error) {
                alert(error);
            }
        });

        const defBiblio = $.ajax({
            url: 'ajax/buscar_inventario.php',
            type: 'POST',
            async: false,
            data: {stockNumber: stockNumber},
            error: function(error) {
                alert(error);
            },
        });

        $.when(defStates,defBiblio).then(showResult);

    });

    function showResult(defStates, defBiblio) {
        console.log(defBiblio[0]);
        biblioData = JSON.parse(defBiblio[0]);
        showBiblioData(biblioData['author'], biblioData['title']);
        showStates(JSON.parse(defStates[0]), biblioData['state']);
        $("#changeStatus").css("visibility", "visible");
    }

    function showBiblioData(author, title) {
        let result = $("#result");
        result.empty();
        result.append('<p>Autor: ' + author + '</p>');
        result.append('<p>Título: ' + title + '</p>');
    }

    function showStates(states, actualStatus) {
        let result = $("#result");
        result.append('<p>Estado Actual: ' + actualStatus + '</p>');
        result.append('Estado Nuevo:' + getStateOptions(states, actualStatus));
    }

    function getStateOptions(states, actualStatus) {
        let html = "";
        html += "<select id='statesSelect'>";
        html += makeStateOptions(states, actualStatus);
        html += "</select>";
        return html;
    }

    function makeStateOptions(states, actualStatus) {
        let html = "";
        let statesKeys = Object.keys(states);
        for (let stateKey of statesKeys) {
            if (actualStatus !== stateKey) {
                html += "<option value='" + states[stateKey] +  "' >" + stateKey + "</option>";
            }
        }
        return html;
    }

    $("#changeStatus").click(function() {
        const newState = $('#statesSelect option:selected').val();
        const stockNumber = $("#stockNumber").val();
        $.ajax({
            url: 'ajax/actualizar_estados.php',
            type: 'POST',
            data: { newState: newState,
                stockNumber: stockNumber,
                oldState: biblioData['state'],
            },
            error: function(e) {
                alert(e);
            },
            success: function(data) {
                if (!data) {
                    alert("Se ha movido un item correctamente");
                }
            }
        }).then(function() {
            location.reload();
        });

    });
</script>
</body>
</html>

