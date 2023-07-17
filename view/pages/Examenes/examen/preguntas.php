<?php 
$preguntas = ControladorFormularios::ctrVerPreguntas(null, null);
$datos = array();
$nombre = '';
foreach ($preguntas as $pregunta) {
	if ($pregunta['idExamen'] == $_GET['evaluacion']) {
		$datos[] = array(
			'idPregunta' => $pregunta['idPregunta'],
			'tipo_pregunta' => $pregunta['tipo_pregunta'],
			'pregunta' => $pregunta['pregunta'],
			'idExamen' => $pregunta['idExamen']
		);
	}
}
?>
