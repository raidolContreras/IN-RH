<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="card mx-5">
			<div class="card-header encabezado">Configuración del registro de horas</div>
			<div class="row">
				<div class="card-side-nav col-2 lista-ajustes">
					<div><a href="Asistencia-ajustes" class="btn btn-block btn-in-consulting-link active">Horarios de trabajo</a></div>
					<div><a href="Asistencia-importar" class="btn btn-block btn-in-consulting-link">Importar horarios</a></div>
					<div><a href="Asistencia-exportar" class="btn btn-block btn-in-consulting-link">Exportar resultados</a></div>
				</div>
				<div class="col-10" id="horarios">
					<?php
					$horarios = ControladorFormularios::ctrSeleccionarHorarios(null, null); ?>
					<div class="row mr-4 ml-2 mt-3">
						<div class="card-header encabezado">
							Horarios de trabajo
						</div>
						<div class="card-body">
							<h3 class="encabezado-h">Plantillas de horario de trabajo</h3>
							<p class="ajustes-text">A continuación encontrarás una lista de plantillas de horario que puedes asignar a los empleados. También puedes guardar una plantilla y mantenerla en el sistema, sin asignársela a nadie.</p>

							<a class="btn btn-in-consulting" href="CrearHorario">
								<i class="fas fa-plus-circle"></i> <span>Crear plantilla</span>
							</a>

							<div>
								<div id="form-result"></div>
								<table class="table">
								<caption>Lista de Horarios</caption>
									<thead>
										<tr>
											<th scope="col">Nombre de la plantilla</th>
											<th scope="col">Horas semanales</th>
											<th scope="col">Horario por defecto</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($horarios as $horario): ?>
											<?php 
												$horas = floor($horario['SUM(dh.numero_Horas)']);
												$minutos = floor(($horario['SUM(dh.numero_Horas)'] - $horas) * 60);
												$resultado = $horas . " horas " . $minutos . " min"; 
											?>
											<tr>
												<td><?php echo $horario['nameHorario'] ?></td>
												<td><?php echo $resultado; ?></td>
												<td>
													<label class="custom-control custom-radio">
														<?php if ($horario['default'] == 1): ?>
														<input type="radio" 
																id="default" 
																name="default" 
																value="<?php echo $horario['idHorarios'] ?>"
																onchange="cambio(<?php echo $horario['idHorarios'] ?>)" 
																class="custom-control-input" checked>
														<?php else: ?>
														<input type="radio" 
																id="default" 
																name="default" 
																value="<?php echo $horario['idHorarios'] ?>"
																onchange="cambio(<?php echo $horario['idHorarios'] ?>)"
																class="custom-control-input">
														<?php endif ?>
														<span class="custom-control-label"></span>
													</label>
												</td>
												<td></td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

					<script>
						function cambio(id) {
						$.ajax({
							url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
							type: "POST",
							data: { id: id },
							success: function(response) {
							if (response === '"ok"') {
								$("#form-result").html("");
								$("#form-result").parent().after(`
								<div class='alert alert-success'>Horario predeterminado actualizado</div>
								`);
								setTimeout(function() {
								location.reload();
								}, 500);
							} else {
								$("#form-result").html("");
								$("#form-result").parent().after(`
								<div class='alert alert-danger'><b>Error</b>, no se pudo cambiar el horario predeterminado, intenta nuevamente</div>
								`);
							}
							},
							error: function(xhr, status, error) {
							console.log(error);
							}
						});
						}
					</script>
				</div>
			</div>
		</div>
	</div>
</div>