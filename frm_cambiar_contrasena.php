<?php

if ($_POST["newPassword"]) {
    echo "Recibi una nueva pass";
}
?>

<html>
    <head>
        <title>Cambiar mi contraseña</title>
    </head>
    <body>
        <form>
            <label for="newPassword">Nueva contraseña:
                <input type="text" id="newPassword" title="Ingrese la nueva contraseña" required/>
            </label>
            <input type="submit" value="Cambiar"/>
        </form>
    </body>
</html>
