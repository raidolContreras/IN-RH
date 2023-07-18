<?php
$preguntas = ControladorFormularios::ctrVerPreguntasExamen('idExamen', $_GET['evaluacion']);
$indicesFile = file_get_contents('view/pages/json/indices.json');
$indice = json_decode($indicesFile, true);
$escalaFile = file_get_contents('view/pages/json/escalas.json');
$escala = json_decode($escalaFile, true);
$i = 1;
?>

<div class="col-12">
	<div class="row">
		<div class="col-xl-9 col-lg-12 col-md-12 order-2 order-xl-1">
			<div class="row" style="font-family: 'Arial';">
				<?php foreach ($preguntas as $pregunta):
					$datos = array(
						"idPregunta" => $pregunta['idPregunta'],
						"idExamen" => $_GET['evaluacion'],
						"idEmpleado" => $_SESSION['idEmpleado']
					);
					$buscarRespuestas = ModeloFormularios::mdlBuscarRespuestas($datos);
					if (!empty($buscarRespuestas)) {
						$respondido = 'Respondido';
						$buscarRespuesta = $buscarRespuestas['respuesta'];
					}else{
						$respondido = 'Sin responder aún';
						$buscarRespuesta = '';
					}
				?>
					<div class="col-xl-3 px-3">
						<div class="card" style="border-radius: 10px;">
							<div class="card-header" style="border-radius: 10px; box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.1);">
								<?php echo "Pregunta ".$i; ?>
							</div>
							<div class="card-body" id="<?php echo $pregunta['idPregunta'] ?>" style="font-size:11px"><?php echo $respondido; ?></div>
						</div>
					</div>
					<div class="col-xl-9 px-3">
						<div class="card" style="border-radius: 10px;">
							<div class="card-header" style="border-radius: 10px; box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.1);">
								<?php echo $pregunta['pregunta']; ?>
							</div>
							<div class="card-body">
								<?php if ($pregunta['tipo_pregunta'] == 'abierta'): ?>
									<p>Escribe la respuesta:</p>
									<form id="pregunta<?php echo $pregunta['idPregunta'] ?>" class="ml-2">
										<div class="row">
											<input type="text" class="form-control" name="r<?php echo $i ?>" value="<?php echo $buscarRespuesta; ?>">
										</div>
									</form>
								<?php elseif ($pregunta['tipo_pregunta'] == 'opcion_multiple'): ?>
									<p>Seleccione una:</p>
									<form id="pregunta<?php echo $pregunta['idPregunta'] ?>" class="ml-2">
										<?php $a = 0; ?>
										<?php foreach (ControladorFormularios::ctrVerRespuestasExamen('idPregunta', $pregunta['idPregunta']) as $respuesta): ?>
											<div class="row">
												<label class="custom-control custom-radio">
													<?php if ($buscarRespuesta == $respuesta['respuesta']): ?>
													<input type="radio" class="custom-control-input" name="r<?php echo $i ?>" value="<?php echo $respuesta['respuesta'] ?>" checked>
													<?php else: ?>
													<input type="radio" class="custom-control-input" name="r<?php echo $i ?>" value="<?php echo $respuesta['respuesta'] ?>">
													<?php endif ?>
													<span class="custom-control-label">
														<?php echo $indice['indices'][$a].'. '.$respuesta['respuesta'] ?>
													</span>
												</label>
											</div>
											<?php $a++; ?>
										<?php endforeach ?>
									</form>
								<?php elseif ($pregunta['tipo_pregunta'] == 'escala'): ?>
									<p>Seleccione una:</p>
									<form id="pregunta<?php echo $pregunta['idPregunta'] ?>" class="ml-2">
										<?php $a = 0; ?>
										<?php foreach (ControladorFormularios::ctrVerRespuestasExamen('idPregunta', $pregunta['idPregunta']) as $respuesta): ?>
											<?php $opciones = $escala[$respuesta['valor']]; ?>
											<?php foreach ($opciones as $key => $opcion): ?>
												<div class="row">
													<label class="custom-control custom-radio">
														<?php if ($buscarRespuesta == $key): ?>
														<input type="radio" class="custom-control-input" name="r<?php echo $i ?>" value="<?php echo $key ?>" checked>
														<?php else: ?>
														<input type="radio" class="custom-control-input" name="r<?php echo $i ?>" value="<?php echo $key ?>">
														<?php endif ?>
														<span class="custom-control-label">
															<?php echo $indice['indices'][$a].'. '.$opcion ?>
														</span>
													</label>
												</div>
												<?php $a++; ?>
											<?php endforeach ?>
										<?php endforeach ?>
									</form>
								<?php endif ?>
							</div>
						</div>
					</div>
				<?php $i++; endforeach ?>
			</div>

			<div class="row float-right">
				<button class="btn btn-primary rounded btn-block">Terminar examen</button>
			</div>
		</div>

		<div class="col-xl-3 col-lg-12 col-md-12 order-xl-2 order-1 px-0">
			<div class="card" style="border-radius: 10px;">
				<div class="card-body" id="timer" style="font-size:12px"></div>
			</div>
		</div>
	</div>
