<?php
    // Incluye la conexión a la base de datos
    require_once "conexion.php";
    
    // Consulta a la base de datos
    $consulta = "SELECT * FROM documento where nameDoc = 'curriculum' AND Empleados_idEmpleados = 5";
    $resultado = Conexion::conectar()->query($consulta);
    
    // Crear un arreglo con los resultados
    $registros = array();
    while($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
        $registros[] = $fila;
    }
    
    // Devolver los resultados en formato JSON
    echo json_encode($registros);