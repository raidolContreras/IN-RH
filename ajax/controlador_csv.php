<?php

require_once "../model/conexion.php";
// Controlador para procesar el archivo CSV

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha enviado un archivo
    if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] === UPLOAD_ERR_OK) {
        $csvFilePath = $_FILES['csvFile']['tmp_name'];

        // Leer los datos del archivo CSV
        $csvData = array_map('str_getcsv', file($csvFilePath));

        // Obtener los campos del encabezado del CSV
        $csvFields = $csvData[0];

        // Eliminar la primera fila de los datos
        array_shift($csvData);

        // Formatear la fecha en cada fila de datos
        foreach ($csvData as &$row) {
            $dateParts = explode('/', $row[5]); // Dividir la fecha en partes
            $formattedDate = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0]; // Formatear la fecha como "YYYY-MM-DD"
            $row[5] = $formattedDate;
        }
        unset($row); // Liberar la referencia de la última fila

        // Enviar los campos y los datos a la vista para su confirmación
        $data = array(
            'fields' => $csvFields,
            'data' => $csvData
        );

        echo json_encode($data);
        
        // Insertar los datos en la base de datos
        insertCSVData($csvData);
    } else {
        echo 'Error al cargar el archivo CSV.';
    }
}

function insertCSVData($csvData) {
    // Crear la conexión
    $conn = Conexion::conectar();

    // Preparar la consulta SQL para la inserción o actualización de los datos
    $stmt = $conn->prepare('SELECT * FROM asistencias WHERE Empleados_idEmpleados = ? AND fecha_asistencia = ?');
    $insertStmt = $conn->prepare('INSERT INTO asistencias (Empleados_idEmpleados, entrada, salida, entrada_descanso, salida_descanso, fecha_asistencia) 
        VALUES (?, ?, ?, ?, ?, ?)');
    $updateStmt = $conn->prepare('UPDATE asistencias SET entrada = ?, salida = ?, entrada_descanso = ?, salida_descanso = ? WHERE Empleados_idEmpleados = ? AND fecha_asistencia = ?');

    // Verificar la preparación de las consultas
    if (!$stmt || !$insertStmt || !$updateStmt) {
        die('Error en la consulta: ' . $conn->error);
    }

    // Bind parameters y ejecutar la consulta para cada fila de datos
    foreach ($csvData as $data) {
        $idEmpleado = $data[0];
        $fecha = $data[5];

        // Verificar si el registro ya existe
        $stmt->bindValue(1, $idEmpleado);
        $stmt->bindValue(2, $fecha);
        $stmt->execute();
        $existingRow = $stmt->fetch(PDO::FETCH_ASSOC);

        // Actualizar o insertar el registro según corresponda
        if ($existingRow) {
            $updateStmt->bindValue(1, $data[1]);
            $updateStmt->bindValue(2, $data[2]);
            $updateStmt->bindValue(3, $data[3]);
            $updateStmt->bindValue(4, $data[4]);
            $updateStmt->bindValue(5, $idEmpleado);
            $updateStmt->bindValue(6, $fecha);
            $updateStmt->execute();
        } else {
            $insertStmt->bindValue(1, $idEmpleado);
            $insertStmt->bindValue(2, $data[1]);
            $insertStmt->bindValue(3, $data[2]);
            $insertStmt->bindValue(4, $data[3]);
            $insertStmt->bindValue(5, $data[4]);
            $insertStmt->bindValue(6, $fecha);
            $insertStmt->execute();
        }
    }

    // Cerrar la declaración y la conexión
    $stmt->closeCursor();
    $insertStmt->closeCursor();
    $updateStmt->closeCursor();
    $conn = null;
}
