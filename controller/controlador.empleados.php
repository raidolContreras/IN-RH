<?php 

class ControladorEmpleados{
	/*---------- Función hecha para registrar a los empleados---------- */

	static public function ctrRegistrarEmpleados(){
		if (isset($_POST['nombre'])) {

			if (isset($_POST['contrato'])) {
				$contrato = true;
			}else{
				$contrato = false;
			}

			if (isset($_POST['cuenta_infonavit'])) {
				$cuenta_infonavit = true;
			}else{
				$cuenta_infonavit = false;
			}

			$jefe = 0;
			$departamento = 0;
			$namePuesto = $_POST['namePuesto'];
			$salarioPuesto = $_POST['salarioPuesto'];
			$salario_integrado = $_POST['salario_integrado'];

			if ($_POST['postulante'] == 0) {
				$departamento = $_POST['departamento'];
			}
			if (isset($_POST['asignarJefatura'])) {
				$jefe = 1;
			}

		$password = generarPassword();

		$encriptarPassword = crypt($password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			$datos = array('nombre' => $_POST['nombre'],
				'apellidos' => $_POST['apellidos'],
				'genero' => $_POST['genero'],
				'fecha_nacimiento' => $_POST['fecha_nacimiento'],
				'num_identificacion' => strtoupper($_POST['num_identificacion']),
				'curp' => $_POST['curp'],
				'num_seguro_social' => $_POST['num_seguro_social'],
				'rfc' => $_POST['rfc'],
				'calle' => $_POST['calle'],
				'num_exterior' => $_POST['num_exterior'],
				'num_interior' => $_POST['num_interior'],
				'colonia' => $_POST['colonia'],
				'cp' => $_POST['cp'],
				'municipio' => $_POST['municipio'],
				'estado' => $_POST['estado'],
				'telefono' => $_POST['telefono'],
				'email' => $_POST['email'],
				'password' => $password,
				'passwordEncriptado' => $encriptarPassword,
				'emergencia' => $_POST['emergencia'],
				'telefonoE' => $_POST['telefonoE'],
				'parentesco' => $_POST['parentesco'],
				'namePuesto' => $namePuesto,
				'salarioPuesto' => $salarioPuesto,
				'salario_integrado' => $salario_integrado,
				'Departamentos_idDepartamentos' => $departamento,
				'postulante' => $_POST['postulante'],
				'jefe_Departamento' => $jefe,
				'horario' => $_POST['horarios'],
				'fecha_contratado' => $_POST['fecha_contratado'],
				'contrato' => $_POST['contrato'],
				'tipo_contrato' => $_POST['tipo_contrato'],
				'fecha_contrato' => $_POST['fecha_contrato'],
				'fin_contrato' => $_POST['fin_contrato'],
				'cuenta_infonavit' => $cuenta_infonavit,
				'tipo_credito' => $_POST['tipo_credito'],
				'numero_credito' => $_POST['numero_credito'],
				'valor_descuento' => $_POST['valor_descuento'],
				'inicio_credito' => $_POST['inicio_credito']);
			$Registro = ModeloFormularios::mdlRegistrarEmpleados('empleados','emergencia', $datos);
			if ($Registro == 'ok') {
				return 'ok';
			}else{
				return 'error';
			}
		}

	}
	/*---------- Función hecha para ver a los empleados---------- */
	static public function ctrVerEmpleados($item, $valor){

		$tabla = "empleados";

		$respuesta = ModeloFormularios::mdlVerEmpleados($tabla, $item, $valor);

		return $respuesta;

	}
	/*---------- Función hecha para ver a los creditos---------- */
	static public function ctrVerCredito($idEmpleados){

		$respuesta = ModeloFormularios::mdlVerCredito($idEmpleados);

		return $respuesta;

	}
	/*---------- Función hecha para ver a los contraros---------- */
	static public function ctrVerContrato($idEmpleados){

		$respuesta = ModeloFormularios::mdlVerContrato($idEmpleados);

		return $respuesta;

	}


	static public function ctrEliminarEmpleado($datos){
		$busqueda = ControladorEmpleados::ctrVerEmpleados("idEmpleados",$datos['idEmpleados']);

		if (isset($busqueda[0])) {
			$tabla = 'empleados';
			$eliminar = ModeloEmpleados::mdlEliminarEmpleado($tabla, $datos);
			return $eliminar;
		}else{
			return "Error: usuario";
		}
	}


	/*---------- Función hecha para ver a los empleados---------- */
	static public function ctrVerEmpleadosDisponibles($item){

		$tabla = "empleados";

		$respuesta = ModeloFormularios::mdlVerEmpleadosDisponibles($tabla,$item);

		return $respuesta;

	}

	static public function ctrActualizarEmpleado(){
		if (isset($_POST['btn-update'])) {
			//Datos Puesto
			$namePuesto = $_POST['namePuesto'];
			$salarioPuesto = $_POST['salarioPuesto'];
			$salario_integrado = $_POST['salario_integrado'];
			$departamento = $_POST['departamento'];
			$empleado = $_POST['empleado'];

			$datosPuesto = array(
				"namePuesto" => $namePuesto,
				"salarioPuesto" => $salarioPuesto,
				"salario_integrado" => $salario_integrado,
				"Departamentos_idDepartamentos" => $departamento,
				"Empleados_idEmpleados" => $empleado
			);

			//Datos Empleado
			$datosEmpleado = array(
				'nombre' => $_POST['nombre'],
				'apellidos' => $_POST['apellidos'],
				'genero' => $_POST['genero'],
				'fecha_nacimiento' => $_POST['fecha_nacimiento'],
				'num_identificacion' => strtoupper($_POST['num_identificacion']),
				'curp' => $_POST['curp'],
				'num_seguro_social' => $_POST['num_seguro_social'],
				'rfc' => $_POST['rfc'],
				'calle' => $_POST['calle'],
				'num_exterior' => $_POST['num_exterior'],
				'num_interior' => $_POST['num_interior'],
				'colonia' => $_POST['colonia'],
				'cp' => $_POST['cp'],
				'municipio' => $_POST['municipio'],
				'estado' => $_POST['estado'],
				'telefono' => $_POST['telefono'],
				'email' => $_POST['email'],
				'emergencia' => $_POST['emergencia'],
				'telefonoE' => $_POST['telefonoE'],
				'parentesco' => $_POST['parentesco'],
				'fecha_contratado' => $_POST['fecha_contratado'],
				'idEmpleados' => $empleado
			);

			$datosEmergencia = array(
				"emergencia" => $_POST['emergencia'],
				"telefonoE" => $_POST['telefonoE'],
				"parentesco" => $_POST['parentesco'],
				"idEmpleados" => $empleado
			);

			$datosDepto = array(
				"idDepartamentos" => $departamento,
				"idEmpleados" => $empleado
			);

			$updateDataEmpleado = ModeloEmpleados::mdlActualizarEmpleado('empleados', $datosEmpleado);
			if ($updateDataEmpleado == 'ok') {
				$updateDataEmergencia = ModeloEmpleados::mdlActualizarEmergencia('emergencia', $datosEmergencia);
				if ($updateDataEmergencia == 'ok') {
					$updateDataPuesto = ModeloEmpleados::mdlActualizarPuesto('puesto', $datosPuesto);
					if ($updateDataPuesto == 'ok') {
						if (isset($_POST['asignarJefatura'])) {
							$updateDataDepto = ModeloEmpleados::mdlActualizarjefatura('departamentos', $datosDepto);
							if ($updateDataDepto == 'ok') {
								return 'ok';
							}
						}else{
							return 'ok';
						}
					} else {
						return 'error: 3';
					}
				} else {
					return 'error: 2';
				}
			} else {
				return 'error: 1';
			}
		}
	}

	static public function ctrFechaNacimiento(){
		$tabla = 'empleados';
		$fechaNacimiento = ModeloEmpleados::mdlFechaNacimiento($tabla);
		return $fechaNacimiento;
	}

	static public function ctrFechaAniversario(){
		$tabla = 'empleados';
		$fechaNacimiento = ModeloEmpleados::mdlFechaAniversario($tabla);
		return $fechaNacimiento;
	}

	static public function ctrCambioPassword($tabla,$data){
		$cambioPassword = ModeloEmpleados::mdlCambioPassword($tabla,$data);
		return $cambioPassword;
	}

	static public function ctrVerEmpleadosDeptos($departamento){
		$EmpleadoDepartamento = ModeloEmpleados::mdlVerEmpleadosDeptos($departamento);
		return $EmpleadoDepartamento;
	}

	static public function ctrCambioPasswordOlvidado($item,$valor){
		$tabla = "solicitud_cambio_password";
		$cambiar_password = ModeloEmpleados::mdlCambioPasswordOlvidado($tabla,$item,$valor);
		return $cambiar_password;
	}

	static public function ctrBorrarSolicitud($idSolicitudPassword){
		$tabla = "solicitud_cambio_password";
		$borrarSolicitud = ModeloEmpleados::mdlBorrarSolicitud($tabla,$idSolicitudPassword);
		return $borrarSolicitud;
	}

	static public function ctrVerEmpleadosHorariosDHorarios($item, $valor){
		$tabla = "empleados";
		$VerEmpleadosHorariosDHorarios = ModeloEmpleados::mdlVerEmpleadosHorariosDHorarios($tabla, $item, $valor);
		return $VerEmpleadosHorariosDHorarios;
	}

	static public function ctrEquipoDeTrabajo($pertenece){
		$puesto = ControladorFormularios::ctrVerPuestos("Empleados_idEmpleados", $_SESSION['idEmpleado']);

		$tabla = "empleados";
		$EquipoDeTrabajo = ModeloEmpleados::mdlEquipoDeTrabajo($tabla, $puesto['Departamentos_idDepartamentos'],$pertenece);
		return $EquipoDeTrabajo;
	}

	static public function ctrAsistenciasJustificantes($idEmpleados){
		$tabla = "asistencias";
		$buscarAsistenciasJustificantes = ModeloEmpleados::mdlAsustenciasJustificantes($tabla, "a.Empleados_idEmpleados", $idEmpleados);
		return $buscarAsistenciasJustificantes;
	}

	static public function ctrDiasFestivos(){
		$tabla = "festivos";
		$DiasFestivos = ModeloEmpleados::mdlDiasFestivos($tabla);
		return $DiasFestivos;
	}

	static public function obtenerCuotaFijaYPorcentaje($quincena) {
		// Obtener el contenido del archivo JSON
		$archivoJSON = 'view/pages/json/ISR.json';
		$jsonData = file_get_contents($archivoJSON);

		// Decodificar el JSON en un array asociativo
		$tablaISR = json_decode($jsonData, true);

		// Valores por defecto
		$LimiteInferior = 0;
		$cuotaFija = 0;
		$porcentaje = 0;

		// Buscar en qué rango se encuentra $quincena
		foreach ($tablaISR as $rango) {
			if ($quincena >= $rango['LimiteInferior'] && $quincena <= $rango['LimiteSuperior']) {
				$LimiteInferior = $rango['LimiteInferior'];
				$cuotaFija = $rango['CuotaFija'];
				$porcentaje = $rango['Porcentaje'];
				break; // Salir del bucle una vez que se encuentra el rango adecuado
			}
		}

		// Devolver los valores en un arreglo
		return ['LimiteInferior' => $LimiteInferior,'cuotaFija' => $cuotaFija, 'porcentaje' => $porcentaje];
	}

	static public function obtenerSubsidios($quincena) {
		// Obtener el contenido del archivo JSON
		$archivoJSON = 'view/pages/json/Subsidio.json';
		$jsonData = file_get_contents($archivoJSON);

		// Decodificar el JSON en un array asociativo
		$tablaISR = json_decode($jsonData, true);

		// Valores por defecto
		$LimiteInferior = 0;
		$cuotaFija = 0;

		// Buscar en qué rango se encuentra $quincena
		foreach ($tablaISR as $rango) {
			if ($quincena >= $rango['LimiteInferior'] && $quincena <= $rango['LimiteSuperior']) {
				$LimiteInferior = $rango['LimiteInferior'];
				$cuotaFija = $rango['CuotaFija'] / 30.4 * 15;
				break; // Salir del bucle una vez que se encuentra el rango adecuado
			}
		}

		// Devolver los valores en un arreglo
		return ['LimiteInferior' => $LimiteInferior,'cuotaFija' => $cuotaFija];
	}

	static public function calcularISR($quincena) {
		// Obtener cuota fija, porcentaje y límite inferior
		$valoresISR = ControladorEmpleados::obtenerCuotaFijaYPorcentaje($quincena);
		$LimiteInferior = $valoresISR['LimiteInferior'];
		$cuotaFija = $valoresISR['cuotaFija'];
		$porcentaje = $valoresISR['porcentaje'];

		// Calcular excedente sobre el límite inferior
		$excedente = $quincena - $LimiteInferior;

		// Calcular impuesto marginal
		$impuestoMarginal = $excedente * ($porcentaje / 100);

		// Calcular ISR Causado
		$ISRcausado = $impuestoMarginal + $cuotaFija;

		return $ISRcausado;
	}

	static public function calcularRetencionIMSS($salarioBaseCotizacion, $diasCotizados, $porcentajeRetencionIMSS) {
	    // Calcula la retención inicial IMSS
	    $retencionInicialIMSS = $salarioBaseCotizacion * ($porcentajeRetencionIMSS / 100);

	    // Verifica si el salario base de cotización es mayor que 3 SMDF
	    $salarioMinimoDF = 103.74; // Valor del salario mínimo del DF
	    $topeTresSalariosMinimos = $salarioMinimoDF * 3;
	    $excesoSalarial = max(0, $salarioBaseCotizacion - $topeTresSalariosMinimos);

	    // Si el salario base de cotización es mayor que 3 SMDF, calcula la retención adicional
	    if ($excesoSalarial > 0) {
	        $porcentajeRetencionExceso = 0.40; // Porcentaje de retención sobre el exceso
	        $retencionExceso = $excesoSalarial * ($porcentajeRetencionExceso / 100);
	        $totalRetencionIMSS = $retencionInicialIMSS + $retencionExceso;
	    } else {
	        $totalRetencionIMSS = $retencionInicialIMSS;
	    }

	    return $totalRetencionIMSS;
	}
	
}