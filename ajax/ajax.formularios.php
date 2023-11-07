<?php 
require_once "../controller/formularios.controlador.php";
require_once "../model/formularios.modelo.php";

require_once "../model/modelo.empleados.php";
require_once "../controller/controlador.empleados.php";

require_once "../controller/controlador.excel.php";
require_once "../model/modelo.excel.php";

session_start();
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

			$link = 'https://hucco.com.mx/Password&cambio='.$idEncript.'&forgot='.$emailEncript;
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
		$causaBaja = $this->causaBaja;
		$detalles_baja = $this->detalles_baja;
		$crear_vacante = $this->crear_vacante;

		$datos = array(
			"fecha_baja" => $fecha_baja,
			"idEmpleados" => $idEmpleados,
			"causaBaja" => $causaBaja,
			"detalles_baja" => $detalles_baja,
			"crear_vacante" => $crear_vacante
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

	public function buscarEmpleadosAjax(){
		$idEmpresas = $this->idEmpresas;
		$empleadosSeleccionados = ControladorFormularios::ctrEmpleadosEspecial("idEmpresas", $idEmpresas);
		$empleados = array();
		foreach($empleadosSeleccionados as $empleado){
			$empleados[] = $empleado;
		}
		echo json_encode($empleados);
	}

	public function CambiarPredeterminadoAjax(){
		$idHorarios = $this->idHorarios;

		$cambiar = ControladorFormularios::ctrCambiarHorarioDefault($idHorarios);
		echo json_encode($cambiar);
	}

	public function CrearJustificanteHorario(){
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

	public function aprobarVacacionesAjax(){
		$idVacaciones = $this->aprobar;
		$aprobar = ControladorFormularios::ctrAprobarVacaciones($idVacaciones);
		echo json_encode($aprobar);
	}

	public function declinarVacacionesAjax(){
		$idVacaciones = $this->declinar;
		$declinar = ControladorFormularios::ctrDeclinarVacaciones($idVacaciones);
		echo json_encode($declinar);
	}

	public function responderPermisoAjax(){
		$idEm_has_Per = $this->idEm_has_Per;
		$valor = $this->valor;
		$datos = array(
			"idEm_has_Per" => $idEm_has_Per,
			"valor" => $valor
		);
		$permiso = ControladorFormularios::ctrResponderPermisos($datos);
		echo json_encode($permiso);
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

	public function eliminarSolicitudVacacionAjax(){
		$idVacaciones = $this->idVacaciones;
		$eliminarSolicitud = ControladorFormularios::ctrEliminarSolicitudVacaciones($idVacaciones);
		echo json_encode($eliminarSolicitud);
	}

	public function asignarTareaAjax(){
		$nameTarea = $this->nameTarea;
		$descripcion = $this->descripcion;
		$empleado = $this->empleado;
		$vencimiento = $this->vencimiento;
		$datos = array(
			"nameTarea" => $nameTarea,
			"descripcion" => $descripcion,
			"Empleados_idEmpleados" => $empleado,
			"vencimiento" => $vencimiento,
			"Jefe_idEmpleados" => $_SESSION['idEmpleado']
		);
		$asignarTarea = ControladorFormularios::ctrAsignarTarea($datos);
		echo $asignarTarea;
	}

	public function entregarTareaAjax(){
		$idTarea = $this->idTarea;
		$descripcionEntrega = $this->descripcionEntrega;
		$datos = array(
			"idTarea" => $idTarea,
			"descripcionEntrega" => $descripcionEntrega,
			"Empleados_idEmpleados" => $_SESSION['idEmpleado']
		);
		$EntregarTarea = ControladorFormularios::ctrEntregarTarea($datos);
		echo $EntregarTarea;
	}

	public function finalizarTareaAjax(){
		$opinion = $this->opinion;
		$idTarea = $this->idTarea;
		$datos = array(
			"opinion" => $opinion,
			"idTarea" => $idTarea,
			"Jefe_idEmpleados" => $_SESSION['idEmpleado']
		);
		$EntregarTarea = ControladorFormularios::ctrFinalizarTarea($datos);
		echo $EntregarTarea;
	}

	public function crearVacanteAjax(){
		$nameVacante = $this->nameVacante;
		$salarioVacante = $this->salarioVacante;
		$empresaVacante = $this->empresaVacante;
		$departamentoVacante = $this->departamentoVacante;
		$requisitosVacante = $this->requisitosVacante;
		$datos = array(
			"nameVacante" => $nameVacante,
			"salarioVacante" => $salarioVacante,
			"empresaVacante" => $empresaVacante,
			"departamentoVacante" => $departamentoVacante,
			"requisitosVacante" => $requisitosVacante,
			"idEmpleados" => $_SESSION['idEmpleado']
		);
		$registro = ControladorFormularios::ctrRegistrarVacantes($datos);
		echo $registro;
	}

	public function updateVacanteAjax(){
		$nameVacante = $this->nameVacante;
		$salarioVacante = $this->salarioVacante;
		$empresaVacante = $this->empresaVacante;
		$departamentoVacante = $this->departamentoVacante;
		$requisitosVacante = $this->requisitosVacante;
		$idVacantes = $this->idVacantes;
		$datos = array(
			"nameVacante" => $nameVacante,
			"salarioVacante" => $salarioVacante,
			"empresaVacante" => $empresaVacante,
			"Departamentos_idDepartamentos" => $departamentoVacante,
			"requisitos" => $requisitosVacante,
			"idVacante" => $idVacantes
		);
		$registro = ControladorFormularios::ctrUpdateVacantes($datos);
		echo $registro;
	}

	public function activarVacante(){
		$idVacantes = $this->idVacantes;
		$valor = $this->valor;
		$datos = array(
			"idVacantes" => $idVacantes,
			"aprobado" => $valor,
			"Jefe_idEmpleados" => $_SESSION['idEmpleado']
		);
		$activarVacante = ControladorFormularios::ctrActivarVacante($datos);
		echo $activarVacante;
	}

	public function borrarExamenAjax(){
		$idExamen = $this->idExamen;
		$borrarExamen = ControladorFormularios::ctrBorrarExamen($idExamen);
		echo $borrarExamen;
	}

	public function borrarPreguntaAjax(){
		$idPregunta = $this->idPregunta;
		$borrarPregunta = ControladorFormularios::ctrBorrarPregunta($idPregunta);
		echo $borrarPregunta;
	}

	public function crearPreguntaAjax(){
		$pregunta = $this->pregunta;
		$idExamen = $this->idExamen;
		$tipo_pregunta = $this->tipo_pregunta;
		$datos = array(
			"pregunta" => $pregunta,
			"idExamen" => $idExamen,
			"tipo_pregunta" => $tipo_pregunta
		);
		$crearPregunta = ControladorFormularios::ctrCrearPregunta($datos);
		echo $crearPregunta;
	}

	public function crearExamenesAjax(){
		$titulo = $this->titulo;
		$mensaje = $this->mensaje;
		$tiempo_limite = $this->tiempo_limite;
		$fecha_inicio = $this->fecha_inicio;
		$fecha_fin = $this->fecha_fin;
		$intentos_maximos = $this->intentos_maximos;
		$idExamen = $this->idExamen;

		$datos = array(
			"titulo" => $titulo,
			"mensaje" => $mensaje,
			"tiempo_limite" => $tiempo_limite,
			"fecha_inicio" => $fecha_inicio,
			"fecha_fin" => $fecha_fin,
			"intentos_maximos" => $intentos_maximos,
			"idExamen" => $idExamen
		);

		$crearExamen = ControladorFormularios::ctrCrearExamen($datos);
		echo $crearExamen;
	}

	public function registrarRespuestasMultipleAjax(){
		$formData = $this->formData;
		$numRespuestas = $this->numRespuestas;
		$idPregunta = $this->idPregunta;

		// Convertir la cadena formData en un arreglo asociativo
		parse_str($formData, $respuestas);
		$respuesta = array();
		// Acceder a las respuestas individuales
		for ($i = 1; $i <= $numRespuestas; $i++) {

			$correcta = isset($respuestas['Correcta' . $i]) ? 1 : 0;
			$respuesta[] = array(
				'respuesta' => $respuestas['Respuesta' . $i],
				'valor' => $correcta
			);
		}
		$datos = array(
			'respuestas' => $respuesta,
			'idPregunta' =>$idPregunta
		);
		$registrarRespuestas = ControladorFormularios::ctrRegistrarRespuestasMultiple($datos);
		echo $registrarRespuestas;
	}

	public function registrarRespuestaAjax(){
		$Respuesta = $this->Respuesta;
		$Correcta = $this->Correcta;
		$idPregunta = $this->idPregunta;

		$datos = array(
			'respuesta' => $Respuesta,
			'valor' => $Correcta,
			'idPregunta' =>$idPregunta
		);

		$registrarRespuesta = ControladorFormularios::ctrRegistrarRespuesta($datos);
		echo $registrarRespuesta;
	}

	public function crearRespuestaEscalaAjax(){
		$Respuesta = 'escala';
		$Correcta = $this->escalaRespuestas;
		$idPregunta = $this->idPreguntaEscala;
		if ($Correcta == 4 || $Correcta == 5) {
			$Respuesta = 'binario';
		}

		$datos = array(
			'respuesta' => $Respuesta,
			'valor' => $Correcta,
			'idPregunta' =>$idPregunta
		);

		$registrarRespuesta = ControladorFormularios::ctrRegistrarRespuesta($datos);
		echo $registrarRespuesta;
	}

	public function eliminarRespuestaAjax(){
		$idRespuesta = $this->idRespuesta;

		$eliminarRespuesta = ModeloFormularios::mdlEliminarRespuesta($idRespuesta);
		print_r($eliminarRespuesta);
	}

	public function crearIniciarExamenAjax(){
		$idExamen = $this->idExamen;
		$idEmpleado = $_SESSION['idEmpleado'];
		$datos = array(
			"idExamen" => $idExamen,
			"idEmpleado" => $idEmpleado
		);

		$iniciarExamen = ModeloFormularios::mdlIniciarExamen($datos);
		echo $iniciarExamen;
	}

	public function inscribirEmpleadosExamenesAjax(){
		$idExamen = $this->idExamen;
		$empleados = $this->empleados;

		// Borrar los empleados asociados al horario
		$borrarEmpleados = ModeloFormularios::mdlBorrarEmpleadosExamenes($idExamen);

		if (empty($empleados)) {
			echo $borrarEmpleados;
		} else {
			if ($borrarEmpleados == 'eliminado') {				

				// Asociar los empleados al horario
				$empleados_has_examenes = ControladorFormularios::ctrEmpleadosHasExamenes($empleados, $idExamen);
				echo $empleados_has_examenes;
			} else {
				echo $borrarEmpleados;
			}
		}
	}

	public function responderPreguntaExamenAjax(){
		$preguntaId = $this->preguntaId;
		$respuestaExamen = $this->respuestaExamen;
		$idExamen = $this->examen;
		$idEmpleado = $_SESSION['idEmpleado'];
		$datos = array(
			"idPregunta" => $preguntaId,
			"respuesta" => $respuestaExamen,
			"idExamen" => $idExamen,
			"idEmpleado" => $idEmpleado
		);
		$buscarRespuestas = ModeloFormularios::mdlBuscarRespuestas($datos);
		if (empty($buscarRespuestas)) {
			$responderPreguntaExamen = ModeloFormularios::mdlResponderPreguntaExamen($datos);
		}else{
			$responderPreguntaExamen = ModeloFormularios::mdlActualizarPreguntaExamen($datos);
		}
		echo $responderPreguntaExamen;
	}

	public function terminarExamenAjax(){
		$examen = $this->examen;
		$timeMax = $this->timeMax;
		$idEmpleado = $_SESSION['idEmpleado'];
		$datos = array(
			"idExamen" => $examen,
			"timeMax" => $timeMax,
			"idEmpleado" => $idEmpleado
		);

		$terminarExamen = ControladorFormularios::ctrTerminarExamen($datos);
		echo $terminarExamen;
	}

	public function crearExcelCalificacionesAjax(){
		$idExamen = $this->idExamen;
		$generarExcel = ControladorExcel::ctrGeneralExcelCalificaciones($idExamen);
		echo $generarExcel;
	}

	public function addDivisaAjax(){
		$nameDivisa = $this->nameDivisa;
		$divisa = $this->divisa;
		$addDivisa = ControladorFormularios::ctrAddDivisa($nameDivisa, $divisa);
		echo $addDivisa;
	}

	public function delDivisaAjax(){
		$eliminarDivisa = $this->eliminarDivisa;
		$delDivisa = ControladorFormularios::ctrDelDivisa($eliminarDivisa);
		echo $delDivisa;
	}

	public function addCategoriaAjax(){
		$nameCategoria = $this->nameCategoria;
		$addCategoria = ControladorFormularios::ctrAddCategoria($nameCategoria);
		echo $addCategoria;
	}

	public function delCategoriaAjax(){
		$eliminarCategoria = $this->eliminarCategoria;
		$delCategoria = ControladorFormularios::ctrDelCategoria($eliminarCategoria);
		echo $delCategoria;
	}

	public function addGastoAjax(){
		$categoria = $this->categoria;
		$nameVendedor = $this->nameVendedor;
		$divisa = $this->divisa;
		$importeTotal = $this->importeTotal;
		$importeIVA = $this->importeIVA;
		$fechaDocumento = $this->fechaDocumento;
		$descripcionGasto = $this->descripcionGasto;
		$referenciaInterna = $this->referenciaInterna;
		$folio = $this->folio;

		$datos = array(
			"categoria" => $categoria,
			"nameVendedor" => $nameVendedor,
			"divisa" => $divisa,
			"importeTotal" => $importeTotal,
			"importeIVA" => $importeIVA,
			"fechaDocumento" => $fechaDocumento,
			"descripcionGasto" => $descripcionGasto,
			"referenciaInterna" => $referenciaInterna,
			"folio" => $folio,
			"Empleados_idEmpleados" => $_SESSION['idEmpleado']
		);

		$addGasto = ControladorFormularios::ctrAddGasto($datos);
		echo $addGasto;
	}

	public function delGastoAjax(){
		$idGastos = $this->idGastos;
		$delGasto = ControladorFormularios::ctrDelGasto($idGastos);
		echo $delGasto;
	}

	public function updateGastoAjax(){
		$idGastos = $this->idGastos;
		$categoria = $this->categoria;
		$nameVendedor = $this->nameVendedor;
		$divisa = $this->divisa;
		$importeTotal = $this->importeTotal;
		$importeIVA = $this->importeIVA;
		$fechaDocumento = $this->fechaDocumento;
		$descripcionGasto = $this->descripcionGasto;
		$referenciaInterna = $this->referenciaInterna;

		$datos = array(
			"idGastos" => $idGastos,
			"categoria" => $categoria,
			"nameVendedor" => $nameVendedor,
			"divisa" => $divisa,
			"importeTotal" => $importeTotal,
			"importeIVA" => $importeIVA,
			"fechaDocumento" => $fechaDocumento,
			"descripcionGasto" => $descripcionGasto,
			"referenciaInterna" => $referenciaInterna
		);

		$updateGasto = ControladorFormularios::ctrUpdateGasto($datos);
		echo $updateGasto;
	}

	public function delDocGastoAjax(){
		$idDocumento_Gasto = $this->idDocumento_Gasto;
		$idGastos = $this->idGastos;
		$nameDocumento = $this->nameDocumento;
		$delDocGasto = ControladorFormularios::ctrDelDocGasto($idGastos, $idDocumento_Gasto, $nameDocumento);
		echo $delDocGasto;
	}

	public function excelGastoAjax(){
		$idGastos = $this->idGastos;
		$excelDocGasto = ControladorFormularios::excelDocGasto($idGastos);
		echo $excelDocGasto;
	}

	public function pdfGastoAjax(){
		$idGastos = $this->idGastos;
		$excelDocGasto = ControladorFormularios::pdfDocGasto($idGastos);
		echo json_encode($excelDocGasto);
	}

	public function aceptarGastoAjax(){
		$idGastos = $this->idGastos;
		$aceptarGasto = ControladorFormularios::ctrAceptarGasto($idGastos, 1);
		echo $aceptarGasto;
	}

	public function rechazarGastoAjax(){
		$idGastos = $this->idGastos;
		$rechazarGasto = ControladorFormularios::ctrAceptarGasto($idGastos, 2);
		echo $rechazarGasto;
	}

	public function finalizarMotivoAjax(){
		$idFolio_Gasto = $this->idFolio_Gasto;
		$finalizarFolio = ControladorFormularios::ctrFinalizarFolio($idFolio_Gasto);
		echo $finalizarFolio;
	}

	public function marcarPagadoAjax(){
		$idGastos = $this->idGastos;
		$marcarPagado = ControladorFormularios::ctrMarcarPagado($idGastos);
		echo $marcarPagado;
	}

	public function cambioPasswordAjax2(){
		$idEmpleados = $_SESSION['idEmpleado'];
		$antiguoPassword = $this->antiguoPassword;
		$passwordNew = $this->passwordNew;

		$pass1 = crypt($antiguoPassword, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
		$pass2 = crypt($passwordNew, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
		// Verificar si las contraseñas cumplen los requisitos
		$regex = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/';

		$tabla = "empleados";
		$empleado = ControladorEmpleados::ctrVerEmpleados('idEmpleados',$idEmpleados);
		if ($empleado['password'] == $pass1) {
			if ($pass1 == $pass2) {
				echo 'error: iguales';
			}else{
				if ($_SERVER['REQUEST_METHOD'] === 'POST') {

					if (!preg_match($regex, $passwordNew)) {
						echo 'error: data';
					} else {
						$data = array(
							"idEmpleados" => $idEmpleados,
							"password" => $pass2
						);

						$cambio = ControladorEmpleados::ctrCambioPassword($tabla,$data);
						echo $cambio;
					}
				}
			}
		}else{
			echo 'error: coincide';
		}
	}

	public function actualizarFotoAjax(){
		$file = $this->file;

		if ($file["error"] == 0) {
			// Obtener los datos del archivo
			$imagen = $file;
			$tabla = "foto_empleado";
			$imageName = $_SESSION["name"] . " " . $_SESSION["lastname"];

			// Obtener la extensión del archivo
			$extension = pathinfo($imagen["name"], PATHINFO_EXTENSION);

			// Renombrar la imagen con el nombre y apellidos proporcionados, más la extensión
			$imageFileName = $imageName . "." . $extension;

			// Guardar la imagen original en el servidor
			$uploadPath = "../view/fotos/" . $imageFileName;
			move_uploaded_file($imagen["tmp_name"], $uploadPath);

			// Obtener la ruta para la imagen en miniatura
			$thumbnailPath = "../view/fotos/thumbnails/" . $imageFileName;

			// Cargar la imagen original
			$originalImage = imagecreatefromstring(file_get_contents($uploadPath));

			// Obtener las dimensiones originales de la imagen
			$originalWidth = imagesx($originalImage);
			$originalHeight = imagesy($originalImage);

			// Calcular las nuevas dimensiones para la imagen en miniatura
			$maxSize = 150;
			$scale = min($maxSize / $originalWidth, $maxSize / $originalHeight);
			$newWidth = round($scale * $originalWidth);
			$newHeight = round($scale * $originalHeight);

			// Crear la imagen en miniatura
			$thumbnailImage = imagecreatetruecolor($newWidth, $newHeight);
			imagecopyresampled($thumbnailImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

			// Guardar la imagen en miniatura en el servidor
			imagepng($thumbnailImage, $thumbnailPath);

			// Guardar los datos en la base de datos
			$datos = array("imageName" => $imageFileName,
				"idEmpleado" => $_SESSION['idEmpleado']
			);
			$busqueda = ModeloFormularios::mdlVerFotos($tabla, 'Empleados_idEmpleados', $_SESSION['idEmpleado']);
			if (empty($busqueda)) {
				$respuesta = ModeloFormularios::mdlRegistroFotoEmpleado($tabla, $datos);
			}else{
				$respuesta = ModeloFormularios::mdlActualizarFotoEmpleado($tabla, $datos);
			}

			echo $respuesta;
		}else{
			echo json_encode($file);
		}
	}

	public function actualizarDatosAjax(){
		$nombre = $this -> nombre;
		$genero = $this -> genero;
		$apellidos = $this -> apellidos;
		$fecha_nacimiento = $this -> fecha_nacimiento;
		$calle = $this -> calle;
		$num_exterior = $this -> num_exterior;
		$num_interior = $this -> num_interior;
		$colonia = $this -> colonia;
		$cp = $this -> cp;
		$estado = $this -> estado;
		$municipio = $this -> municipio;

		$datos = array(
			"nombre" => $nombre,
			"apellidos" => $apellidos,
			"genero" => $genero,
			"fecha_nacimiento" => $fecha_nacimiento,
			"calle" => $calle,
			"num_exterior" => $num_exterior,
			"num_interior" => $num_interior,
			"colonia" => $colonia,
			"cp" => $cp,
			"estado" => $estado,
			"municipio" => $municipio,
			"idEmpleados" => $_SESSION['idEmpleado']
		);

		$actualizarDatos = ModeloEmpleados::mdlActualizarEmpleadoPerfil($datos);
		echo $actualizarDatos;
	}

	public function crearContratoAjax(){
		$idEmpleados = $this -> idEmpleados;
		$tipo_contrato = $this -> tipo_contrato;
		$fecha_contrato = $this -> fecha_contrato;
		$fin_contrato = $this -> fin_contrato;
		$datosContrato = array(
			"Empleados_idEmpleados" => $idEmpleados,
			"tipo_contrato" => $tipo_contrato,
			"fecha_contrato" => $fecha_contrato,
			"fin_contrato" => $fin_contrato
		);
		if ($tipo_contrato != "" && $fecha_contrato != "") {
			$crearContrato = ModeloFormularios::mdlCrearContrato($datosContrato);
			echo "ok";
		}else{
			echo "error";
		}
	}

	public function crearCreditoAjax(){
		$idEmpleados = $this -> idEmpleados;
		$tipo_credito = $this -> tipo_credito;
		$numero_credito = $this -> numero_credito;
		$valor_descuento = $this -> valor_descuento;
		$inicio_credito = $this -> inicio_credito;
		$datosCredito = array(
			"Empleados_idEmpleados" => $idEmpleados,
			"tipo_credito" => $tipo_credito,
			"numero_credito" => $numero_credito,
			"valor_descuento" => $valor_descuento,
			"inicio_credito" => $inicio_credito
		);
		if ($tipo_credito != "" && $numero_credito != "" && $valor_descuento != "" && $inicio_credito != "") {
			$crearCredito = ModeloFormularios::mdlCrearCredito($datosCredito);
			echo "ok";
		}else{
			echo "error";
		}
	}

	public function delPermisoAjax(){
		$idPermisos = $this -> idPermisos;
		$delPermiso = ModeloFormularios::mdlDelPermiso($idPermisos);
		echo $delPermiso;
	}

	public function crearIncapacidadAjax(){

		$ramo_seguro = $this -> ramo_seguro;
		$tipo_riesgo = $this -> tipo_riesgo;
		$secuela_consecuencia = $this -> secuela_consecuencia;
		$control_incapacidad = $this -> control_incapacidad;
		$fecha_inicio = $this -> fecha_inicio;
		$fecha_termino = $this -> fecha_termino;
		$folio = $this -> folio;
		$dias = $this -> dias;
		$porcentaje = $this -> porcentaje;
		$idEmpleados = $_SESSION['idEmpleado'];

		$datos = array(
			"ramo_seguro" => $ramo_seguro,
			"tipo_riesgo" => $tipo_riesgo,
			"secuela_consecuencia" => $secuela_consecuencia,
			"control_incapacidad" => $control_incapacidad,
			"fecha_inicio" => $fecha_inicio,
			"fecha_termino" => $fecha_termino,
			"folio" => $folio,
			"dias" => $dias,
			"porcentaje" => $porcentaje,
			"idEmpleados" => $idEmpleados
		);

		$crearIncapacidad = ControladorFormularios::ctrCrearIncapacidad($datos);
		echo $crearIncapacidad;
	
	}

	public function ocultarIncapacidadesAjax(){
		$idIncapacidades = $this -> idIncapacidades;
		$delIncapacidad = ModeloFormularios::mdlDelIncapacidad($idIncapacidades);
		echo $delIncapacidad;
	}

	public function crearRolesAjax(){
		$idEmpleados = $this -> idEmpleados;
		$Ver_Empleados = $this -> Ver_Empleados;
		$Editar_Empleados = $this -> Editar_Empleados;
		$Del_Empleados = $this -> Del_Empleados;
		$Ver_Departamentos = $this -> Ver_Departamentos;
		$Editar_Departamentos = $this -> Editar_Departamentos;
		$Del_Departamentos = $this -> Del_Departamentos;
		$Ver_Evaluaciones = $this -> Ver_Evaluaciones;
		$Editar_Evaluaciones = $this -> Editar_Evaluaciones;
		$Del_Evaluaciones = $this -> Del_Evaluaciones;
		$Resumenes_Asistencias = $this -> Resumenes_Asistencias;
		$Ajustes_Asistencias = $this -> Ajustes_Asistencias;
		$Ver_Tareas = $this -> Ver_Tareas;
		$Editar_Tareas = $this -> Editar_Tareas;
		$Del_Tareas = $this -> Del_Tareas;
		$Asignar_EmpleadoMes = $this -> Asignar_EmpleadoMes;
		$Ver_Analisis = $this -> Ver_Analisis;
		$Ver_Reclutamiento = $this -> Ver_Reclutamiento;
		$Editar_Reclutamiento = $this -> Editar_Reclutamiento;
		$Del_Reclutamiento = $this -> Del_Reclutamiento;
		$General_Reclutamiento = $this -> General_Reclutamiento;
		$Ver_Organigramas = $this -> Ver_Organigramas;
		$Agregar_Noticias = $this -> Agregar_Noticias;
		$Editar_Noticias = $this -> Editar_Noticias;
		$Del_Noticias = $this -> Del_Noticias;
		$Ver_Empresas = $this -> Ver_Empresas;
		$Editar_Empresas = $this -> Editar_Empresas;
		$Configuracion_Divisas = $this -> Configuracion_Divisas;
		$Configuracion_Categorias = $this -> Configuracion_Categorias;
		$Configuracion_Permisos = $this -> Configuracion_Permisos;

		$datos = array(
			"idEmpleados" => $idEmpleados,
			"Ver_Empleados" => $Ver_Empleados,
			"Editar_Empleados" => $Editar_Empleados,
			"Del_Empleados" => $Del_Empleados,
			"Ver_Departamentos" => $Ver_Departamentos,
			"Editar_Departamentos" => $Editar_Departamentos,
			"Del_Departamentos" => $Del_Departamentos,
			"Ver_Evaluaciones" => $Ver_Evaluaciones,
			"Editar_Evaluaciones" => $Editar_Evaluaciones,
			"Del_Evaluaciones" => $Del_Evaluaciones,
			"Resumenes_Asistencias" => $Resumenes_Asistencias,
			"Ajustes_Asistencias" => $Ajustes_Asistencias,
			"Ver_Tareas" => $Ver_Tareas,
			"Editar_Tareas" => $Editar_Tareas,
			"Del_Tareas" => $Del_Tareas,
			"Asignar_EmpleadoMes" => $Asignar_EmpleadoMes,
			"Ver_Analisis" => $Ver_Analisis,
			"Ver_Reclutamiento" => $Ver_Reclutamiento,
			"Editar_Reclutamiento" => $Editar_Reclutamiento,
			"Del_Reclutamiento" => $Del_Reclutamiento,
			"General_Reclutamiento" => $General_Reclutamiento,
			"Ver_Organigramas" => $Ver_Organigramas,
			"Agregar_Noticias" => $Agregar_Noticias,
			"Editar_Noticias" => $Editar_Noticias,
			"Del_Noticias" => $Del_Noticias,
			"Ver_Empresas" => $Ver_Empresas,
			"Editar_Empresas" => $Editar_Empresas,
			"Configuracion_Divisas" => $Configuracion_Divisas,
			"Configuracion_Categorias" => $Configuracion_Categorias,
			"Configuracion_Permisos" => $Configuracion_Permisos
		);
		$buscarEmpleadoRol = ModeloFormularios::mdlVerRoles("Empleados_idEmpleados", $idEmpleados);

		if (empty($buscarEmpleadoRol)) {
			$crearRoles = ModeloFormularios::mdlCrearRol($datos);
			echo $crearRoles;
		}else{
			$crearRoles = ModeloFormularios::mdlActualizarRol($datos);
			echo $crearRoles;
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
		$causaBaja = $_POST['causaBaja'];
		$detalles_baja = $_POST['detalles_baja'];
		$crear_vacante = $_POST['crear_vacante'];

		$EliminarEmpleado = new FormulariosAjax();
		$EliminarEmpleado -> idEmpleados = $idEmpleados;
		$EliminarEmpleado -> fecha_baja = $fecha_baja;
		$EliminarEmpleado -> causaBaja = $causaBaja;
		$EliminarEmpleado -> detalles_baja = $detalles_baja;
		$EliminarEmpleado -> crear_vacante = $crear_vacante;
		$EliminarEmpleado -> eliminarEmpleadoAjax();
	}
}

if (isset($_POST['empresaId'])) {

	$empresaId = $_POST['empresaId'];

	$generarDepas = new FormulariosAjax();
	$generarDepas -> idEmpresas = $empresaId;
	$generarDepas -> buscarDepasAjax();

}

if (isset($_POST['empresaEmpleadoID'])) {

	$empresaEmpleadoID = $_POST['empresaEmpleadoID'];

	$generarDepas = new FormulariosAjax();
	$generarDepas -> idEmpresas = $empresaEmpleadoID;
	$generarDepas -> buscarEmpleadosAjax();

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

if (isset($_POST['aprobarVacaciones'])) {
	$idVacaciones = $_POST['aprobarVacaciones'];

	$respuestaVacaciones = new FormulariosAjax();
	$respuestaVacaciones -> aprobar = $idVacaciones;
	$respuestaVacaciones -> aprobarVacacionesAjax();
}

if (isset($_POST['declinarVacaciones'])) {
	$idVacaciones = $_POST['declinarVacaciones'];

	$respuestaVacaciones = new FormulariosAjax();
	$respuestaVacaciones -> declinar = $idVacaciones;
	$respuestaVacaciones -> declinarVacacionesAjax();
}

if (isset($_POST['aprobarPermiso'])) {
	$idEm_has_Per = $_POST['aprobarPermiso'];
	$valor = 1;

	$permiso = new FormulariosAjax();
	$permiso -> idEm_has_Per = $idEm_has_Per;
	$permiso -> valor = $valor;
	$permiso -> responderPermisoAjax();
}

if (isset($_POST['declinarPermiso'])) {
	$idEm_has_Per = $_POST['declinarPermiso'];
	$valor = 2;

	$permiso = new FormulariosAjax();
	$permiso -> idEm_has_Per = $idEm_has_Per;
	$permiso -> valor = $valor;
	$permiso -> responderPermisoAjax();
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

if (isset($_POST['eliminarVSolicitud'])) {
	$idVacaciones = $_POST['eliminarVSolicitud'];

	$GenerarPeticiones = new FormulariosAjax();
	$GenerarPeticiones -> idVacaciones = $idVacaciones;
	$GenerarPeticiones -> eliminarSolicitudVacacionAjax();
}

if (isset($_POST['eliminarISolicitud'])) {
	$idIncapacidades = $_POST['eliminarISolicitud'];

	$ocultarIncapacidades = new FormulariosAjax();
	$ocultarIncapacidades -> idIncapacidades = $idIncapacidades;
	$ocultarIncapacidades -> ocultarIncapacidadesAjax();
}

if (isset($_POST['nameTarea'])) {
	$nameTarea = $_POST['nameTarea'];
	$descripcion = $_POST['descripcion'];
	$empleado = $_POST['empleado'];
	$vencimiento = $_POST['vencimiento'];

	$asignarTarea = new FormulariosAjax();
	$asignarTarea -> nameTarea = $nameTarea;
	$asignarTarea -> descripcion = $descripcion;
	$asignarTarea -> empleado = $empleado;
	$asignarTarea -> vencimiento = $vencimiento;
	$asignarTarea -> asignarTareaAjax();
}

if (isset($_POST['descripcionEntrega'])) {
	$idTarea = $_POST['idTarea'];
	$descripcionEntrega = $_POST['descripcionEntrega'];

	$asignarTarea = new FormulariosAjax();
	$asignarTarea -> idTarea = $idTarea;
	$asignarTarea -> descripcionEntrega = $descripcionEntrega;
	$asignarTarea -> entregarTareaAjax();
}

if (isset($_POST['resultadoTarea'])) {
	$opinion = $_POST['opinionTarea'];
	$idTarea = $_POST['resultadoTarea'];

	$asignarTarea = new FormulariosAjax();
	$asignarTarea -> opinion = $opinion;
	$asignarTarea -> idTarea = $idTarea;
	$asignarTarea -> finalizarTareaAjax();
}

if (isset($_POST['vacante_creada'])) {
	if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nameVacante"])){

		$nameVacante = $_POST['nameVacante'];
		$salarioVacante = $_POST['salarioVacante'];
		$empresaVacante = $_POST['empresaVacante'];
		$departamentoVacante = $_POST['departamentoVacante'];
		$requisitosVacante = $_POST['requisitosVacante'];
		$idVacantes = $_POST['vacante_creada'];

		$crearVacante = new FormulariosAjax();
		$crearVacante -> nameVacante = $nameVacante;
		$crearVacante -> salarioVacante = $salarioVacante;
		$crearVacante -> empresaVacante = $empresaVacante;
		$crearVacante -> departamentoVacante = $departamentoVacante;
		$crearVacante -> requisitosVacante = $requisitosVacante;
		$crearVacante -> idVacantes = $idVacantes;
		if ($idVacantes == 0) {
			$crearVacante -> crearVacanteAjax();
		}else{
			$crearVacante -> updateVacanteAjax();
		}

	}else{
		echo "2";
	}
}

if (isset($_POST['idVacantes'])) {
	$idVacantes = $_POST['idVacantes'];
	$valor = $_POST['respuestaVacante'];

	$crearVacante = new FormulariosAjax();
	$crearVacante -> idVacantes = $idVacantes;
	$crearVacante -> valor = $valor;
	$crearVacante -> activarVacante();
}

if (isset($_POST['eliminarExamen'])) {
	$idExamen = $_POST['eliminarExamen'];

	$borrarExamen = new FormulariosAjax();
	$borrarExamen -> idExamen = $idExamen;
	$borrarExamen -> borrarExamenAjax();
}

if (isset($_POST['delPregunta'])) {
	$idPregunta = $_POST['delPregunta'];

	$borrarPregunta = new FormulariosAjax();
	$borrarPregunta -> idPregunta = $idPregunta;
	$borrarPregunta -> borrarPreguntaAjax();
}

if (isset($_POST['pregunta'])) {
	if ($_POST['pregunta'] == '' || $_POST['tipo_pregunta'] == '') {
		return 'campos vacios';
	}else{
		$pregunta = $_POST['pregunta'];
		$tipo_pregunta = $_POST['tipo_pregunta'];
		$idExamen = $_POST['examen'];

		$crearPregunta = new FormulariosAjax();
		$crearPregunta -> pregunta = $pregunta;
		$crearPregunta -> tipo_pregunta = $tipo_pregunta;
		$crearPregunta -> idExamen = $idExamen;
		$crearPregunta -> crearPreguntaAjax();
	}
}

if (isset($_POST['titulo'])) {

	$mensaje = null;
	$tiempo_limite = null;
	$fecha_inicio = null;
	$fecha_fin = null;
	$intentos_maximos = null;

	$titulo = $_POST['titulo'];
	$idExamen = $_POST['idExamen'];

	if ($_POST['mensaje'] != 'null') {
		$mensaje = $_POST['mensaje'];
	}
	if (isset($_POST['tiempo_limite'])) {
		$tiempo_limite = $_POST['tiempo_limite'];
	}
	if (isset($_POST['fecha_inicio'])) {
		$fecha_inicio = $_POST['fecha_inicio'];
	}
	if (isset($_POST['fecha_fin'])) {
		$fecha_fin = $_POST['fecha_fin'];
	}
	if (isset($_POST['intentos_maximos'])) {
		$intentos_maximos = $_POST['intentos_maximos'];
	}

	$crearExamenes = new FormulariosAjax();
	$crearExamenes -> titulo = $titulo;
	$crearExamenes -> mensaje = $mensaje;
	$crearExamenes -> tiempo_limite = $tiempo_limite;
	$crearExamenes -> fecha_inicio = $fecha_inicio;
	$crearExamenes -> fecha_fin = $fecha_fin;
	$crearExamenes -> intentos_maximos = $intentos_maximos;
	$crearExamenes -> idExamen = $idExamen;
	$crearExamenes -> crearExamenesAjax();
}

if (isset($_POST['numRespuestas'])) {
	$formData = $_POST['formData'];
	$numRespuestas = $_POST['numRespuestas'];
	$idPregunta = $_POST['idPregunta'];

	$registrarRespuestas = new FormulariosAjax();
	$registrarRespuestas -> formData = $formData;
	$registrarRespuestas -> numRespuestas = $numRespuestas;
	$registrarRespuestas -> idPregunta = $idPregunta;
	$registrarRespuestas -> registrarRespuestasMultipleAjax();
}

if (isset($_POST['idAddRespuesta'])) {
	$Respuesta = $_POST['Respuesta'];
	if (isset($_POST['Correcta'])) {
		$Correcta = 1;
	}else{
		$Correcta = 0;
	}
	$idPregunta = $_POST['idAddRespuesta'];

	$registrarRespuesta = new FormulariosAjax();
	$registrarRespuesta -> Respuesta = $Respuesta;
	$registrarRespuesta -> Correcta = $Correcta;
	$registrarRespuesta -> idPregunta = $idPregunta;
	$registrarRespuesta -> registrarRespuestaAjax();
}

if (isset($_POST['eliminarRespuesta'])) {
	$idRespuesta = $_POST['eliminarRespuesta'];

	$eliminarRespuesta = new FormulariosAjax();
	$eliminarRespuesta -> idRespuesta = $idRespuesta;
	$eliminarRespuesta -> eliminarRespuestaAjax();
}

if (isset($_POST['empleados_examenes'])) {
	$idExamen = $_POST['empleados_examenes'];
	if (isset($_POST['empleados_has_examenes'])) {
		$empleados = $_POST['empleados_has_examenes'];
	}else{
		$empleados = array();
	}

	$empleados_has_examenes = new FormulariosAjax();
	$empleados_has_examenes -> idExamen = $idExamen;
	$empleados_has_examenes -> empleados = $empleados;
	$empleados_has_examenes -> inscribirEmpleadosExamenesAjax();
}

if (isset($_POST['idPreguntaEscala'])) {
	$idPreguntaEscala = $_POST['idPreguntaEscala'];
	$escalaRespuestas = $_POST['escalaRespuestas'];
	if ($escalaRespuestas == 2) {
		$escalaRespuestas = $_POST['binario'];
	}

	$crearRespuesta = new FormulariosAjax();
	$crearRespuesta -> idPreguntaEscala = $idPreguntaEscala;
	$crearRespuesta -> escalaRespuestas = $escalaRespuestas;
	$crearRespuesta -> crearRespuestaEscalaAjax();
}

if (isset($_POST['iniciar_examen'])) {
	$idExamen = $_POST['iniciar_examen'];

	$iniciarExamen = new FormulariosAjax();
	$iniciarExamen -> idExamen = $idExamen;
	$iniciarExamen -> crearIniciarExamenAjax();
}

if (isset($_POST['preguntaId'])) {
	$preguntaId = $_POST['preguntaId'];
	$respuestaExamen = $_POST['respuestaExamen'];
	$examen = $_POST['examen'];

	$responderPreguntaExamen = new FormulariosAjax();
	$responderPreguntaExamen -> preguntaId = $preguntaId;
	$responderPreguntaExamen -> respuestaExamen = $respuestaExamen;
	$responderPreguntaExamen -> examen = $examen;
	$responderPreguntaExamen -> responderPreguntaExamenAjax();
}

if (isset($_POST['tiempoTerminado'])) {
	if ($_POST['tiempoTerminado'] == true) {
		$examen = $_POST['examen'];
		$timeMax = $_POST['timeMax'];

		$terminarExamen = new FormulariosAjax();
		$terminarExamen -> examen = $examen;
		$terminarExamen -> timeMax = $timeMax;
		$terminarExamen -> terminarExamenAjax();
	}
}

if (isset($_POST['examenFinalizado'])) {
	if ($_POST['examenFinalizado'] == true) {
		$examen = $_POST['examen'];
		$timeMax = $_POST['timeMax'];

		$terminarExamen = new FormulariosAjax();
		$terminarExamen -> examen = $examen;
		$terminarExamen -> timeMax = $timeMax;
		$terminarExamen -> terminarExamenAjax();
	}
}

if (isset($_POST['genExcelExamen'])) {
	$idExamen = $_POST['genExcelExamen'];

	$responderPreguntaExamen = new FormulariosAjax();
	$responderPreguntaExamen -> idExamen = $idExamen;
	$responderPreguntaExamen -> crearExcelCalificacionesAjax();
}

if (isset($_POST['nameDivisa'])) {
	$nameDivisa = $_POST['nameDivisa'];
	$divisa = mb_strtoupper($_POST['divisa']);

	$addDivisa = new FormulariosAjax();
	$addDivisa -> nameDivisa = $nameDivisa;
	$addDivisa -> divisa = $divisa;
	$addDivisa -> addDivisaAjax();
}

if (isset($_POST['eliminarDivisa'])) {
	$eliminarDivisa = $_POST['eliminarDivisa'];

	$delDivisa = new FormulariosAjax();
	$delDivisa -> eliminarDivisa = $eliminarDivisa;
	$delDivisa -> delDivisaAjax();
}

if (isset($_POST['nameCategoria'])) {
	$nameCategoria = $_POST['nameCategoria'];

	$addCategoria = new FormulariosAjax();
	$addCategoria -> nameCategoria = $nameCategoria;
	$addCategoria -> addCategoriaAjax();
}

if (isset($_POST['eliminarCategoria'])) {
	$eliminarCategoria = $_POST['eliminarCategoria'];

	$delCategoria = new FormulariosAjax();
	$delCategoria -> eliminarCategoria = $eliminarCategoria;
	$delCategoria -> delCategoriaAjax();
}

if (isset($_POST['nameVendedor'])) {
	if ($_POST['categoria'] == null) {
		echo "error-categoria";
	}elseif ($_POST['nfolio'] == null && $_POST['folio'] == 'otra') {
		echo "error-folio";
	}elseif ($_POST['nameVendedor'] == null) {
		echo "error-nameVendedor";
	}elseif ($_POST['divisa'] == null) {
		echo "error-divisa";
	}elseif ($_POST['importeTotal'] == null) {
		echo "error-importeTotal";
	}elseif ($_POST['importeIVA'] == null) {
		echo "error-importeIVA";
	}elseif ($_POST['fechaDocumento'] == null) {
		echo "error-fechaDocumento";
	}elseif ($_POST['descripcionGasto'] == null) {
		echo "error-descripcionGasto";
	}else{
		// Recuperar los datos del formulario
		$categoria = $_POST['categoria'];
		$nameVendedor = $_POST['nameVendedor'];
		$divisa = $_POST['divisa'];
		$importeTotal = $_POST['importeTotal'];
		$importeIVA = $_POST['importeIVA'];
		$fechaDocumento = $_POST['fechaDocumento'];
		$descripcionGasto = $_POST['descripcionGasto'];
		$referenciaInterna = $_POST['referenciaInterna'];
		if ($_POST['folio'] == 'otra') {
			$folio = ControladorFormularios::ctrRegistrarFolioGastos($_POST['nfolio'], $_SESSION['idEmpleado']);
		}else{
			$folio = $_POST['folio'];
		}
		

		$addGasto = new FormulariosAjax();
		$addGasto -> categoria = $categoria;
		$addGasto -> nameVendedor = $nameVendedor;
		$addGasto -> divisa = $divisa;
		$addGasto -> importeTotal = $importeTotal;
		$addGasto -> importeIVA = $importeIVA;
		$addGasto -> fechaDocumento = $fechaDocumento;
		$addGasto -> descripcionGasto = $descripcionGasto;
		$addGasto -> referenciaInterna = $referenciaInterna;
		$addGasto -> folio = $folio;
		$addGasto -> addGastoAjax();
	}
}

if (isset($_POST['idGasto'])) {
	$idGasto = $_POST['idGasto'];

	// Iterar sobre el arreglo de archivos
	foreach ($_FILES['file']['name'] as $index => $fileName) {
		$targetDir = "../view/Gastos/".$idGasto. "/";

		$baseName = basename($fileName);

		if (!file_exists($targetDir)) {
			// Crear la carpeta
			mkdir($targetDir, 0777, true); // Los permisos 0777 aseguran que la carpeta tenga todos los permisos
		}

		$targetFilePath = $targetDir .'/'. $baseName;
		$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
		if ($fileType == 'pdf') {
			$tipo = 'pdf';
		} else {
			$tipo = 'excel';
		}

		$uploadOk = 1;
		$i = 1;

		// Verificar si el archivo ya existe y renombrarlo si es necesario
		while (file_exists($targetFilePath)) {
			$baseName = pathinfo($fileName, PATHINFO_FILENAME) . "($i)." . $fileType;
			$targetFilePath = $targetDir . $baseName;
			$i++;
		}

		// Verificar el tamaño máximo del archivo (10MB)
		if ($_FILES["file"]["size"][$index] > 10 * 1024 * 1024) {
			echo "error_tamano";
			$uploadOk = 0;
		}

		// Verificar los tipos de archivo permitidos (.xlsx, .xls, .pdf)
		$allowedExtensions = array("xlsx", "xls", "pdf");
		if (!in_array($fileType, $allowedExtensions)) {
			echo "error_tipo";
			$uploadOk = 0;
		}

		if ($uploadOk == 0) {
			echo "error";
		} else {
			// Mover el archivo cargado al directorio de destino
			if (move_uploaded_file($_FILES["file"]["tmp_name"][$index], $targetFilePath)) {
				$data = array(
					"Gastos_idGastos" => $idGasto,
					"tipo" => $tipo,
					"nameDocumento" => $baseName
				);
				$registrarDocumentosGastos = ControladorFormularios::ctrRegistrarDocumentosGastos($data);
				echo $registrarDocumentosGastos;
			} else {
				echo "error";
			}
		}
	}
}

if (isset($_POST['eliminarGasto'])) {
	$idGastos = $_POST['eliminarGasto'];

	$eliminarGasto = new FormulariosAjax();
	$eliminarGasto -> idGastos = $idGastos;
	$eliminarGasto -> delGastoAjax();
}

if (isset($_POST['actualizarGastoUpdate'])) {
	if ($_POST['categoriaUpdate'] == null) {
		echo "error-categoria";
	}elseif ($_POST['nameVendedorUpdate'] == null) {
		echo "error-nameVendedor";
	}elseif ($_POST['divisaUpdate'] == null) {
		echo "error-divisa";
	}elseif ($_POST['importeTotalUpdate'] == null) {
		echo "error-importeTotal";
	}elseif ($_POST['importeIVAUpdate'] == null) {
		echo "error-importeIVA";
	}elseif ($_POST['fechaDocumentoUpdate'] == null) {
		echo "error-fechaDocumento";
	}elseif ($_POST['descripcionGastoUpdate'] == null) {
		echo "error-descripcionGasto";
	}else{
		// Recuperar los datos del formulario
		$idGastos = $_POST['actualizarGastoUpdate'];
		$categoria = $_POST['categoriaUpdate'];
		$nameVendedor = $_POST['nameVendedorUpdate'];
		$divisa = $_POST['divisaUpdate'];
		$importeTotal = $_POST['importeTotalUpdate'];
		$importeIVA = $_POST['importeIVAUpdate'];
		$fechaDocumento = $_POST['fechaDocumentoUpdate'];
		$descripcionGasto = $_POST['descripcionGastoUpdate'];
		$referenciaInterna = $_POST['referenciaInternaUpdate'];

		$updateGasto = new FormulariosAjax();
		$updateGasto -> idGastos = $idGastos;
		$updateGasto -> categoria = $categoria;
		$updateGasto -> nameVendedor = $nameVendedor;
		$updateGasto -> divisa = $divisa;
		$updateGasto -> importeTotal = $importeTotal;
		$updateGasto -> importeIVA = $importeIVA;
		$updateGasto -> fechaDocumento = $fechaDocumento;
		$updateGasto -> descripcionGasto = $descripcionGasto;
		$updateGasto -> referenciaInterna = $referenciaInterna;
		$updateGasto -> updateGastoAjax();
	}
}

if (isset($_POST['eliminarDocumento'])) {
	$idDocumento_Gasto = $_POST['eliminarDocumento'];
	$idGastos = $_POST['eliminarDocumentoGasto'];
	$nameDocumento = $_POST['eliminarNameDocumento'];

	$eliminarDocGasto = new FormulariosAjax();
	$eliminarDocGasto -> idGastos = $idGastos;
	$eliminarDocGasto -> idDocumento_Gasto = $idDocumento_Gasto;
	$eliminarDocGasto -> nameDocumento = $nameDocumento;
	$eliminarDocGasto -> delDocGastoAjax();
}

if (isset($_POST['addDocNew'])) {
	$idGasto = $_POST['addDocNew'];

	// Verificar si se cargó un archivo
	if (isset($_FILES['file']) && $_FILES['file']['name'] !== '') {
		// Obtener información del archivo
		$fileName = $_FILES['file']['name'];
		$fileSize = $_FILES['file']['size'];
		$fileTmpName = $_FILES['file']['tmp_name'];

		$targetDir = "../view/Gastos/" . $idGasto . "/";

		$baseName = basename($fileName);

		if (!file_exists($targetDir)) {
			// Crear la carpeta
			mkdir($targetDir, 0777, true); // Los permisos 0777 aseguran que la carpeta tenga todos los permisos
		}

		$targetFilePath = $targetDir . $baseName;
		$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
		if ($fileType == 'pdf') {
			$tipo = 'pdf';
		} else {
			$tipo = 'excel';
		}

		$uploadOk = 1;
		$i = 1;

		// Verificar si el archivo ya existe y renombrarlo si es necesario
		while (file_exists($targetFilePath)) {
			$baseName = pathinfo($fileName, PATHINFO_FILENAME) . "($i)." . $fileType;
			$targetFilePath = $targetDir . $baseName;
			$i++;
		}

		// Verificar el tamaño máximo del archivo (10MB)
		if ($fileSize > 10 * 1024 * 1024) {
			echo "error_tamano";
			$uploadOk = 0;
		}

		// Verificar los tipos de archivo permitidos (.xlsx, .xls, .pdf)
		$allowedExtensions = array("xlsx", "xls", "pdf");
		if (!in_array($fileType, $allowedExtensions)) {
			echo "error_tipo";
			$uploadOk = 0;
		}

		if ($uploadOk == 0) {
			echo "error";
		} else {
			// Mover el archivo cargado al directorio de destino
			if (move_uploaded_file($fileTmpName, $targetFilePath)) {
				$data = array(
					"Gastos_idGastos" => $idGasto,
					"tipo" => $tipo,
					"nameDocumento" => $baseName
				);
				$registrarDocumentosGastos = ControladorFormularios::ctrRegistrarDocumentosGastos($data);
				echo json_encode($data);
			} else {
				echo "error";
			}
		}
	} else {
		echo "error";
	}
}

if (isset($_POST['excelGastos'])) {
	$idGastos = $_POST['excelGastos'];

	$ExcelDocGasto = new FormulariosAjax();
	$ExcelDocGasto -> idGastos = $idGastos;
	$ExcelDocGasto -> excelGastoAjax();
}

if (isset($_POST['pdfGastos'])) {
	$idGastos = $_POST['pdfGastos'];

	$PDFDocGasto = new FormulariosAjax();
	$PDFDocGasto -> idGastos = $idGastos;
	$PDFDocGasto -> pdfGastoAjax();
}

if (isset($_POST['aceptarGasto'])) {
	$idGastos = $_POST['aceptarGasto'];

	$aceptarGasto = new FormulariosAjax();
	$aceptarGasto -> idGastos = $idGastos;
	$aceptarGasto -> aceptarGastoAjax();
}

if (isset($_POST['rechazarGasto'])) {
	$idGastos = $_POST['rechazarGasto'];

	$rechazarGasto = new FormulariosAjax();
	$rechazarGasto -> idGastos = $idGastos;
	$rechazarGasto -> rechazarGastoAjax();
}

if (isset($_POST['motivoFinalizar'])) {
	$idFolio_Gasto = $_POST['motivoFinalizar'];

	$finMotivo = new FormulariosAjax();
	$finMotivo -> idFolio_Gasto = $idFolio_Gasto;
	$finMotivo -> finalizarMotivoAjax();
}

if (isset($_POST['marcarPagado'])) {
	$idGastos = $_POST['marcarPagado'];

	$marcarPagado = new FormulariosAjax();
	$marcarPagado -> idGastos = $idGastos;
	$marcarPagado -> marcarPagadoAjax();
}

if (isset($_POST['currentPassword'])) {
	if ($_POST['currentPassword']== '') {
		echo "error: 1";
	}elseif ($_POST['passwordNew'] == '') {
		echo "error: 2";
	}elseif ($_POST['confirmPassword'] == '') {
		echo "error: 3";
	}else{
		$antiguoPassword = $_POST['currentPassword'];
		$passwordNew = $_POST['passwordNew'];
		$confirmPassword = $_POST['confirmPassword'];

		if ($passwordNew == $confirmPassword) {
			$cambioPassword = new FormulariosAjax();
			$cambioPassword -> antiguoPassword = $antiguoPassword;
			$cambioPassword -> passwordNew = $passwordNew;
			$cambioPassword -> cambioPasswordAjax2();
		}else{
			echo "error: contraseña";
		}
	}
}

if (isset($_FILES['file'])) {
	$file = $_FILES['file'];

	$actualizarFoto = new FormulariosAjax();
	$actualizarFoto -> file = $file;
	$actualizarFoto -> actualizarFotoAjax();
}

if (isset($_POST['nombrePerfil'])) {
	$nombre = $_POST['nombrePerfil'];
	$genero = $_POST['generoPerfil'];
	$apellidos = $_POST['apellidosPerfil'];
	$fecha_nacimiento = $_POST['fecha_nacimientoPerfil'];
	$calle = $_POST['callePerfil'];
	$num_exterior = $_POST['num_exteriorPerfil'];
	$num_interior = $_POST['num_interiorPerfil'];
	$colonia = $_POST['coloniaPerfil'];
	$cp = $_POST['cpPerfil'];
	$estado = $_POST['estadoPerfil'];
	$municipio = $_POST['municipioPerfil'];

	$actualizarDatos = new FormulariosAjax();
	$actualizarDatos -> nombre = $nombre;
	$actualizarDatos -> genero = $genero;
	$actualizarDatos -> apellidos = $apellidos;
	$actualizarDatos -> fecha_nacimiento = $fecha_nacimiento;
	$actualizarDatos -> calle = $calle;
	$actualizarDatos -> num_exterior = $num_exterior;
	$actualizarDatos -> num_interior = $num_interior;
	$actualizarDatos -> colonia = $colonia;
	$actualizarDatos -> cp = $cp;
	$actualizarDatos -> estado = $estado;
	$actualizarDatos -> municipio = $municipio;
	$actualizarDatos -> actualizarDatosAjax();
}

if (isset($_POST['tipo_contrato'])) {
	$idEmpleados = $_POST['empleadoContrato'];
	$tipo_contrato = $_POST['tipo_contrato'];
	$fecha_contrato = $_POST['fecha_contrato'];
	if (!isset($_POST['fin_contrato'])) {
		$fin_contrato = null;
	}else{
		$fin_contrato = $_POST['fin_contrato'];
	}

	$crearContrato = new FormulariosAjax();
	$crearContrato -> idEmpleados = $idEmpleados;
	$crearContrato -> tipo_contrato = $tipo_contrato;
	$crearContrato -> fecha_contrato = $fecha_contrato;
	$crearContrato -> fin_contrato = $fin_contrato;
	$crearContrato -> crearContratoAjax();
}

if (isset($_POST['tipo_credito'])) {
	$idEmpleados = $_POST['empleadoCredito'];
	$tipo_credito = $_POST['tipo_credito'];
	$numero_credito = $_POST['numero_credito'];
	$valor_descuento = $_POST['valor_descuento'];
	$inicio_credito = $_POST['inicio_credito'];

	$crearCreditorato = new FormulariosAjax();
	$crearCreditorato -> idEmpleados = $idEmpleados;
	$crearCreditorato -> tipo_credito = $tipo_credito;
	$crearCreditorato -> numero_credito = $numero_credito;
	$crearCreditorato -> valor_descuento = $valor_descuento;
	$crearCreditorato -> inicio_credito = $inicio_credito;
	$crearCreditorato -> crearCreditoAjax();
}

if (isset($_POST['delPermiso'])) {
	$idPermisos = $_POST['delPermiso'];

	$delPermiso = new FormulariosAjax();
	$delPermiso -> idPermisos = $idPermisos;
	$delPermiso -> delPermisoAjax();
}

if (isset($_POST['ramo_seguro']) && $_POST['ramo_seguro'] != "") {
	if (isset($_POST['tipo_riesgo'])) {
		$tipo_riesgo = $_POST['tipo_riesgo'];
	}else{
		$tipo_riesgo = null;
	}
	if (isset($_POST['secuela_consecuencia'])) {
		$secuela_consecuencia = $_POST['secuela_consecuencia'];
	}else{
		$secuela_consecuencia = null;
	}

	$ramo_seguro = $_POST['ramo_seguro'];
	$control_incapacidad = $_POST['control_incapacidad'];
	$fecha_inicio = $_POST['fecha_inicio'];
	$fecha_termino = $_POST['fecha_termino'];
	$folio = $_POST['folio'];
	$dias = $_POST['dias'];
	$porcentaje = $_POST['porcentaje'];

	$crearIncapacidad = new FormulariosAjax();
	$crearIncapacidad -> ramo_seguro = $ramo_seguro;
	$crearIncapacidad -> tipo_riesgo = $tipo_riesgo;
	$crearIncapacidad -> secuela_consecuencia = $secuela_consecuencia;
	$crearIncapacidad -> control_incapacidad = $control_incapacidad;
	$crearIncapacidad -> fecha_inicio = $fecha_inicio;
	$crearIncapacidad -> fecha_termino = $fecha_termino;
	$crearIncapacidad -> folio = $folio;
	$crearIncapacidad -> dias = $dias;
	$crearIncapacidad -> porcentaje = $porcentaje;
	$crearIncapacidad -> crearIncapacidadAjax();
}

if (isset($_POST['empleado-rol'])) {
	$idEmpleados = $_POST['empleado-rol'];
	$Ver_Empleados = (isset($_POST['Ver-Empleados'])) ? 1 : 0;
	$Editar_Empleados = (isset($_POST['Editar-Empleados'])) ? 1 : 0;
	$Del_Empleados = (isset($_POST['Del-Empleados'])) ? 1 : 0;
	$Ver_Departamentos = (isset($_POST['Ver-Departamentos'])) ? 1 : 0;
	$Editar_Departamentos = (isset($_POST['Editar-Departamentos'])) ? 1 : 0;
	$Del_Departamentos = (isset($_POST['Del-Departamentos'])) ? 1 : 0;
	$Ver_Evaluaciones = (isset($_POST['Ver-Evaluaciones'])) ? 1 : 0;
	$Editar_Evaluaciones = (isset($_POST['Editar-Evaluaciones'])) ? 1 : 0;
	$Del_Evaluaciones = (isset($_POST['Del-Evaluaciones'])) ? 1 : 0;
	$Resumenes_Asistencias = (isset($_POST['Resumenes-Asistencias'])) ? 1 : 0;
	$Ajustes_Asistencias = (isset($_POST['Ajustes-Asistencias'])) ? 1 : 0;
	$Ver_Tareas = (isset($_POST['Ver-Tareas'])) ? 1 : 0;
	$Editar_Tareas = (isset($_POST['Editar-Tareas'])) ? 1 : 0;
	$Del_Tareas = (isset($_POST['Del-Tareas'])) ? 1 : 0;
	$Asignar_EmpleadoMes = (isset($_POST['Asignar-EmpleadoMes'])) ? 1 : 0;
	$Ver_Analisis = (isset($_POST['Ver-Analisis'])) ? 1 : 0;
	$Ver_Reclutamiento = (isset($_POST['Ver-Reclutamiento'])) ? 1 : 0;
	$Editar_Reclutamiento = (isset($_POST['Editar-Reclutamiento'])) ? 1 : 0;
	$Del_Reclutamiento = (isset($_POST['Del-Reclutamiento'])) ? 1 : 0;
	$General_Reclutamiento = (isset($_POST['General-Reclutamiento'])) ? 1 : 0;
	$Ver_Organigramas = (isset($_POST['Ver-Organigramas'])) ? 1 : 0;
	$Agregar_Noticias = (isset($_POST['Agregar-Noticias'])) ? 1 : 0;
	$Editar_Noticias = (isset($_POST['Editar-Noticias'])) ? 1 : 0;
	$Del_Noticias = (isset($_POST['Del-Noticias'])) ? 1 : 0;
	$Ver_Empresas = (isset($_POST['Ver-Empresas'])) ? 1 : 0;
	$Editar_Empresas = (isset($_POST['Editar-Empresas'])) ? 1 : 0;
	$Configuracion_Divisas = (isset($_POST['Configuracion-Divisas'])) ? 1 : 0;
	$Configuracion_Categorias = (isset($_POST['Configuracion-Categorias'])) ? 1 : 0;
	$Configuracion_Permisos = (isset($_POST['Configuracion-Permisos'])) ? 1 : 0;

	$crearRoles = new FormulariosAjax();
	$crearRoles -> idEmpleados = $idEmpleados;
	$crearRoles -> Ver_Empleados = $Ver_Empleados;
	$crearRoles -> Editar_Empleados = $Editar_Empleados;
	$crearRoles -> Del_Empleados = $Del_Empleados;
	$crearRoles -> Ver_Departamentos = $Ver_Departamentos;
	$crearRoles -> Editar_Departamentos = $Editar_Departamentos;
	$crearRoles -> Del_Departamentos = $Del_Departamentos;
	$crearRoles -> Ver_Evaluaciones = $Ver_Evaluaciones;
	$crearRoles -> Editar_Evaluaciones = $Editar_Evaluaciones;
	$crearRoles -> Del_Evaluaciones = $Del_Evaluaciones;
	$crearRoles -> Resumenes_Asistencias = $Resumenes_Asistencias;
	$crearRoles -> Ajustes_Asistencias = $Ajustes_Asistencias;
	$crearRoles -> Ver_Tareas = $Ver_Tareas;
	$crearRoles -> Editar_Tareas = $Editar_Tareas;
	$crearRoles -> Del_Tareas = $Del_Tareas;
	$crearRoles -> Asignar_EmpleadoMes = $Asignar_EmpleadoMes;
	$crearRoles -> Ver_Analisis = $Ver_Analisis;
	$crearRoles -> Ver_Reclutamiento = $Ver_Reclutamiento;
	$crearRoles -> Editar_Reclutamiento = $Editar_Reclutamiento;
	$crearRoles -> Del_Reclutamiento = $Del_Reclutamiento;
	$crearRoles -> General_Reclutamiento = $General_Reclutamiento;
	$crearRoles -> Ver_Organigramas = $Ver_Organigramas;
	$crearRoles -> Agregar_Noticias = $Agregar_Noticias;
	$crearRoles -> Editar_Noticias = $Editar_Noticias;
	$crearRoles -> Del_Noticias = $Del_Noticias;
	$crearRoles -> Ver_Empresas = $Ver_Empresas;
	$crearRoles -> Editar_Empresas = $Editar_Empresas;
	$crearRoles -> Configuracion_Divisas = $Configuracion_Divisas;
	$crearRoles -> Configuracion_Categorias = $Configuracion_Categorias;
	$crearRoles -> Configuracion_Permisos = $Configuracion_Permisos;
	$crearRoles -> crearRolesAjax();
}