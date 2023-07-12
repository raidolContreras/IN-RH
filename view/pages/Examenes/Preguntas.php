<?php 
$preguntas = ControladorFormularios::ctrVerPreguntas(null, null);
$datos = array();
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
						<button data-toggle="modal" 
								data-target="#Pregunta<?php echo $dato['idPregunta']; ?>"
								class="list-group-item list-group-item-action">
							<div class="d-flex justify-content-between align-items-center">
								<h6 class="mb-0"><?php echo $dato['pregunta']; ?></h6>
								<span class="badge badge-primary">
									<?php echo ucwords(str_replace('_', ' ', $dato['tipo_pregunta'])); ?>
								</span>
							</div>
						</button>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
 	foreach ($datos as $dato): 
	$datosRespuesta = array();
	$respuestas = ControladorFormularios::ctrVerRespuestas(null, null);
		foreach ($respuestas as $respuesta) {
			if ($respuesta['idPregunta'] == $dato['idPregunta']) {
				$datosRespuesta[] = array(
					'idRespuesta' => $respuesta['idRespuesta'],
					'respuesta' => $respuesta['respuesta'],
					'valor' => $respuesta['valor']
				);
			}
		}
	?>
	<div class="modal fade" id="Pregunta<?php echo $dato['idPregunta']; ?>">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h3><?php echo $dato['pregunta']; ?></h3>
					<a href="EliminarPregunta&pregunta=<?php echo $dato['idPregunta']; ?>&examen=<?php echo $dato['idExamen']; ?>" class="btn btn-outline-danger rounded"><i class="fas fa-trash"></i></a>
				</div>
				<div class="modal-body">
					<div class="row" style="justify-content: space-between; align-items: center;">
						<div><p class="titulo">Respuestas</p></div>
					<?php if ($dato['tipo_pregunta'] == 'opcion_multiple'): ?>
						<div class="float-right"><button class="btn btn-outline-primary rounded"><span>Agregar Respuesta</span></button></div>
					<?php endif ?>
					</div>
					<hr>
					<form>

						<?php foreach ($datosRespuesta as $value): ?>

							<label class="custom-control custom-radio">
							<?php if ($value['valor'] == 1): ?>
								<input type="radio" name="radio-inline" class="custom-control-input" checked disabled>
							<?php else: ?>
								<input type="radio" name="radio-inline" class="custom-control-input" disabled>
							<?php endif ?>
								<span class="custom-control-label">
									<?php echo $value['respuesta']; ?>
								</span>
							</label>

						<?php endforeach ?>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php endforeach; ?>