<?php

require_once('../models/Estado.php');


class BrowserReportHandler {

	public function __construct() {
		$this->a();
	}

	function a() {
		$estado = new Estado;
		$estados = $estado->getEstados();
		print_r($estados);
		//$sql = "SELECT COUNT(nro_inventario)
		//		FROM estado_item"
	}

	
}

?>