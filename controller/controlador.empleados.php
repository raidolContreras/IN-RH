<?php 

class ControladorEmpleados{
	/*---------- Función hecha para registrar a los empleados---------- */

	static public function ctrRegistrarEmpleados(){
		if (isset($_POST['nombre'])) {

			$namePuesto = $_POST['namePuesto'];
			$salarioPuesto = $_POST['salarioPuesto'];
			$salario_integrado = $_POST['salario_integrado'];
			$horario_entrada = $_POST['horario_entrada'];
			$horario_salida = $_POST['horario_salida'];

			if ($_POST['postulante'] == 0) {
				$departamento = $_POST['departamento'];
			}else{
				$departamento = 0;
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
				'horario_entrada' => $horario_entrada,
				'horario_salida' => $horario_salida,
				'Departamentos_idDepartamentos' => $departamento,
				'postulante' => $_POST['postulante']);
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


	static public function ctrEliminarEmpleado(){
		if (isset($_POST['Editar'])) {
			$tabla = 'empleados';
			$eliminar = ModeloFormularios::mdlEliminarEmpleado($tabla, $_POST['Editar']);
			if ($eliminar == 'ok') {
				return 'ok';
			}else{
				return 'error';
			}
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
			$horario_entrada = $_POST['horario_entrada'];
			$horario_salida = $_POST['horario_salida'];
			$departamento = $_POST['departamento'];
			$empleado = $_POST['empleado'];

			$datosPuesto = array(
				"namePuesto" => $namePuesto,
				"salarioPuesto" => $salarioPuesto,
				"salario_integrado" => $salario_integrado,
				"horario_entrada" => $horario_entrada,
				"horario_salida" => $horario_salida,
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
				'idEmpleados' => $empleado
			);

			$datosEmergencia = array(
				"emergencia" => $_POST['emergencia'],
				"telefonoE" => $_POST['telefonoE'],
				"parentesco" => $_POST['parentesco'],
				"idEmpleados" => $empleado
			);

			$updateDataEmpleado = ModeloEmpleados::mdlActualizarEmpleado('empleados', $datosEmpleado);
			if ($updateDataEmpleado == 'ok') {
				$updateDataEmergencia = ModeloEmpleados::mdlActualizarEmergencia('emergencia', $datosEmergencia);
				if ($updateDataEmergencia == 'ok') {
					$updateDataPuesto = ModeloEmpleados::mdlActualizarPuesto('puesto', $datosPuesto);
					if ($updateDataPuesto == 'ok') {
						return 'ok';
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

	static public function ctrCambioPassword($tabla,$data){
		$cambioPassword = ModeloEmpleados::mdlCambioPassword($tabla,$data);
		return $cambioPassword;
	}
	
}