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

		$item = $this->item;
		$valor = $this->valor;
		$tabla = $this->tabla;
		$respuesta = ControladorFormularios::ctrContarReuniones($item, $valor, $tabla);
		if ($respuesta >= 0) {
			echo json_encode($respuesta);
		}else{
			echo json_encode("error");
		}
	}

	public function calificarReunionesAjax(){

		$datos = $this->datos;
		$table = "reuniones";

		$calificarReuniones = ControladorFormularios::ctrCalificarReunion($table, $datos);
			echo '<pre>'; print_r($calificarReuniones); echo '<pre>'; 
		if ($calificarReuniones == 'ok') {
		    echo json_encode('ok');
		} else {
		    echo json_encode('error');
		}

	}

	public function eliminarPostulanteAjax(){

		$item = $this->item;
		$valor = $this->valor;

		$eliminarPostulante = ControladorFormularios::ctrEliminarPostulante($item, $valor);
			echo '<pre>'; print_r($eliminarPostulante); echo '<pre>'; 
		if ($eliminarPostulante == 'ok') {
		    echo json_encode('ok');
		} else {
		    echo json_encode('error');
		}

	}

	public function iniciarSesionAjax(){
		
		$loginEmail = $this->loginEmail;
		$loginPass = $this->loginPass;

		$ingresar = ControladorFormularios::ctrLogin($loginEmail,$loginPass);

		if ($ingresar == 'ok') {
		    echo json_encode('ok');
		} else {
		    echo json_encode($ingresar);
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

if (isset($_POST['reunion'])) {

	$pregunta1 = $_POST['pregunta1'];
	$pregunta2 = $_POST['pregunta2'];
	$pregunta3 = $_POST['pregunta3'];
	$pregunta4 = $_POST['pregunta4'];
	$comentariosReunion = $_POST['comentariosReunion'];
	$idReuniones = $_POST['reunion'];
	$idPostulantes = $_POST['postulante'];

	$datos = array("pregunta1" => $pregunta1,
					"pregunta2" => $pregunta2,
					"pregunta3" => $pregunta3,
					"pregunta4" => $pregunta4,
					"comentariosReunion" => $comentariosReunion,
					"idReuniones" => $idReuniones,
					"idPostulantes" => $idPostulantes);

	$calificar = new FormulariosAjax();

	$calificar -> datos = $datos;

	$calificar -> calificarReunionesAjax();

}

if (isset($_POST['eliminarPostulante'])) {
	$item =	"idPostulantes";
	$valor = $_POST['eliminarPostulante'];

	$validate = new FormulariosAjax();
	$validate -> item = $item;
	$validate -> valor = $valor;
	$validate -> eliminarPostulanteAjax();
}

if (isset($_POST['loginEmail'])) {

	$login = new FormulariosAjax();
	$login -> loginEmail = $_POST['loginEmail'];
	$login -> loginPass = $_POST['loginPass'];
	$login -> iniciarSesionAjax();
}