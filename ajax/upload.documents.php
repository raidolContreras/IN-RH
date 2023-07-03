<?php
session_start();
require_once "../controller/formularios.controlador.php";
require_once "../model/formularios.modelo.php";

if (isset($_POST['idTarea'])) {
    $idTareas = $_POST['idTarea'];
    $tipo = '';
    if (!empty($_FILES['file']['name'])) {
        $targetDir = "../view/tareas/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if ($fileType == 'pdf') {
            $tipo = 'pdf';
        }else{
            $tipo = 'excel';
        }

        $uploadOk = 1;
        $i = 1;

        // Verificar si el archivo ya existe y renombrarlo si es necesario
        while (file_exists($targetFilePath)) {
            $fileName = pathinfo($fileName, PATHINFO_FILENAME) . "($i)." . $fileType;
            $targetFilePath = $targetDir . $fileName;
            $i++;
        }

        // Verificar el tamaño máximo del archivo (10MB)
        if ($_FILES["file"]["size"] > 10 * 1024 * 1024) {
            echo "error_tamano";
            $uploadOk = 0;
        }

        // Verificar los tipos de archivo permitidos (.xlsx, .xls, .pdf)
        $allowedExtensions = array("xlsx", "xls", "pdf");
        if (!in_array($fileType, $allowedExtensions)) {
            echo "error_tipo";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "error";
        } else {
            // Mover el archivo cargado al directorio de destino
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                $data = array(
                    "Tareas_idTareas" => $idTareas,
                    "tipo" => $tipo,
                    "nameDocumento" => $fileName
                );
                $registrarDocumentos = ControladorFormularios::ctrRegistrarDocumentosTareas($data);
                echo $registrarDocumentos;
            } else {
                echo "error";
            }
        }
    } else {
        echo "error";
    }

}