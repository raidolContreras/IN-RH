<?php
require_once "../model/conexion.php";

// Conectamos a la base de datos
$conexion = Conexion::conectar();

// Realizamos la consulta de fechas
$sql = "SELECT
            COUNT(CASE WHEN v.respuesta = 1 THEN 1 ELSE NULL END) AS Aprobados,
            COUNT(CASE WHEN v.respuesta = 2 THEN 1 ELSE NULL END) AS Rechazados,
            COUNT(CASE WHEN v.respuesta IS NULL THEN 1 ELSE NULL END) AS Pendientes
        FROM vacaciones v
        WHERE v.status_vacaciones = 1;";
$resultado = $conexion->query($sql);

$stmt = Conexion::conectar()->prepare($sql);
$stmt->execute();
$vacaciones = $stmt->fetch();

// Convertimos el array de vacaciones a formato JSON
$json_vacaciones = json_encode($vacaciones);

// Devolvemos el resultado como texto JSON
header('Content-Type: application/json');
echo $json_vacaciones;

// Cerramos la conexión a la base de datos
$conexion = null;
