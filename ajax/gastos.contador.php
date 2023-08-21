<?php
require_once "../model/conexion.php";

// Conectamos a la base de datos
$conexion = Conexion::conectar();
if (!isset($_GET['informe'])) {
// Realizamos la consulta de cantidades y sumas por estado de gastos
    $sql = "SELECT
                SUM(CASE WHEN g.status = 1 THEN g.importeTotal ELSE 0 END) AS Aprobados,
                SUM(CASE WHEN g.status = 2 THEN g.importeTotal ELSE 0 END) AS Rechazados,
                SUM(CASE WHEN g.status = 0 THEN g.importeTotal ELSE 0 END) AS Pendientes,
                SUM(CASE WHEN g.status = 3 THEN g.importeTotal ELSE 0 END) AS Pagados
            FROM gastos g
            WHERE YEAR(g.fechaDocumento) = YEAR(CURDATE())
            AND MONTH(g.fechaDocumento) = MONTH(CURDATE())";
}else{
    $informe = $_GET['informe'];
    $sql = "SELECT
                SUM(CASE WHEN g.status = 1 THEN g.importeTotal ELSE 0 END) AS Aprobados,
                SUM(CASE WHEN g.status = 2 THEN g.importeTotal ELSE 0 END) AS Rechazados,
                SUM(CASE WHEN g.status = 0 THEN g.importeTotal ELSE 0 END) AS Pendientes,
                SUM(CASE WHEN g.status = 3 THEN g.importeTotal ELSE 0 END) AS Pagados
            FROM gastos g
            WHERE g.Empleados_idEmpleados = $informe
            AND YEAR(g.fechaDocumento) = YEAR(CURDATE())";
}

$resultado = $conexion->query($sql);

// Obtener los datos del resultado como un array asociativo
$gastos = $resultado->fetch(PDO::FETCH_ASSOC);

// Convertir el array de gastos a formato JSON
$json_gastos = json_encode($gastos);

// Devolver el resultado como texto JSON
header('Content-Type: application/json');
echo $json_gastos;

// Cerramos la conexión a la base de datos
$conexion = null;
