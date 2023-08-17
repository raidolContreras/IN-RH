<?php
require_once "../model/conexion.php";

// Conectamos a la base de datos
$conexion = Conexion::conectar();

// Realizamos la consulta de fechas
$sql = "SELECT
            COUNT(CASE WHEN p.statusPermiso = 1 THEN 1 ELSE NULL END) AS Aprobados,
            COUNT(CASE WHEN p.statusPermiso = 2 THEN 1 ELSE NULL END) AS Rechazados,
            COUNT(CASE WHEN p.statusPermiso IS NULL THEN 1 ELSE NULL END) AS Pendientes
        FROM empleados_has_permisos p;";
        
$resultado = $conexion->query($sql);

$stmt = Conexion::conectar()->prepare($sql);
$stmt->execute();
$permisos = $stmt->fetch();

// Convertimos el array de permisos a formato JSON
$json_permisos = json_encode($permisos);

// Devolvemos el resultado como texto JSON
header('Content-Type: application/json');
echo $json_permisos;

// Cerramos la conexión a la base de datos
$conexion = null;
