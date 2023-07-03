<?php
session_start();
require_once "../controller/formularios.controlador.php";
require_once "../model/formularios.modelo.php";

$response = "";

if (!empty($_FILES['file']['name'])) {
    $targetDir = "../view/tareas/";

    // Procesar cada archivo individualmente
    $uploadedFiles = $_FILES['file'];

    foreach ($uploadedFiles['tmp_name'] as $key => $tmpName) {
        $fileName = basename($uploadedFiles["name"][$key]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $uploadOk = 1;
        $i = 1;

        // Verificar si el archivo ya existe y renombrarlo si es necesario
        while (file_exists($targetFilePath)) {
            $fileName = pathinfo($fileName, PATHINFO_FILENAME) . "($i)." . $fileType;
            $targetFilePath = $targetDir . $fileName;
            $i++;
        }

        // Verificar el tamaño máximo del archivo (10MB)
        if ($uploadedFiles["size"][$key] > 10 * 1024 * 1024) {
            $response .= $fileName;
            $uploadOk = 0;
        }

        // Verificar los tipos de archivo permitidos (.xlsx, .xls, .pdf)
        $allowedExtensions = array("xlsx", "xls", "pdf");
        if (!in_array($fileType, $allowedExtensions)) {
            $response .= $fileName;
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $response .= $fileName;
        } else {
            // Mover el archivo cargado al directorio de destino
            if (move_uploaded_file($tmpName, $targetFilePath)) {
                $response .= $fileName;
            } else {
                $response .= $fileName;
            }
        }
        $response .= ", ";
    }
} else {
    $response = "No se encontraron archivos";
}

echo $response;
