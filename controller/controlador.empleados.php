<?php 

class ControladorEmpleados{
	/*---------- Función hecha para registrar a los empleados---------- */

	static public function ctrRegistrarEmpleados(){
		if (isset($_POST['nombre'])) {

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
				'horario' => $_POST['horarios']);
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

	static public function ctrAsistenciasJustificantes(){
		$tabla = "asistencias";
		$buscarAsistenciasJustificantes = ModeloEmpleados::mdlAsustenciasJustificantes($tabla, "a.Empleados_idEmpleados", $_SESSION['idEmpleado']);
		return $buscarAsistenciasJustificantes;
	}
	
}