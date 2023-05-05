<?php

require_once "model/conexion.php";

// Conectamos a la base de datos
$conexion = Conexion::conectar();

// Realizamos la consulta de fechas
$sql = "SELECT namePostulante, lastnamePostulante, color, fechaReunion FROM vacantes v JOIN postulantes p ON p.Vacantes_idVacantes = v.idVacantes JOIN reuniones r ON r.Postulantes_idPostulantes = p.idPostulantes;
";
$resultado = $conexion->query($sql);

// Creamos un array para almacenar los datos de fecha
$fechas = array();

// Recorremos los resultados de la consulta
while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $fechas[] = array(
        'title' => $fila['namePostulante']." ".$fila['lastnamePostulante'],
        'start' => $fila['fechaReunion'],
        'backgroundColor' => $fila['color'],
        'borderColor' => $fila['color']
    );
}

// Convertimos el array de fechas a formato JSON
$json_fechas = json_encode($fechas);

// Devolvemos el resultado como texto JSON
header('Content-Type: application/json');
echo $json_fechas;

// Cerramos la conexión a la base de datos
$conexion = null;
