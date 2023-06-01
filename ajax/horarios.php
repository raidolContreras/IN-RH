<?php

require_once "../controller/formularios.controlador.php";
require_once "../model/formularios.modelo.php";

require_once "../model/modelo.empleados.php";
require_once "../controller/controlador.empleados.php";

class HorariosAjax {
	public function funcionesHorarios() {
		if (isset($_POST['nameHorario'])) {
			$nameHorario = $_POST['nameHorario'];

			// Obtener los datos de horarios y horas esperadas
			$horarios = array();

			// Verificar si el campo 'dia' es un arreglo
			if (is_array($_POST['dia'])) {
				foreach ($_POST['dia'] as $dia) {
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

		if (isset($_POST['actualizarNameHorario'])) {
			$nameHorario = $_POST['actualizarNameHorario'];
			$idHorarios = $_POST['plantilla'];
			// Obtener los datos de horarios y horas esperadas
			$horarios = array();

			// Verificar si el campo 'dia' es un arreglo
			if (is_array($_POST['dia'])) {
				foreach ($_POST['dia'] as $dia) {
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

			// Llamar a la función del controlador para guardar el horario
			$respuesta = ControladorFormularios::ctrActualizarHorario($datos);
			echo json_encode($respuesta);
		}
		if (isset($_POST['horario'])) {
			$idHorario = $_POST['horario'];
			$tabla = "empleados_has_horarios";
			$borrarEmpleados = ModeloFormularios::mdlBorrarEmpleadosHorarios($tabla, $idHorario);
			
			if (empty($_POST['empleados_has_horarios'])) {
				echo json_encode($borrarEmpleados);
			}else {
				if ($borrarEmpleados == 'eliminado') {
					$empleados = $_POST['empleados_has_horarios'];
					$empleados_has_horarios = ControladorFormularios::ctrEmpleadosHasHorarios($empleados, $idHorario);
					echo json_encode($empleados_has_horarios);
				}else {
					echo json_encode($borrarEmpleados);
				}
			}
		}
	}
}

// Crear una instancia del objeto HorariosAjax
$horariosAjax = new HorariosAjax();

// Llamar al método guardarHorarioAjax()
$horariosAjax->funcionesHorarios();