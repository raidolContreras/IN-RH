<?php 
$preguntas = ControladorFormularios::ctrVerPreguntas(null, null);
$datos = array();
foreach ($preguntas as $pregunta) {
	if ($pregunta['idExamen'] == $_GET['evaluacion']) {
		$datos[] = array(
			'idPregunta' => $pregunta['idPregunta'],
			'tipo_pregunta' => $pregunta['tipo_pregunta'],
			'pregunta' => $pregunta['pregunta']
		);
	}
}
?>

<style>
	.card-header {
		background-color: #007bff;
		color: #fff;
		border-bottom: none;
		padding: 15px;
	}

	.card-header h5 {
		margin-bottom: 0;
		color: #fff;
	}

	.list-group-item {
		border: none;
	}

	.list-group-item:hover {
		background-color: #f8f9fa;
		cursor: pointer;
	}

	.badge {
		margin-left: 10px;
	}
</style>

<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="card mx-5 menu-ajustes">
			<div class="card-header">
				<h5>Preguntas</h5>
			</div>
			<div class="card-body">
				<div class="list-group">
					<?php foreach ($datos as $dato): ?>
						<a href="#" class="list-group-item list-group-item-action">
							<div class="d-flex justify-content-between align-items-center">
								<h6 class="mb-0"><?php echo $dato['pregunta']; ?></h6>
								<span class="badge badge-primary"><?php echo ucwords(str_replace('_', ' ', $dato['tipo_pregunta'])); ?></span>
							</div>
							<small class="text-muted">ID Pregunta: <?php echo $dato['idPregunta']; ?></small>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>

