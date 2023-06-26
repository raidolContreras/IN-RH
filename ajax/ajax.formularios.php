<?php 
require_once "../controller/formularios.controlador.php";
require_once "../model/formularios.modelo.php";

require_once "../model/modelo.empleados.php";
require_once "../controller/controlador.empleados.php";

require_once "../controller/controlador.excel.php";
require_once "../model/modelo.excel.php";

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
		$dia_inicio_afiliacion = $this->dia_inicio_afiliacion;
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
			"dia_inicio_afiliacion" => $dia_inicio_afiliacion,
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

	public function actualizarEmpresaAjax(){

		$actualizarEmpresa = $this->actualizarEmpresa;
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
		$dia_inicio_afiliacion = $this->dia_inicio_afiliacion;
		$mes_inicio_afiliacion = $this->mes_inicio_afiliacion;
		$anio_inicio_afiliacion = $this->anio_inicio_afiliacion;

		$datos = array(
			"actualizarEmpresa" => $actualizarEmpresa,
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
			"dia_inicio_afiliacion" => $dia_inicio_afiliacion,
			"mes_inicio_afiliacion" => $mes_inicio_afiliacion,
			"anio_inicio_afiliacion" => $anio_inicio_afiliacion
		);

		$tabla = "empresas";

		$registrarEmpresa = ControladorFormularios::ctrActualizarEmpresas($tabla, $datos);
		if ($registrarEmpresa == 'ok') {
			echo json_encode('ok');
		}else{
			echo json_encode('Error');
		}
	}

	public function cambioPasswordAjax(){
		$idEmpleados = $this->idEmpleados;
		$Password = $this->Password;
		$confirmarPassword = $this->confirmarPassword;

		// Verificar si las contraseñas cumplen los requisitos
		$regex = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/';

		$tabla = "empleados";
		$busqueda = ControladorEmpleados::ctrVerEmpleados(null,null);

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$pass1 = $Password;
			$pass2 = $confirmarPassword;

			// Verificar si las contraseñas son iguales
			if ($pass1 !== $pass2) {
				echo json_encode('Error: password');
			} elseif (!preg_match($regex, $pass1)) {
				echo json_encode('Error: data');
			} else {
				foreach($busqueda as $empleado){
					if (md5($empleado['idEmpleados']) == $idEmpleados) {

						$data = array(
							"idEmpleados" => $empleado['idEmpleados'],
							"password" => crypt($Password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$')
						);

						$cambio = ControladorEmpleados::ctrCambioPassword($tabla,$data);

						if ($cambio == 'ok') {
							$_SESSION["cambio_password"] = 1;
						}
						echo json_encode($cambio);
					}
				}
			}
		}
	}

	public function forgotPasswordAjax(){

		$forgotEmail = $this->forgotEmail;

		$busqueda = ControladorEmpleados::ctrVerEmpleados("email",$forgotEmail);

		if (!isset($busqueda[0])) {
			echo json_encode('error');
		}else{

			$idEncript = crypt($busqueda['idEmpleados'], 'asxx54ahjppf45sd87a5a4dDDGsystemdev');
			$emailEncript = md5($forgotEmail);

			$link = 'http://inconsulting.porscheclubmorelia.com/Password&cambio='.$idEncript.'&forgot='.$emailEncript;
			$name = $busqueda['name']." ".$busqueda['lastname'];
			
			$datos = array("name" => $name,
							"link" => $link,
							"email" => $forgotEmail,
							"idEmpleados" => $busqueda['idEmpleados'],
							"genero" => $busqueda['genero'],
							"emailEncript" => $emailEncript
			);

			$enviarEmail = ControladorFormularios::ctrForgotPasswordEmail($datos);
			echo json_encode($enviarEmail);
		}
	}

	public function solicitudCambioPasswordAjax(){
		$solicitudCambio = $this->solicitudCambio;
		$tokenPassword = $this->tokenPassword;
		$Password = $this->Password;
		$confirmarPassword = $this->confirmarPassword;

		// Verificar si las contraseñas cumplen los requisitos
		$regex = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/';

		$tabla = "empleados";
		$busqueda = ControladorEmpleados::ctrVerEmpleados(null,null);

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			// Verificar si las contraseñas son iguales
			if ($Password !== $confirmarPassword) {
				echo json_encode('Error: password');
			} elseif (!preg_match($regex, $Password)) {
				echo json_encode('Error: data');
			} else {
				foreach($busqueda as $empleado){
					if (crypt($empleado['idEmpleados'], 'asxx54ahjppf45sd87a5a4dDDGsystemdev') == $tokenPassword) {

						$verificacionCambio = ControladorEmpleados::ctrCambioPasswordOlvidado("Empleados_idEmpleados",$empleado['idEmpleados']);

						$data = array(
							"idEmpleados" => $empleado['idEmpleados'],
							"password" => crypt($Password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$')
						);
						$cambio = ControladorEmpleados::ctrCambioPassword($tabla,$data);
						if ($cambio == 'ok') {
							$borrarSolicitud = ControladorEmpleados::ctrBorrarSolicitud($verificacionCambio['idSolicitudPassword']);
							echo json_encode($borrarSolicitud);
						}
					}
				}
			}
		}
	}

	public $idEmpleados;
	public $fecha_baja;

	public function eliminarEmpleadoAjax(){
		$fecha_baja = $this->fecha_baja;
		$idEmpleados = $this->idEmpleados;

		$datos = array(
			"fecha_baja" => $fecha_baja,
			"idEmpleados" => $idEmpleados
		);

		$eliminarEmpleado = ControladorEmpleados::ctrEliminarEmpleado($datos);

		echo json_encode($eliminarEmpleado);
	}

	public function buscarDepasAjax(){
	    $idEmpresas = $this->idEmpresas;
	    $buscarDepas = ControladorFormularios::ctrDeptosEspecial2("Empresas_idEmpresas", $idEmpresas);
	    $departamentos = array();
	    foreach($buscarDepas as $departamento){
	        $departamentos[] = $departamento;
	    }
	    echo json_encode($departamentos);
	}

	public function CambiarPredeterminadoAjax(){
		$idHorarios = $this->idHorarios;

		$cambiar = ControladorFormularios::ctrCambiarHorarioDefault($idHorarios);
		echo json_encode($cambiar);
	}

	public function CrearJustificanteHorario(){
		session_start();
		$Asistencias_idAsistencias = $this->Asistencias_idAsistencias;
		$comentario = $this->comentario;

		$datos = array(
			"Empleados_idEmpleados" => $_SESSION['idEmpleado'],
			"Asistencias_idAsistencias" => $Asistencias_idAsistencias,
			"Comentario" => $comentario
		);

		$registrar = ControladorFormularios::ctrCrearJustificante($datos);
		echo json_encode($registrar);
	}

	public function aprobarJustificacionAjax(){
		$idJustificantes = $this->aprobar;
		$aprobar = ControladorFormularios::ctrAprobarJustificante($idJustificantes);
		echo json_encode($aprobar);
	}

	public function declinarJustificacionAjax(){
		$idJustificantes = $this->declinar;
		$declinar = ControladorFormularios::ctrDeclinarJustificante($idJustificantes);
		echo json_encode($declinar);
	}

	public function crearExcelAjax(){
		$idEmpleados = $this->idEmpleados;
		$generarExcel = ControladorExcel::ctrGeneralExcelAsistencias($idEmpleados);
		echo json_encode($generarExcel);
	}

	public function crearExcelEmpresasAjax(){
		$idEmpresas = $this->idEmpresas;
		$generarExcel = ControladorExcel::ctrGeneralExcelAsistenciasEmpresas($idEmpresas);
		echo json_encode($generarExcel);
	}

	public function GenerarPeticionesAjax(){
		session_start();
		$idPeticiones = $this->idPeticiones;
		$fechaPermiso = $this->fechaPermiso;
		$fechaFin = $this->fechaFin;
		$descripcion = $this->descripcion;
		if (strtotime($fechaPermiso)>strtotime($fechaFin)) {
			echo json_encode('error fecha');
		}else{
			$puesto = ControladorFormularios::ctrVerPuestos("Empleados_idEmpleados", $_SESSION['idEmpleado']);
			$jefeDepartamento = ControladorFormularios::ctrVerDepartamentos("idDepartamentos", $puesto['Departamentos_idDepartamentos']);
			$datos = array(
				"idPeticiones" => $idPeticiones,
				"fechaPermiso" => $fechaPermiso,
				"fechaFin" => $fechaFin,
				"descripcion" => $descripcion,
				"jefeDepartamento" => $jefeDepartamento['Empleados_idEmpleados'],
				"idEmpleados" => $_SESSION['idEmpleado']
			);
			if ($idPeticiones != 0) {
				$generarPeticion = ControladorFormularios::ctrGenerarPermiso($datos);
			}else{
				$generarPeticion = ControladorFormularios::ctrGenerarVacaciones($datos);
			}
			echo json_encode($generarPeticion);
		}
	}

	public function eliminarPeticionesAjax(){
		$idPeticiones = $this->idPeticiones;
		$eliminarSolicitud = ControladorFormularios::ctrEliminarSolicitud($idPeticiones);
		echo json_encode($eliminarSolicitud);
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
	$registro_empresa -> dia_inicio_afiliacion = $_POST['dia_inicio_afiliacion'];
	$registro_empresa -> mes_inicio_afiliacion = $_POST['mes_inicio_afiliacion'];
	$registro_empresa -> anio_inicio_afiliacion = $_POST['anio_inicio_afiliacion'];
	$registro_empresa -> registroEmpresaAjax();

}

