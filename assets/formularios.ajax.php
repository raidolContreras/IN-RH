<?php
    
require_once "../controller/formularios.controlador.php";
require_once "../model/formularios.modelo.php";
   
// Obtener los valores enviados por el formulario AJAX
$nameDoc = $_POST['nameDoc'];
$empleadoId = $_POST['empleadoId'];

$resultado = ControladorFormularios::ctrVerDocumento($_POST['nameDoc'],$_POST['empleadoId'])

// Verificar si la consulta devolvió algún resultado
if ($resultado['nameDoc'] == $nameDoc) {
  // Si hay resultados, significa que el documento existe para el empleado especificado
  echo "Existe";
} else {
  // Si no hay resultados, significa que el documento no existe o no pertenece al empleado especificado
  echo "No Existe";
}

?>
