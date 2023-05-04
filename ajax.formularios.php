<?php 
require_once "controller/formularios.controlador.php";
require_once "model/formularios.modelo.php";

class FormulariosAjax{

	public function citasAjax(){

		$idPostulante = $this->idPostulante;
		$fechaReunion = $this->fechaReunion;
		$respuesta = ControladorFormularios::ctrAgendarCitas($idPostulante, $fechaReunion);
		if ($respuesta == 'ok') {
			setlocale(LC_ALL, 'es_ES');
			$date = date("d-m-Y h:i a", strtotime($fechaReunion));
			echo json_encode($date);
		}else{
			
			echo json_encode("error");
		}
	}

	public function reunionesAjax(){

		$item = $this->$item;
		$valor = $this->$valor;
		$tabla = $this->$tabla;
		$respuesta = ControladorFormularios::ctrContarReuniones($item, $valor, $tabla);
		if ($respuesta >= 0) {
			echo json_encode($respuesta);
		}else{
			echo json_encode("error");
		}
	}

}

if(isset($_POST["validate"])){

	$fechaReunion = $_POST['anio']."-".$_POST['mes']."-".$_POST['dia']." ".$_POST['hora'].":".$_POST['minutos'].":00";

	$validate = new FormulariosAjax();
	$validate -> idPostulante = $_POST["validate"];
	$validate -> fechaReunion = $fechaReunion;
	$validate -> citasAjax();

}

if (isset($_POST['valor'])) {
	$item =	$_POST['item'];
	$valor = $_POST['valor'];
	$tabla = $_POST['tabla'];

	$validate = new FormulariosAjax();
	$validate -> item = $item;
	$validate -> valor = $valor;
	$validate -> tabla = $tabla;
	$validate -> reunionesAjax();

}