if (isset($_POST['actualizarEmpresa'])) {
	if (isset($_POST['convenio_reembolso'])) {
		$convenio_reembolso = 1;
	}else{
		$convenio_reembolso = 0;
	}
	$registro_empresa = new FormulariosAjax();
	$registro_empresa -> actualizarEmpresa = $_POST['actualizarEmpresa'];
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
	$registro_empresa -> dia_inicio_afiliacion = $_POST['dia_inicio_afiliacion'];
	$registro_empresa -> mes_inicio_afiliacion = $_POST['mes_inicio_afiliacion'];
	$registro_empresa -> anio_inicio_afiliacion = $_POST['anio_inicio_afiliacion'];
	$registro_empresa -> actualizarEmpresaAjax();
}

if (isset($_POST['cambioPassword'])) {

	$idCodificado = $_POST['cambioPassword'];
	$Password = $_POST['pass1'];
	$confirmarPassword = $_POST['pass2'];

	$cambioPassword = new FormulariosAjax();
	$cambioPassword -> idEmpleados = $idCodificado;
	$cambioPassword -> Password = $Password;
	$cambioPassword -> confirmarPassword = $confirmarPassword;
	$cambioPassword -> cambioPasswordAjax();

}

if (isset($_POST['forgotEmail'])) {

	$forgotEmail = $_POST['forgotEmail'];

	$forgot_Password = new FormulariosAjax();
	$forgot_Password -> forgotEmail = $forgotEmail;
	$forgot_Password -> forgotPasswordAjax();

}

