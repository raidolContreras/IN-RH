<?php
session_start();
require_once "../model/conexion.php";

// Conectamos a la base de datos
$conexion = Conexion::conectar();

// Realizamos la consulta de fechas

$sql = "SELECT * FROM incapacidades WHERE status = 1 AND Empleados_idEmpleados = ".$_SESSION['idEmpleado'];
$resultado = $conexion->query($sql);

// Creamos un array para almacenar los datos de fecha
$fechas = array();

// Recorremos los resultados de la consulta
while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
	if ($fila['fecha_termino'] != null) {
		$fila['fecha_termino'] = $fila['fecha_termino'].' 23:59:59';
	}

	$title = 'Incapacidad (Aprobadas)';
	$color = '#81A4EA';
	$textColor = '#fff';

	$fechas[] = array(
		"title" => $title,
		"start" => $fila['fecha_inicio'],
		"end" => $fila['fecha_termino'],
		"colorFondo" => $color,
		"textColor" => $textColor,
		"color" => $color
	);
}

// Convertimos el array de fechas a formato JSON
$json_fechas = json_encode($fechas);

// Devolvemos el resultado como texto JSON
header('Content-Type: application/json');
echo $json_fechas;

// Cerramos la conexión a la base de datos
$conexion = null;
