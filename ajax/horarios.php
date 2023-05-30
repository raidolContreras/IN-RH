<?php

require_once "../controller/formularios.controlador.php";
require_once "../model/formularios.modelo.php";

require_once "../model/modelo.empleados.php";
require_once "../controller/controlador.empleados.php";

class HorariosAjax {
    public function guardarHorarioAjax() {
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
    }
}

// Crear una instancia del objeto HorariosAjax
$horariosAjax = new HorariosAjax();

// Llamar al método guardarHorarioAjax()
$horariosAjax->guardarHorarioAjax();