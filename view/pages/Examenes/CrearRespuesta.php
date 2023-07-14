<?php
if (isset($_GET['pregunta'])) {
	$Evaluaciones = ControladorFormularios::ctrVerPreguntas('idPregunta', $_GET['pregunta']);
	if (empty($Evaluaciones)) {
		echo '<script>window.location.href="Evaluaciones"</script>';
	}
}
if ($Evaluaciones['tipo_pregunta'] == 'opcion_multiple'){
	include('view/pages/Examenes/Preguntas/opcion_multiple.php');
}elseif ($Evaluaciones['tipo_pregunta'] == 'escala'){
	include('view/pages/Examenes/Preguntas/escala.php');
}else {
	echo '<script>window.location.href="Preguntas&evaluacion='.$Evaluaciones['idExamen'].'"</script>';
}