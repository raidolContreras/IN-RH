<?php
	$preguntas = ControladorFormularios::ctrVerPreguntasExamen('idExamen', $_GET['evaluacion']);
	$indicesFile = file_get_contents('view/pages/json/indices.json');
	$indice = json_decode($indicesFile, true);
	$i = 1;
?>
<div class="col-12">
	<div class="row">
		<div class="col-xl-9 col-md-8 col-12 order-2 order-xl-1">
			<div class="row" style="font-family: 'Arial';">
				<?php foreach ($preguntas as $pregunta): ?>
				<div class="col-xl-3 p-3">
					<div class="card" style="border-radius: 10px;">
						<div
							class="card-header"
							style="border-radius: 10px; box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.1);">
							<?php echo "Pregunta ".$i; ?>
						</div>
						<div class="card-body" id="response1" style="font-size:11px">Sin responder aún</div>
					</div>
				</div>
				<div class="col-xl-9 p-3">
					<div class="card" style="border-radius: 10px;">
						<div class="card-header" style="border-radius: 10px; box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.1);">
							<?php echo $pregunta['pregunta']; ?>
						</div>
						<div class="card-body">
							<?php 
								if ($pregunta['tipo_pregunta'] == 'abierta') {
									echo 'Escribe la respuesta:';
								}else{
									echo 'Seleccione una:';
								}
							?>
							<form id="pregunta<?php echo $pregunta['idPregunta'] ?>"
										class="ml-2">
								<?php
									$respuestas = ControladorFormularios::ctrVerRespuestasExamen('idPregunta', $pregunta['idPregunta']);
									if ($pregunta['tipo_pregunta'] == 'opcion_multiple'){
										$a = 0;
										foreach ($respuestas as $respuesta) {
											echo '<div class="row">
															<label class="custom-control custom-radio">
																<input type="radio" class="custom-control-input" name="r'.$i.'" value="'.$respuesta['respuesta'].'">
																<span class="custom-control-label">
																	'.$indice['indices'][$a].'. '.$respuesta['respuesta'].'
																</span>
															</label>
														</div>';
											$a++;
										}
									}elseif ($pregunta['tipo_pregunta'] == 'escala') {
										$a = 0;

										$escalaFile = file_get_contents('view/pages/json/escalas.json');
										$escala = json_decode($escalaFile, true);

										foreach ($respuestas as $respuesta) {

											$opciones = $escala[$respuesta['valor']];

											foreach ($opciones as $opcion) {
												echo '<div class="row">
																<label class="custom-control custom-radio">
																	<input type="radio" class="custom-control-input" name="r'.$i.'" value="'.$a.'">
																	<span class="custom-control-label">
																		'.$indice['indices'][$a].'. '.$opcion.'
																	</span>
																</label>
															</div>';
												$a++;
											}
										}
									}elseif ($pregunta['tipo_pregunta'] == 'abierta') {
										echo '<div class="row">
														<input type="text" class="form-control" name="r'.$i.'" value="">
													</div>';
										$a++;
									}
								?>
							</form>
						</div>
					</div>
				</div>
				<?php $i++; endforeach ?>
			</div>

				<div class="row float-right">
					<button class="btn btn-primary rounded btn-block">Terminar examen</button>
				</div>

		</div>
		<div class="col-xl-3 col-md-4 col-12 p-3 order-xl-2 order-1">
			<div class="card">
			<div class="card-header mx-1" id="timer" style="font-size:12px"></div>
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
				url: "tupeticion.php",
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