</div>

<?php if ($tiempo == 'Sin limite de tiempo'): ?>
	<script>
		document.getElementById("timer").innerHTML = "Sin limite de tiempo";
	</script>
<?php else: ?>
	<script>
		const examen = <?php echo $_GET['evaluacion']; ?>;
		document.addEventListener('DOMContentLoaded', function() {
			// Función para enviar la respuesta por AJAX
			function enviarRespuesta(preguntaId, respuesta) {
				// Aquí puedes realizar la petición AJAX para enviar la respuesta al servidor
				// Por ejemplo, con jQuery:
				$.ajax({
					url: "ajax/ajax.formularios.php",
					type: "POST",
					data: { preguntaId: preguntaId, respuestaExamen: respuesta, examen: examen },
					success: function(response) {
            $("#"+preguntaId).val("");
						$("#"+preguntaId).html(`Respondido`);
					},
					error: function(xhr, status, error) {
						// Manejar los errores de la petición AJAX
					}
				});
			}

			// Obtener todos los formularios de preguntas
			var formularios = document.querySelectorAll('form[id^="pregunta"]');

			// Iterar sobre cada formulario
			formularios.forEach(function(formulario) {
				formulario.addEventListener('change', function() {
					var preguntaId = formulario.getAttribute('id').replace('pregunta', '');
					var respuesta = formulario.querySelector('input[name^="r"]:checked')?.value || formulario.querySelector('input[name^="r"]').value;
					enviarRespuesta(preguntaId, respuesta);
				});
			});
		});

		// Establecer las fechas de inicio y fin
		var fechaInicio = new Date("<?php echo $fecha_inicio_examen ?>");
		var fechaFin = new Date(fechaInicio.getTime() + <?php echo $Evaluaciones['tiempo_limite']; ?> * 60000); // Tiempo límite en minutos en milisegundos

		// Función para mostrar el contador
		function mostrarContador() {
			// Obtener la fecha y hora actual
			var fechaActual = new Date();
			
			// Calcular el tiempo restante en milisegundos
			var tiempoRestante = fechaFin - fechaActual;
			
			// Verificar si se ha alcanzado la fecha de fin
			if (tiempoRestante <= 0) {
				// Se ha alcanzado la fecha de fin, realizar la petición AJAX
				realizarPeticionAJAX();
			} else {
				// Convertir el tiempo restante a minutos y segundos
				var minutos = Math.floor(tiempoRestante / 60000);
				var segundos = Math.floor((tiempoRestante % 60000) / 1000);
				
				// Mostrar el contador en el elemento HTML
				document.getElementById("timer").innerHTML = "Tiempo restante: " + minutos + " min " + segundos + " seg";
				
				// Actualizar el contador cada segundo
				setTimeout(mostrarContador, 1000);
			}
		}

		// Función para realizar la petición AJAX
		function realizarPeticionAJAX() {
			document.getElementById("timer").innerHTML = "Tiempo restante: 0 min 0 seg";
			// Aquí puedes realizar la petición AJAX utilizando la librería de tu elección
			// Por ejemplo, con jQuery:
			$.ajax({
				url: "ajax/ajax.formularios.php",
				type: "POST",
				data: { tiempoTerminado: true },
				success: function(response) {
					// Manejar la respuesta de la petición AJAX
				},
				error: function(xhr, status, error) {
					// Manejar los errores de la petición AJAX
				}
			});
		}

		// Iniciar el contador
		mostrarContador();
	</script>
<?php endif ?>
