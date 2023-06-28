<?php
session_start();
require_once "../model/conexion.php";

// Conectamos a la base de datos
$conexion = Conexion::conectar();

// Realizamos la consulta de fechas

$sql = "SELECT * FROM empleados_has_permisos ep
        RIGHT JOIN permisos p ON p.idPermisos = ep.Permisos_idPermisos
        WHERE Empleados_idEmpleados = ".$_SESSION['idEmpleado'];
$resultado = $conexion->query($sql);

// Creamos un array para almacenar los datos de fecha
$fechas = array();

// Recorremos los resultados de la consulta
while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
    if ($fila['fechaFin'] != null) {
        $fila['fechaFin'] = $fila['fechaFin'].' 23:59:59';
    }

    if ($fila['statusPermiso'] == null) {
        $title = $fila['namePermisos'];
        $color = '#BABABA';
        $textColor = '#000';
    }elseif ($fila['statusPermiso'] == 1){
        $title = $fila['namePermisos'];
        $color = $fila['colorPermisos'];
        $textColor = '#000';
    }elseif ($fila['statusPermiso'] == 2){
        $title = $fila['namePermisos'];
        $color = '#ef172c';
        $textColor = '#fff';
    }

    $fechas[] = array(
        "title" => $title,
        "start" => $fila['fechaPermiso'],
        "end" => $fila['fechaFin'],
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
