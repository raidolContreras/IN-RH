<?php
session_start();
require_once "../model/conexion.php";

// Conectamos a la base de datos
$conexion = Conexion::conectar();

// Realizamos la consulta de fechas

$sql = "SELECT * FROM vacaciones WHERE Empleados_idEmpleados = ".$_SESSION['idEmpleado'];
$resultado = $conexion->query($sql);

// Creamos un array para almacenar los datos de fecha
$fechas = array();

// Recorremos los resultados de la consulta
while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
    if ($fila['status_vacaciones'] != 2) {
        if ($fila['respuesta'] != 2) {
            if ($fila['fecha_fin_vacaciones'] != null) {
                $fila['fecha_fin_vacaciones'] = $fila['fecha_fin_vacaciones'].' 23:59:59';
            }

            if ($fila['respuesta'] == null) {
                $title = 'Vacaciones (Pendiente)';
                $color = '#BABABA';
                $textColor = '#000';
            }elseif ($fila['respuesta'] == 1){
                $title = 'Vacaciones (Aprobadas)';
                $color = '#47AEDA';
                $textColor = '#000';
            }

            $fechas[] = array(
                "title" => $title,
                "start" => $fila['fecha_inicio_vacaciones'],
                "end" => $fila['fecha_fin_vacaciones'],
                "colorFondo" => $color,
                "textColor" => $textColor,
                "color" => $color
            );
        }
    }
}

// Convertimos el array de fechas a formato JSON
$json_fechas = json_encode($fechas);

// Devolvemos el resultado como texto JSON
header('Content-Type: application/json');
echo $json_fechas;

// Cerramos la conexión a la base de datos
$conexion = null;
