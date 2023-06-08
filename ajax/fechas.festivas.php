<?php
require_once "../model/conexion.php";

// Conectamos a la base de datos
$conexion = Conexion::conectar();

// Realizamos la consulta de fechas
$sql = "SELECT * FROM festivos";
$resultado = $conexion->query($sql);

// Creamos un array para almacenar los datos de fecha
$fechas = array();

// Recorremos los resultados de la consulta
while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
    if ($fila['fechaFin'] != null) {
        $fila['fechaFin'] = $fila['fechaFin'].' 23:59:59';
    }
    $fechas[] = array(
        "title" => $fila['nameFestivo'],
        "start" => $fila['fechaFestivo'],
        "end" => $fila['fechaFin'],
        "color" => "#BABABA"
    );
}

// Convertimos el array de fechas a formato JSON
$json_fechas = json_encode($fechas);

// Devolvemos el resultado como texto JSON
header('Content-Type: application/json');
echo $json_fechas;

// Cerramos la conexión a la base de datos
$conexion = null;
