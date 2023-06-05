<?php
session_start();
require_once "../controller/formularios.controlador.php";
require_once "../model/formularios.modelo.php";

require_once "../model/modelo.empleados.php";
require_once "../controller/controlador.empleados.php";

$resultado = ControladorEmpleados::ctrVerEmpleadosHorariosDHorarios("idEmpleados", $_SESSION['idEmpleado']);
$fechas = array();
// Recorremos los resultados de la consulta
while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $fechas[] = $fila['dia_Laborable'];
}

// Completar los días no laborables (agregar los domingos)
$fechasCompletas = array();
for ($i = 1; $i <= 7; $i++) {
    if (!in_array($i, $fechas)) {
        if ($i != 7) {
            $fechasCompletas[] = $i;
        } else {
            $fechasCompletas[] = 0;
        }
    }
}

if ($fechasCompletas === [1, 2, 3, 4, 5, 6, 0]) {
    $resultado = ControladorEmpleados::ctrVerEmpleadosHorariosDHorarios("h.default", '1');

    $fechas = array();
    // Recorremos los resultados de la consulta
    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
        $fechas[] = $fila['dia_Laborable'];
    }

    // Completar los días no laborables (agregar los domingos)
    $fechasCompletas = array();
    for ($i = 1; $i <= 7; $i++) {
        if (!in_array($i, $fechas)) {
            if ($i != 7) {
                $fechasCompletas[] = $i;
            } else {
                $fechasCompletas[] = 0;
            }
        }
    }
}
    // Devolvemos el resultado como texto JSON
    header('Content-Type: application/json');
    $fechasEmpleado = json_encode($fechasCompletas);
    echo $fechasEmpleado;
?>
