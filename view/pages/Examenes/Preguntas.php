<?php if (!empty($rol) && $rol['Ver_Evaluaciones'] == 1): ?>

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

<style>
	.card-header {
		background-color: #fefefe;
		color: #A4A4A4;
		border-bottom: 1px solid #BABABA;
		padding: 15px;
	}

	.card-header h5 {
		margin-bottom: 0;
		color: #949494;
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
			<div class="card-header row" style="justify-content: space-between; align-items: center;">
			<h5>Preguntas</h5>
			<?php if (!empty($rol) && $rol['Editar_Evaluaciones'] == 1): ?>
			<a class="btn btn-outline-primary rounded" href="AddPregunta&evaluacion=<?php echo $_GET['evaluacion']; ?>">Agregar preguntas</a>
			<?php endif ?>
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
<?php foreach ($datos as $dato):

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

<div class="modal" id="Pregunta<?php echo $dato['idPregunta']; ?>">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h3><?php echo $dato['pregunta']; ?></h3>
					<?php if (!empty($rol) && $rol['Del_Evaluaciones'] == 1 && $rol['Editar_Evaluaciones'] == 1): ?>
					<a href="EliminarPregunta&pregunta=<?php echo $dato['idPregunta']; ?>&examen=<?php echo $dato['idExamen']; ?>"
						 class="btn btn-outline-danger rounded">
						<i class="fas fa-trash"></i>
					</a>
					<?php endif ?>
				</div>
					<div class="modal-body">
						<div class="row" style="justify-content: space-between; align-items: center;">
							<div>
								<p class="titulo">Respuestas</p>
							</div>
							<?php if ($dato['tipo_pregunta'] == 'opcion_multiple'): ?>
								<div class="float-right">
									<button id="AddRespuesta<?php echo $dato['idPregunta']; ?>" class="btn btn-outline-primary rounded">
										<span>Agregar Respuesta</span>
									</button>
								</div>
								<script>
									var mensaje = `<div class='alert alert-success' role="alert" id="alerta">
																		<i class="fas fa-check-circle"></i>
																		¡Respuesta añadida!
																	</div>`;
									var error = `<div class='alert alert-danger' role="alert" id="alerta">
																	<i class="fas fa-exclamation-triangle"></i>
																	<b>Error</b>, no se añadio la respuesta, intenta nuevamente.
																</div>`;
									$(document).ready(function () {
										var nRespuestas = 1;
										$("#AddRespuesta<?php echo $dato['idPregunta']; ?>").click(function () {
											var Add<?php echo $dato['idPregunta']; ?> = $("#Add<?php echo $dato['idPregunta']; ?>");
											Add<?php echo $dato['idPregunta']; ?>.empty(); // Limpiar el contenedor antes de generar los nuevos inputs
											var pregunta = document.createElement('input');
												pregunta.type = 'hidden';
												pregunta.name = 'idAddRespuesta';
												pregunta.value = <?php echo $dato['idPregunta']; ?>;

											var form = document.createElement('form');
												form.className = 'row';
												form.classList.add('col-xl-12');
												form.classList.add('mt-3');
												form.id = 'AddRespuesta-form'+<?php echo $dato['idPregunta']; ?>;
												form.style.alignItems = 'center'; 
												form.style.justifyContent = 'center'; 

									// Crear el elemento de input de respuesta
											var respuestaInput = document.createElement('input');
												respuestaInput.type = 'text';
												respuestaInput.className = 'form-control';
												respuestaInput.name = 'Respuesta';
												respuestaInput.id = 'Respuesta';
												respuestaInput.required = true;

											var divCheckbox = document.createElement('div');
												divCheckbox.className = 'col-xl-3';

											var divText = document.createElement('div');
												divText.className = 'col-xl-6';

											var divButton = document.createElement('div');
												divButton.className = 'col-xl-2';

									// Crear el elemento de input para marcar como correcta
											var correctaInput = document.createElement('input');
												correctaInput.type = 'checkbox';
												correctaInput.className = 'form-control';
												correctaInput.name = 'Correcta';

									// Crear el elemento de etiqueta para marcar como correcta
											var correctaLabel = document.createElement('label');
												correctaLabel.htmlFor = 'Correcta';
												correctaLabel.innerText = 'Marcar como correcta';

									// Crear el botón de enviar datos
											var enviarDatosBtn = document.createElement('button');
												enviarDatosBtn.className = 'btn btn-primary rounded';
												enviarDatosBtn.type = 'button';
												enviarDatosBtn.id = 'AddRespuesta-btn';
												enviarDatosBtn.innerHTML = 'Registrar respuesta';
												enviarDatosBtn.addEventListener('click', function () {
													crearRespuesta<?php echo $dato['idPregunta']; ?>();
												});

									// Crear el contenedor para la respuesta y la marca de correcta
											var respuestaContainer = document.createElement('div');
												respuestaContainer.className = 'form-row';

												divCheckbox.appendChild(correctaInput);
												divCheckbox.appendChild(correctaLabel);

												divText.appendChild(respuestaInput);

												divButton.appendChild(enviarDatosBtn);

												form.appendChild(divCheckbox);
												form.appendChild(divText);
												form.appendChild(divButton);

								// Agregar el contenedor de respuesta al contenedor principal
												Add<?php echo $dato['idPregunta']; ?>.append(form);

												nRespuestas++;

												form.append(pregunta);

												$("#AddRespuesta<?php echo $dato['idPregunta']; ?>").hide(); // Ocultar el botón "Agregar Respuesta"
											});

										});
								</script>
							<?php endif ?>
						</div>
						<hr>
						<?php foreach ($datosRespuesta as $value): ?>

							<?php if ($dato['tipo_pregunta'] == 'opcion_multiple'): ?>
						<div class="row" style="align-items: center; justify-content: space-between;">
							<label class="custom-control custom-radio float-right">
								<?php if ($value['valor'] == 1): ?>
									<input type="radio" class="custom-control-input" checked disabled>
								<?php else: ?>
									<input type="radio" class="custom-control-input" disabled>
								<?php endif ?>
								<span class="custom-control-label">
								</span>
							</label>
							<?php endif ?>
							<?php echo ucwords($value['respuesta']); ?>
							<?php if ($dato['tipo_pregunta'] == 'opcion_multiple'): ?>
							<button 
							class="btn btn-in-consulting float-left"
							onClick='eliminarRespuesta(<?php echo $value['idRespuesta'] ?>)'>
								<span>&times;</span>
							</button>
							<?php endif ?>
						</div>
							<?php if ($value['respuesta'] == 'binario'): ?>
								
							<div class="row" style="flex-direction: column;">
								<div class="col-12">
									<label class="custom-control custom-radio">
										<?php if ($value['valor'] == 4): ?>
											<input type="radio" class="custom-control-input" checked disabled>
										<?php else: ?>
											<input type="radio" class="custom-control-input" disabled>
										<?php endif ?>
										<span class="custom-control-label">
											Verdadero
										</span>
									</label>
									<label class="custom-control custom-radio">
										<?php if ($value['valor'] == 5): ?>
											<input type="radio" class="custom-control-input" checked disabled>
										<?php else: ?>
											<input type="radio" class="custom-control-input" disabled>
										<?php endif ?>
										<span class="custom-control-label">
											Falso
										</span>
									</label>
								</div>

							</div>

							<?php elseif ($value['respuesta'] == 'escala'): ?>
								<?php
									$escalaFile = file_get_contents('view/pages/json/escalas.json');
									$escala = json_decode($escalaFile, true);

									$opciones = $escala[$value['valor']];

									echo '<div class="row" style="flex-direction: column;">';
										foreach ($opciones as $key => $opcion) {
											echo '<div class="col-12">';
											echo '<label class="custom-control custom-radio">';
											echo '<input type="radio" class="custom-control-input" disabled>';
											echo '<span class="custom-control-label">';
											echo $opcion;
											echo '</span>';
											echo '</label>';
											echo '</div>';
										}
									echo '</div>';
								?>
							<?php endif ?>
						<?php endforeach ?>
						<div id="Add<?php echo $dato['idPregunta']; ?>"></div>
					</div>
			</div>
		</div>
</div>
<script>
	function crearRespuesta<?php echo $dato['idPregunta']; ?>(){
		var formData = $("#AddRespuesta-form<?php echo $dato['idPregunta']; ?>").serialize(); // Obtener los datos del formulario
		$.ajax({
			url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
			type: "POST",
			data: formData,
			success: function(response) {
				if (response === 'ok') {
					$("#form-result").val("");
					$("#form-result").html(mensaje);
					deleteAlert();
					setTimeout(function () {
						window.location.href='Preguntas&evaluacion=<?php echo $_GET['evaluacion']; ?>';
					}, 500);
				}else{
					$("#form-result").val("");
					$("#form-result").html(error);
					deleteAlert();
				}
			}
		});
	}
</script>
<?php endforeach; ?>

<script>

	var mensaje2 = `<div class='alert alert-success' role="alert" id="alerta">
										<i class="fas fa-check-circle"></i>
										¡Respuesta eliminada!
									</div>`;
	var error2 = `<div class='alert alert-danger' role="alert" id="alerta">
									<i class="fas fa-exclamation-triangle"></i>
									<b>Error</b>, no se elimino la respuesta, intenta nuevamente.
								</div>`;

	function eliminarRespuesta(eliminar){
		$.ajax({
			url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
			type: "POST",
			data: {eliminarRespuesta: eliminar},
			success: function(response) {
				if (response === 'ok') {
					$("#form-result").val("");
					$("#form-result").html(mensaje2);
					deleteAlert();
					setTimeout(function () {
						window.location.href='Preguntas&evaluacion=<?php echo $_GET['evaluacion']; ?>';
					}, 500);
				}else{
					$("#form-result").val("");
					$("#form-result").html(error2);
					deleteAlert();
				}
			}
		});
	}

		function deleteAlert() {
			setTimeout(function () {
					var alert = $('#alerta');
					alert.fadeOut('slow', function () {
						alert.remove();
					});
			}, 400);
		}
</script>

<?php else: ?>
	<script>
		window.location.href = 'Evaluaciones_Asignadas';
	</script>
<?php endif ?>