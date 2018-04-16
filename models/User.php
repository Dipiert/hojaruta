<?php
class User {
	private $user;
	private $contrasena;
	private $isAdmin;

	function __construct($user, $contrasena, $isAdmin) {
		$this->user = $user;
		$this->contrasena = $contrasena;
		$this->isAdmin = $isAdmin;
	}

	function store() {
		$sql = "INSERT INTO usuarios(id, usuario, contrasena, admin, creado_el) VALUES(null, ?, ?, ?, null)";
		
	}
}