if (isset($_POST['solicitudCambio'])) {

	$solicitudCambio = $_POST['solicitudCambio'];
	$tokenPassword = $_POST['tokenPassword'];
	$Password = $_POST['pass1'];
	$confirmarPassword = $_POST['pass2'];

	$cambioPassword = new FormulariosAjax();
	$cambioPassword -> solicitudCambio = $solicitudCambio;
	$cambioPassword -> tokenPassword = $tokenPassword;
	$cambioPassword -> Password = $Password;
	$cambioPassword -> confirmarPassword = $confirmarPassword;
	$cambioPassword -> solicitudCambioPasswordAjax();

}

if (isset($_POST['EliminarEmpleado'])) {
	if ($_POST['EliminarEmpleado'] == 1) {
		$idEmpleados = $_POST['empleado'];
		$fecha_baja = $_POST['fecha_baja'];

		$EliminarEmpleado = new FormulariosAjax();
		$EliminarEmpleado -> idEmpleados = $idEmpleados;
		$EliminarEmpleado -> fecha_baja = $fecha_baja;
		$EliminarEmpleado -> eliminarEmpleadoAjax();
	}
}

if (isset($_POST['empresaId'])) {

	$empresaId = $_POST['empresaId'];

	$generarDepas = new FormulariosAjax();
	$generarDepas -> idEmpresas = $empresaId;
	$generarDepas -> buscarDepasAjax();

}

