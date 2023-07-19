<?php
if (isset($_GET['verExamen'])) {
	$Evaluaciones = ControladorFormularios::ctrVerEvaluaciones('idExamen', $_GET['verExamen']);
	$Evaluacion = ControladorFormularios::ctrVerEvaluacionesEmpleados('idExamen', $_GET['verExamen']);

	$examen = $_GET['verExamen'];

	foreach ($Evaluacion as $value) {
		if ($value['idEmpleado'] == $_SESSION['idEmpleado']) {
			$fecha_inicio_examen = $value['fecha_inicio'];
		}
	}

	$estado = 2;

}elseif (isset($_GET['evaluacion'])) {
	$Evaluaciones = ControladorFormularios::ctrVerEvaluaciones('idExamen', $_GET['evaluacion']);
	$Evaluacion = ControladorFormularios::ctrVerEvaluacionesEmpleados('idExamen', $_GET['evaluacion']);

	foreach ($Evaluacion as $value) {
		if ($value['idEmpleado'] == $_SESSION['idEmpleado']) {
			$fecha_inicio_examen = $value['fecha_inicio'];
		}
	}

	$examen = $_GET['evaluacion'];
	$estado = 0;
}

if ((isset($_GET['inicio']) && $_GET['inicio'] == $_SESSION['idEmpleado']) && $fecha_inicio_examen != null) {
		$estado = 1;
}

if ($Evaluaciones['fecha_fin'] == null) {
	$fecha_fin = 'Este examen se mantendra siempre abierto';
}else{
	$fecha_fin = "Este examen se cerrará el ".ControladorFormularios::ctrFormatearMes($Evaluaciones['fecha_fin']);
}

$fecha_inicio = ControladorFormularios::ctrFormatearMes($Evaluaciones['fecha_inicio']);

$tiempo = ControladorFormularios::ctrFormatearTiempo($Evaluaciones['tiempo_limite']);

if ($Evaluaciones['intentos_maximos'] != null) {
	$intentos_maximos = 'Intentos permitidos: '.$Evaluaciones['intentos_maximos'];
}else{
	$intentos_maximos = '';
}
?>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="row">
			<?php if ($estado == 0): ?>
				<?php include 'view/pages/Examenes/examen/comenzar_examen.php'; ?>
			<?php elseif ($estado == 1): ?>
				<?php include 'view/pages/Examenes/examen/examen_iniciado.php'; ?>
			<?php elseif ($estado == 2): ?>
				<?php include 'view/pages/Examenes/examen/examen_terminado.php'; ?>
			<?php endif ?>
		</div>
	</div>
</div>