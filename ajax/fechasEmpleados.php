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
if ($fechas == []) {
    $fechas = array();
    $resultado = ControladorEmpleados::ctrVerEmpleadosHorariosDHorarios("h.default", 1);
// Recorremos los resultados de la consulta
    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
        $fechas[] = $fila['dia_Laborable'];
    }
}
// Devolvemos el resultado como texto JSON
header('Content-Type: application/json');
$fechasEmpleado = json_encode($fechas);
echo $fechasEmpleado;
?>
