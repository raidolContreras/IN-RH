<?php
session_start();
require_once "../model/conexion.php";

$datos = array();

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

if (empty($resultado)) {
    $sql2 = "SELECT dh.dia_Laborable, dh.hora_Entrada, dh.hora_Salida, dh.numero_Horas
        FROM empleados e
        RIGHT JOIN empleados_has_horarios eh ON e.idEmpleados = eh.Empleados_idEmpleados
        RIGHT JOIN horarios h ON eh.Horarios_idHorarios = h.idHorarios
        RIGHT JOIN dia_horario dh ON h.idHorarios = dh.Horarios_idHorarios
        WHERE h.default = 1;";
    $stmt_dias_laborables = $conexion->prepare($sql2);
    $stmt_dias_laborables->execute();
}

$sql_asistencias = "SELECT * FROM asistencias WHERE Empleados_idEmpleados = ".$_SESSION['idEmpleado'].";";

$stmt_asistencias = $conexion->prepare($sql_asistencias);
$stmt_asistencias->execute();

foreach ($stmt_asistencias->fetchAll() as $asistencias) {
    $datos[] = array(
        "dia" => $asistencias['fecha_asistencia'],
        "color" => "#ACE799"
    );
}

// Convertimos el array de fechas a formato JSON
$json_fechas = json_encode($datos);

// Devolvemos el resultado como texto JSON
header('Content-Type: application/json');
echo $json_fechas;

// Cerramos la conexión a la base de datos
$conexion = null;