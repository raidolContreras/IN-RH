<?php
// Obtener el estado seleccionado desde la solicitud AJAX
$estado = $_GET['estado'];

// Leer el archivo JSON de estados
$estadosJson = file_get_contents('view/pages/json/estados.json');

// Leer el archivo JSON de ciudades
$ciudadesJson = file_get_contents('view/pages/json/ciudades.json');

// Convertir el JSON a un array asociativo
$estadosArray = json_decode($estadosJson, true);
$ciudadesArray = json_decode($ciudadesJson, true);

// Obtener la clave del estado seleccionado
$claveEstado = '';
foreach ($estadosArray as $estadoArray) {
    if ($estadoArray['nombre'] === $estado) {
        $claveEstado = $estadoArray['clave'];
        break;
    }
}

// Obtener las ciudades correspondientes al estado seleccionado
$ciudades = $ciudadesArray[$claveEstado];

// Devolver las ciudades como una respuesta JSON
echo json_encode($ciudades);
?>