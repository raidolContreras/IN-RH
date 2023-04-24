<?php

class ControladorFormularios{
	
/*---------- Función hecha para registrar a los empleados---------- */

	static public function ctrRegistrarEmpleados(){
		if (isset($_POST['nombre'])) {

			$datos = array('nombre' => $_POST['nombre'],
					'apellidos' => $_POST['apellidos'],
					'genero' => $_POST['genero'],
					'fecha_nacimiento' => $_POST['fecha_nacimiento'],
					'num_identificacion' => $_POST['num_identificacion'],
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
					'parentesco' => $_POST['parentesco']);
			$Registro = ModeloFormularios::mdlRegistrarEmpleados('empleados','emergencia', $datos);
			if ($Registro == 'ok') {
				return 'ok';
			}else{
				return 'error';
			}
		}
		
	}

	static public function ctrRegistrarHistorial($idEmpleado){
		if (isset($_POST['empresa']) && isset($_POST['puesto'])) {
			if ($_POST['empresa'] != '' && $_POST['puesto'] != '') {
				if (isset($_POST['noResponder'])) {
					$noResponder = 1;
					$salario = null;
				}else{
					$noResponder = 0;
				}
				if (isset($_POST['trabajo_actual'])) {
					$trabajo_actual = 1;
				}else{
					$trabajo_actual = 0;
				}
				$tabla = 'historial_laboral';
				$datos = array('empresa' => $_POST['empresa'],
							   'puesto' => $_POST['puesto'],
							   'noResponder' => $noResponder,
							   'salario' => $salario,
							   'fecha_inicio' => $_POST['fecha_inicio'],
							   'trabajo_actual' => $trabajo_actual,
							   'fecha_fin' => $_POST['fecha_fin'],
							   'motivos' => $_POST['motivos'],
							   'logros' => $_POST['logros'],
							   'accion' => $_POST['accion']);

				$Registro = ModeloFormularios::mdlRegistrarHistorial($tabla, $datos, $idEmpleado);

				if ($Registro == 'otro') {
					return 'otro';
				}elseif ($Registro == 'terminar') {
					return 'terminar';
				}else{
					return 'error';
				}

			}
		}
	}

/*---------- Función hecha para ver a los empleados---------- */
	static public function ctrVerEmpleados($item, $valor){

		$tabla = "empleados";

		$respuesta = ModeloFormularios::mdlVerEmpleados($tabla, $item, $valor);

		return $respuesta;

	}

/*---------- Esta función envia los datos para crear el formato del numero teléfonico ---------- */
	static public function ctrNumeroTelefonico($phone){
		$numero = ModeloFormularios::mdlNumeroTelefonico($phone);
		return $numero;
	}

/*---------- Esta función envia los datos para crear el formato del numero teléfonico ---------- */
	static public function ctrSeleccionarHisrory($idEmpleado){
		$tabla = 'historial_laboral';
		$history = ModeloFormularios::mdlSeleccionarHisrory($tabla, $idEmpleado);
		return $history;
	}

	static public function ctrFecha($fecha){
		setlocale(LC_TIME, 'es_ES');
		$originalDate = $fecha;
		$newDate = strftime("%b' %y", strtotime($originalDate));
		return $newDate;
	}

/*---------- Fin de ControladorFormularios ---------- */
}