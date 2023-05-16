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

	public function empleadoMesAjax(){
		
		$empleadoMes = $this->empleadoMes;
		$mensaje = $this->mensaje;
		$publicado = $this->publicado;

		$ingresar = ControladorFormularios::ctrEmpleadoMes($empleadoMes, $mensaje, $publicado);

		if ($ingresar == 'ok') {
		    echo json_encode('ok');
		} else {
		    echo json_encode('Error');
		}

	}

	public function registroEmpresaAjax(){

		$registro_patronal = $this->registro_patronal;
		$rfc = $this->rfc;
		$nombre_razon_social = $this->nombre_razon_social;
		$regimen = $this->regimen;
		$actividad_economica = $this->actividad_economica;
		$calle = $this->calle;
		$numero = $this->numero;
		$numero_interior = $this->numero_interior;
		$colonia = $this->colonia;
		$cp = $this->cp;
		$entidad = $this->entidad;
		$poblacion_municipio = $this->poblacion_municipio;
		$telefono = $this->telefono;
		$convenio_reembolso = $this->convenio_reembolso;
		$delegacion_imss = $this->delegacion_imss;
		$subdelegacion = $this->subdelegacion;
		$clave_subdelegacion = $this->clave_subdelegacion;
		$mes_inicio_afiliacion = $this->mes_inicio_afiliacion;
		$anio_inicio_afiliacion = $this->anio_inicio_afiliacion;

		$datos = array(
			"registro_patronal" => $registro_patronal,
			"rfc" => $rfc,
			"nombre_razon_social" => $nombre_razon_social,
			"regimen" => $regimen,
			"actividad_economica" => $actividad_economica,
			"calle" => $calle,
			"numero" => $numero,
			"numero_interior" => $numero_interior,
			"colonia" => $colonia,
			"cp" => $cp,
			"entidad" => $entidad,
			"poblacion_municipio" => $poblacion_municipio,
			"telefono" => $telefono,
			"convenio_reembolso" => $convenio_reembolso,
			"delegacion_imss" => $delegacion_imss,
			"subdelegacion" => $subdelegacion,
			"clave_subdelegacion" => $clave_subdelegacion,
			"mes_inicio_afiliacion" => $mes_inicio_afiliacion,
			"anio_inicio_afiliacion" => $anio_inicio_afiliacion
		);

		$tabla = "empresas";

		$registrarEmpresa = ControladorFormularios::ctrRegistrarEmpresas($tabla, $datos);
		if ($registrarEmpresa == 'ok') {
			echo json_encode('ok');
		}else{
			echo json_encode('Error');
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

if (isset($_POST['empleadoMes'])) {
	if (isset($_POST['mensaje'])) {
		$empleado_mes = new FormulariosAjax();
		$empleado_mes -> empleadoMes = $_POST['empleadoMes'];
		$empleado_mes -> mensaje = $_POST['mensaje'];
		$empleado_mes -> publicado = $_POST['publicado'];
		$empleado_mes -> empleadoMesAjax();
	}

}

if (isset($_POST['empresa'])) {
	if (isset($_POST['convenio_reembolso'])) {
		$convenio_reembolso = 1;
	}else{
		$convenio_reembolso = 0;
	}
	$registro_empresa = new FormulariosAjax();
	$registro_empresa -> registro_patronal = $_POST['registro_patronal'];
	$registro_empresa -> rfc = $_POST['rfc'];
	$registro_empresa -> nombre_razon_social = $_POST['nombre_razon_social'];
	$registro_empresa -> regimen = $_POST['regimen'];
	$registro_empresa -> actividad_economica = $_POST['actividad_economica'];
	$registro_empresa -> calle = $_POST['calle'];
	$registro_empresa -> numero = $_POST['numero'];
	$registro_empresa -> numero_interior = $_POST['numero_interior'];
	$registro_empresa -> colonia = $_POST['colonia'];
	$registro_empresa -> cp = $_POST['cp'];
	$registro_empresa -> entidad = $_POST['entidad'];
	$registro_empresa -> poblacion_municipio = $_POST['poblacion_municipio'];
	$registro_empresa -> telefono = $_POST['telefono'];
	$registro_empresa -> convenio_reembolso = $convenio_reembolso;
	$registro_empresa -> delegacion_imss = $_POST['delegacion_imss'];
	$registro_empresa -> subdelegacion = $_POST['subdelegacion'];
	$registro_empresa -> clave_subdelegacion = $_POST['clave_subdelegacion'];
	$registro_empresa -> mes_inicio_afiliacion = $_POST['mes_inicio_afiliacion'];
	$registro_empresa -> anio_inicio_afiliacion = $_POST['anio_inicio_afiliacion'];
	$registro_empresa -> registroEmpresaAjax();

}