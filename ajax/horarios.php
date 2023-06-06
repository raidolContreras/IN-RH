<?php

// Se incluyen los archivos necesarios
require_once "../controller/formularios.controlador.php";
require_once "../model/formularios.modelo.php";
require_once "../model/modelo.empleados.php";
require_once "../controller/controlador.empleados.php";

// Se define la clase HorariosAjax
class HorariosAjax {
	public function funcionesHorarios() {
		// Verificar si se ha enviado el formulario para guardar un horario
		if (isset($_POST['nameHorario'])) {
			$nameHorario = $_POST['nameHorario'];

			// Obtener los datos de horarios y horas esperadas
			$horarios = array();

			// Verificar si el campo 'dia' es un arreglo
			if (is_array($_POST['dia'])) {
				foreach ($_POST['dia'] as $dia) {
					// Se guardan los datos de entrada y salida para cada día
					$horarios[$dia] = array(
						'entrada' => $_POST['horarios']["Entrada" . $dia],
						'salida' => $_POST['horarios']["Salida" . $dia]
					);
				}
			}

			// Llamar a la función del controlador para guardar el horario
			$respuesta = ControladorFormularios::ctrGuardarHorario($nameHorario, $horarios);
			echo json_encode($respuesta);
		}

		// Verificar si se ha enviado el formulario para actualizar un horario
		if (isset($_POST['actualizarNameHorario'])) {
			$nameHorario = $_POST['actualizarNameHorario'];
			$idHorarios = $_POST['plantilla'];

			// Obtener los datos de horarios y horas esperadas
			$horarios = array();

			// Verificar si el campo 'dia' es un arreglo
			if (is_array($_POST['dia'])) {
				foreach ($_POST['dia'] as $dia) {
					// Se guardan los datos de entrada y salida para cada día
					$horarios[$dia] = array(
						'entrada' => $_POST['horarios']["Entrada" . $dia],
						'salida' => $_POST['horarios']["Salida" . $dia]
					);
				}
			}

			$datos = array(
				"nameHorario" => $nameHorario,
				"horarios" => $horarios,
				"idHorarios" => $idHorarios
			);

			// Llamar a la función del controlador para actualizar el horario
			$respuesta = ControladorFormularios::ctrActualizarHorario($datos);
			echo json_encode($respuesta);
		}

		// Verificar si se ha enviado el formulario para borrar un horario
		if (isset($_POST['horario'])) {
			$idHorario = $_POST['horario'];
			$tabla = "empleados_has_horarios";

			// Borrar los empleados asociados al horario
			$borrarEmpleados = ModeloFormularios::mdlBorrarEmpleadosHorarios($tabla, $idHorario);

			if (empty($_POST['empleados_has_horarios'])) {
				echo json_encode($borrarEmpleados);
			} else {
				if ($borrarEmpleados == 'eliminado') {
					$empleados = $_POST['empleados_has_horarios'];
					

					// Asociar los empleados al horario
					$empleados_has_horarios = ControladorFormularios::ctrEmpleadosHasHorarios($empleados, $idHorario);
					echo json_encode($empleados_has_horarios);
				} else {
					echo json_encode($borrarEmpleados);
				}
			}
		}

		// Verificar si se ha enviado el formulario para registrar un día festivo
		if (isset($_POST['nameFestivo'])) {
			$fechaFin = NULL;
			if ($_POST['fechaFin'] != null) {
				$fechaFin = $_POST['fechaFin'];
			}

			$datos = array(
				"nameFestivo" => $_POST['nameFestivo'],
				"fechaFestivo" => $_POST['fechaFestivo'],
				"fechaFin" => $fechaFin
			);

			// Registrar el día festivo
			$registrar_dia = ControladorFormularios::ctrRegistrarDiaFestivo($datos);
			echo json_encode($registrar_dia);
		}

		// Verificar si se ha enviado el formulario para registrar un permiso
		if (isset($_POST['namePermiso'])) {
			$datos = array(
				"namePermisos" => $_POST['namePermiso'],
				"colorPermisos" => $_POST['colorPermiso']
			);

			// Registrar el permiso
			$registrar_Permiso = ControladorFormularios::ctrRegistrarPermisos($datos);
			echo json_encode($registrar_Permiso);
		}
	}
}

// Crear una instancia del objeto HorariosAjax
$horariosAjax = new HorariosAjax();

// Llamar al método funcionesHorarios()
$horariosAjax->funcionesHorarios();