if (isset($_POST['id'])) {
	$idHorarios = $_POST['id'];

	$cambiarPredeterminado = new FormulariosAjax();
	$cambiarPredeterminado -> idHorarios = $idHorarios;
	$cambiarPredeterminado -> CambiarPredeterminadoAjax();
}

if (isset($_POST['asistencia'])) {
	$Asistencias_idAsistencias = $_POST['asistencia'];
	$comentario = $_POST['Comentario'];

	$crarJustificante = new FormulariosAjax();
	$crarJustificante -> Asistencias_idAsistencias = $Asistencias_idAsistencias;
	$crarJustificante -> comentario = $comentario;
	$crarJustificante -> CrearJustificanteHorario();
}

if (isset($_POST['aprobarJustificacion'])) {
	$idJustificantes = $_POST['aprobarJustificacion'];

	$justificar = new FormulariosAjax();
	$justificar -> aprobar = $idJustificantes;
	$justificar -> aprobarJustificacionAjax();
}

if (isset($_POST['declinarJustificacion'])) {
	$idJustificantes = $_POST['declinarJustificacion'];

	$justificar = new FormulariosAjax();
	$justificar -> declinar = $idJustificantes;
	$justificar -> declinarJustificacionAjax();
}

if (isset($_POST['genExcel'])) {
	$idEmpleados = $_POST['genExcel'];

	$generarExcel = new FormulariosAjax();
	$generarExcel -> idEmpleados = $idEmpleados;
	$generarExcel -> crearExcelAjax();
}

if (isset($_POST['genExcelEmpresas'])) {
	$idEmpresas = $_POST['genExcelEmpresas'];

	$generarExcel = new FormulariosAjax();
	$generarExcel -> idEmpresas = $idEmpresas;
	$generarExcel -> crearExcelEmpresasAjax();
}

if (isset($_POST['generarPeticion'])) {
	$idPeticiones = $_POST['generarPeticion'];
	$fechaPermiso = $_POST['fechaPermiso'];
	$fechaFin = $_POST['fechaFin'];
	$descripcion = $_POST['descripcion'];

	$GenerarPeticiones = new FormulariosAjax();
	$GenerarPeticiones -> idPeticiones = $idPeticiones;
	$GenerarPeticiones -> fechaPermiso = $fechaPermiso;
	$GenerarPeticiones -> fechaFin = $fechaFin;
	$GenerarPeticiones -> descripcion = $descripcion;
	$GenerarPeticiones -> GenerarPeticionesAjax();
}

if (isset($_POST['eliminarSolicitud'])) {
	$idPeticiones = $_POST['eliminarSolicitud'];

	$GenerarPeticiones = new FormulariosAjax();
	$GenerarPeticiones -> idPeticiones = $idPeticiones;
	$GenerarPeticiones -> eliminarPeticionesAjax();
}