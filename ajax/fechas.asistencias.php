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


$sql_asistencias = "SELECT * FROM asistencias a LEFT JOIN justificantes j ON j.Asistencias_idAsistencias=a.idAsistencias WHERE a.Empleados_idEmpleados = ".$_SESSION['idEmpleado'].";";
$stmt_asistencias = $conexion->prepare($sql_asistencias);
$stmt_asistencias->execute();


foreach ($stmt_asistencias->fetchAll() as $asistencias) {
	$fecha = $asistencias['fecha_asistencia'];
	$timestamp = strtotime($fecha);
	$dia_semana = date('l', $timestamp);
	$comentario_justificante = $asistencias['Comentario'];
	$status_justificante = $asistencias['status_justificante'];

	foreach ($fechas as $fecha) {

		if ($fecha['dia_Laborable'] == $dia_semana) {

			if ($comentario_justificante == null) {
				if ($asistencias['entrada'] <= $fecha['hora_Entrada'] && $asistencias['entrada'] != "00:00:00") {

					if ($asistencias['salida'] >= $fecha['hora_Salida'] && $asistencias['salida'] != "00:00:00") {
						$color = "#0EE276";
						$colorFondo = "#0EE276";
						$idAsistencia = "";
						$className = "";
						$title = $asistencias['entrada']." - ". $asistencias['salida'];
					}elseif($asistencias['salida'] == "00:00:00") {
						$color = "";
						$colorFondo = "#EC5869";
						$idAsistencia = $asistencias['idAsistencias'];
						$className = "btn btn-danger rounded";
						$title = "AUSENTE";
					} else {
						$color = "";
						$colorFondo = "#EF890C";
						$idAsistencia = $asistencias['idAsistencias'];
						$className = "btn btn-warning rounded";
						$title = "RETARDO";
					}

				} elseif($asistencias['entrada'] == "00:00:00") {
					$color = "";
					$colorFondo = "#EC5869";
					$idAsistencia = $asistencias['idAsistencias'];
					$className = "btn btn-danger rounded";
					$title = "AUSENTE";
				} else {
					$color = "";
					$colorFondo = "#EF890C";
					$idAsistencia = $asistencias['idAsistencias'];
					$className = "btn btn-warning rounded";
					$title = "RETARDO";
				}
			}else{
				$title = $asistencias['entrada']." - ". $asistencias['salida'];
				if ($status_justificante == null) {
					$color = "";
					$colorFondo = "#DCDCDC";
				}elseif ($status_justificante == 1) {
					$color = "";
					$colorFondo = "#52DC96";
				}else{
					$color = "";
					$colorFondo = "#EEAB59";
				}
				$className = "";
				$idAsistencia = $asistencias['idAsistencias'];
			}

			$datos[] = array(
				"title" => $title,
				"start" => $asistencias['fecha_asistencia'],
				"end" => Null,
				"color" => $color,
				"colorFondo" => $colorFondo,
				"textColor" => "#000",
				"description" => $idAsistencia,
				"className" => $className,
				"hEntrada" => $asistencias['entrada'],
				"entrada" => $fecha['hora_Entrada'],
				"hSalida" => $asistencias['salida'],
				"salida" => $fecha['hora_Salida']
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
