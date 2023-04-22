<?php

class ControladorFormularios{
	
/*---------- Función Hecha para registrar a los empleados---------- */

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

/*---------- Fin de ControladorFormularios ---------- */
}