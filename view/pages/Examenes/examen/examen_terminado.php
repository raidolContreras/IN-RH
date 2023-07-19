<?php
$preguntas = ControladorFormularios::ctrVerPreguntasExamen('idExamen', $_GET['verExamen']);
$indicesFile = file_get_contents('view/pages/json/indices.json');
$indice = json_decode($indicesFile, true);
$escalaFile = file_get_contents('view/pages/json/escalas.json');
$escala = json_decode($escalaFile, true);
$i = 1;
$preg_totales = 0;
$correctas = 0;
$datos = array(
	"idExamen" => $_GET['verExamen'],
	"idEmpleado" => $_SESSION['idEmpleado']
);
$datosEvaluacion = ModeloFormularios::mdlBuscarEvaluacionAsignada($datos);
$tiempoT = ControladorFormularios::ctrFormatearMes($datosEvaluacion['fecha_inicio']);
$tiempoF = ControladorFormularios::ctrFormatearMes($datosEvaluacion['fecha_fin']);
$tiempoE = ControladorFormularios::ctrFormatearTiempo($datosEvaluacion['tiempo_utilizado']);
?>

<div class="col-12">
	<div class="row">
		<div class="col-12 order-2">
			<div class="row" style="font-family: 'Arial';">
				<?php foreach ($preguntas as $pregunta):
					$datos = array(
						"idPregunta" => $pregunta['idPregunta'],
						"idExamen" => $_GET['verExamen'],
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
									<form class="ml-2">
										<div class="row">
											<input type="text" class="form-control" value="<?php echo $buscarRespuesta; ?>" disabled>
										</div>
									</form>

								<?php elseif ($pregunta['tipo_pregunta'] == 'opcion_multiple'): $preg_totales++; ?>
									<p>Seleccione una:</p>
									<form class="ml-2">
										<?php $a = 0; ?>
										<?php foreach (ControladorFormularios::ctrVerRespuestasExamen('idPregunta', $pregunta['idPregunta']) as $respuesta): ?>
											<div class="row">
												<label class="custom-control custom-radio">
													<?php if ($buscarRespuesta == $respuesta['respuesta']): ?>
													<input type="radio" class="custom-control-input" checked disabled>
													<span class="custom-control-label">

														<?php if ($respuesta['valor'] == 1): ?>
															<?php echo $indice['indices'][$a].'. '.$respuesta['respuesta']; 
															$correctas++; ?>
															<span style="color: green;"><i class="fas fa-check"></i></span>
														<?php else: ?>
															<?php echo $indice['indices'][$a].'. '.$respuesta['respuesta'] ?>
															<span style="color: red;"><i class="fas fa-times"></i></span>
														<?php endif ?>
													</span>
													<?php else: ?>
													<input type="radio" class="custom-control-input" disabled>
													<span class="custom-control-label">
														<?php echo $indice['indices'][$a].'. '.$respuesta['respuesta'] ?>
													</span>
													<?php endif ?>
												</label>
											</div>
											<?php $a++; ?>
										<?php endforeach ?>
									</form>

								<?php elseif ($pregunta['tipo_pregunta'] == 'escala'): ?>
									<p>Seleccione una:</p>
									<form class="ml-2">
										<?php $a = 0; ?>
										<?php foreach (ControladorFormularios::ctrVerRespuestasExamen('idPregunta', $pregunta['idPregunta']) as $respuesta): ?>
											<?php $opciones = $escala[$respuesta['valor']]; ?>
											<?php foreach ($opciones as $key => $opcion): ?>
												<div class="row">
													<label class="custom-control custom-radio">
														<?php if ($buscarRespuesta == $key): ?>
														<input type="radio" class="custom-control-input" checked disabled>
														<span class="custom-control-label">
															<?php echo $indice['indices'][$a].'. '.$opcion ?>

															<?php if ($respuesta['respuesta'] == 'binario'): $preg_totales++; ?>
																<?php if ($respuesta['valor'] == $key && $respuesta['respuesta'] == 'binario'): 
																$correctas++; ?>
																	<span style="color: green;">
																		<i class="fas fa-check"></i>
																	</span>
																<?php else: ?>
																	<span style="color: red;">
																		<i class="fas fa-times"></i>
																	</span>
																<?php endif ?>
															<?php endif ?>

														</span>
														<?php else: ?>
															<input type="radio" class="custom-control-input" disabled>
															<span class="custom-control-label">
																<?php echo $indice['indices'][$a].'. '.$opcion ?>
															</span>
														<?php endif ?>
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
				<a href="Evaluaciones_Asignadas" class="btn btn-primary rounded btn-block mx-3" id="terminar-examen-btn">Terminar revisión</a>
			</div>
		</div>

		<div class="col-12 order-1 ">
			<div class="card mx-3" style="border-radius: 10px;">
				<div class="card-body" id="timer" style="font-size:12px">
					<div class="table-responsive">
						<table class="table">
							<tr>
								<td width='150'>Comenzado en:</td>
								<td><?php echo $tiempoT; ?></td>
							</tr>
							<tr>
								<td>Estado:</td>
								<td>Terminado</td>
							</tr>
							<tr>
								<td>Finalizado en:</td>
								<td><?php echo $tiempoF; ?></td>
							</tr>
							<tr>
								<td>Tiempo empleado:</td>
								<td><?php echo $tiempoE; ?></td>
							</tr>
							<tr>
								<td>Calificación:</td>
								<td><?php echo $correctas.'/'.$preg_totales; ?></td>
							</tr>
							<tr>
								<td>Calificación:</td>
								<td><?php echo ControladorFormularios::calcularCalificacion($correctas, $preg_totales); ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

