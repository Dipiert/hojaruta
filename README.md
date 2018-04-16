# hojaruta
Hoja de Ruta para Bibliotecas

## Requirements:
- PHP 7.0+

## Samples:
### DBConfig
```
<?php
return array (
	  "host" => "localhost",
	  "db_engine" => "mysql",
	  "dbname" => "hojaruta",			  
	  "user" => "root",
	  "password" => "toor",
	  "options" => array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION),
);
```
### Table 'estado'

- Sellado/Inventario
- Seguridad
- Clasificación
- Catalogación/Item
- Indización
- Librística
- Código de Barra
- Rótulo
- Control
- Sala
