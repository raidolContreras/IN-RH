<?php
session_start();
require_once "../model/conexion.php";

$diaLaborableNombres = [
    1 => "Monday",
    2 => "Tuesday",
    3 => "Wednesday",
    4 => "Thursday",
    5 => "Friday",
    6 => "Saturday",
    0 => "Sunday"
];

$datos = array();
$fechas = array();
// Conectamos a la base de datos
$conexion = Conexion::conectar();

// Realizamos la consulta de fechas
$sql = "SELECT dh.dia_Laborable, dh.hora_Entrada, dh.hora_Salida, dh.numero_Horas
        FROM empleados e
        RIGHT JOIN empleados_has_horarios eh ON e.idEmpleados = eh.Empleados_idEmpleados
        RIGHT JOIN horarios h ON eh.Horarios_idHorarios = h.idHorarios
        RIGHT JOIN dia_horario dh ON h.idHorarios = dh.Horarios_idHorarios
        WHERE e.idEmpleados = ".$_SESSION['idEmpleado'].";";

$stmt_dias_laborables = $conexion->prepare($sql);
$stmt_dias_laborables->execute();
while ($fila = $stmt_dias_laborables->fetch(PDO::FETCH_ASSOC)) {
    $fechas[] = array(
        "dia_Laborable" => $diaLaborableNombres[$fila['dia_Laborable']],
        "hora_Entrada" => $fila['hora_Entrada'],
        "hora_Salida" => $fila['hora_Salida'],
        "numero_Horas" => $fila['numero_Horas']
    );
}

if ($fechas == []) {
    $fechas = array();
    $sql2 = "SELECT dh.dia_Laborable, dh.hora_Entrada, dh.hora_Salida, dh.numero_Horas
        FROM empleados_has_horarios eh
        RIGHT JOIN horarios h ON eh.Horarios_idHorarios = h.idHorarios
        RIGHT JOIN dia_horario dh ON h.idHorarios = dh.Horarios_idHorarios
        WHERE h.default = 1;";
    $stmt_dias_laborables = $conexion->prepare($sql2);
    $stmt_dias_laborables->execute();
    while ($fila = $stmt_dias_laborables->fetch(PDO::FETCH_ASSOC)) {
        $fechas[] = array(
            "dia_Laborable" => $diaLaborableNombres[$fila['dia_Laborable']],
            "hora_Entrada" => $fila['hora_Entrada'],
            "hora_Salida" => $fila['hora_Salida'],
            "numero_Horas" => $fila['numero_Horas']
        );
    }
}

$sql3 = "SELECT fecha_contratado from empleados WHERE idEmpleados = ".$_SESSION['idEmpleado'].";";
$fecha_contratado = $conexion->prepare($sql3);
$fecha_contratado->execute();


$sql_asistencias = "SELECT * FROM asistencias WHERE Empleados_idEmpleados = ".$_SESSION['idEmpleado'].";";
$stmt_asistencias = $conexion->prepare($sql_asistencias);
$stmt_asistencias->execute();


foreach ($stmt_asistencias->fetchAll() as $asistencias) {
    $fecha = $asistencias['fecha_asistencia'];
    $timestamp = strtotime($fecha);
    $dia_semana = date('l', $timestamp);

    foreach ($fechas as $fecha) {

        if ($fecha['dia_Laborable'] == $dia_semana) {

            if ($asistencias['entrada'] <= $fecha['hora_Entrada'] && $asistencias['entrada'] != "00:00:00") {
                $color = "#ACE799";
            } elseif($asistencias['entrada'] == "00:00:00") {
                $color = "#EF8B8B";
            } else {
                $color = "#E7E199";
            }

            $datos[] = array(
                "title" => $asistencias['entrada']." - ". $asistencias['salida'],
                "start" => $asistencias['fecha_asistencia'],
                "end" => Null,
                "diaL" => $dia_semana,
                "hora_entrada_marcada" => $asistencias['entrada'],
                "hora_entrada" => $fecha['hora_Entrada'],
                "color" => $color,
                "textColor" => "#000"
            );
            break;
        }
    }
}

$empleado = array(
    "fecha_contratado" => $fecha_contratado->fetch(),
    "datos" => $datos
);

$json_fechas = json_encode($empleado);

header('Content-Type: application/json');
echo $json_fechas;

$conexion = null;
