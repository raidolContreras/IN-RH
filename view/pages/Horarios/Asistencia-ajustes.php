<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="assets/vendor/multi-select/css/multi-select.css">
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="card mx-5 menu-ajustes">
			<div class="card-header encabezado">Configuración del registro de horas</div>
			<div class="row">
				<div class="card-side-nav col-xl-2 col-lg-3 col-md-4 col-3 lista-ajustes">
					<div><a href="Asistencia-ajustes" class="btn btn-block btn-in-consulting-link active">Horarios de trabajo</a></div>
					<div><a href="Asistencia-permisos" class="btn btn-block btn-in-consulting-link">Permisos</a></div>
					<div><a href="Asistencia-importar" class="btn btn-block btn-in-consulting-link">Importar horarios</a></div>
				</div>
				<div class=" col-xl-10 col-lg-9 col-md-8 col-9" id="horarios">
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
							<div id="form-result" class="float-right"></div>
							<div>
								<table class="table">
									<caption>Lista de Horarios</caption>
									<thead>
										<tr>
											<th scope="col">Nombre de la plantilla</th>
											<th scope="col">Horas semanales</th>
											<th scope="col">Horario por defecto</th>
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
												<td>
													<button type="button" 
													class="btn btn-in-consulting" 
													data-toggle="modal" 
													data-target="#Horario<?php echo $horario['idHorarios'] ?>">
													<span><?php echo $horario['nameHorario'] ?></span>
												</button>
										</td>
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
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<script>
				function cambio(id) {

					$.ajax({
						url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
						type: "POST",
						data: { id: id },
						success: function(response) {
	    				$("#form-result").empty();
							if (response === '"ok"') {
								$("#form-result").html("");
								$("#form-result").parent().after(`
									<div class='alert alert-success' role="alert" id="alerta">Horario predeterminado actualizado</div>
									`);
								deleteAlert();
							} else {
								$("#form-result").html("");
								$("#form-result").parent().after(`
									<div class='alert alert-danger' role="alert" id="alerta"><b>Error</b>, no se pudo cambiar el horario predeterminado, intenta nuevamente</div>
									`);
								deleteAlert();
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

<?php foreach ($horarios as $horario): ?>
<?php $diasLaborables = ControladorFormularios::ctrSeleccionarHorarios("Horarios_idHorarios", $horario['idHorarios']); 

$diaLaborableNombres = [
    1 => "Lunes",
    2 => "Martes",
    3 => "Miércoles",
    4 => "Jueves",
    5 => "Viernes",
    6 => "Sábado",
    0 => "Domingo"
];
?>
	<div class="modal fade" id="Horario<?php echo $horario['idHorarios'] ?>">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="ml-2 mt-3"><?php echo $horario['nameHorario'] ?></h3>
					<div>

						<?php if ($horario['default'] != 1): ?>
						<a class="btn btn-in-consulting-danger" href="CrearHorario&eliminar=<?php echo $horario['idHorarios'] ?>">
							<i class="fa fa-trash"></i>
						</a>
						<?php endif ?>
						<a class="btn btn-in-consulting" href="CrearHorario&plantilla=<?php echo $horario['idHorarios'] ?>">
							<i class="fas fa-edit"></i>
						</a>
					</div>
				</div>
				<div class="modal-body">
					<div class="card">
						<div class="card-header">
							<table class="table">
								<thead>
									<tr>
										<th width="25%">Días</th>
										<th width="50%">Horario de trabajo</th>
										<th width="25%">Horas esperadas</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($diasLaborables as $diaLaborable): ?>
									<tr>
										<th>
											<?php 
												echo $diaLaborableNombres[$diaLaborable['dia_Laborable']];
											?>
										</th>
										<td>
											<?php echo $diaLaborable['hora_Entrada']." a ".$diaLaborable['hora_Salida'] ?>
										</td>
										<td><?php

											$horas = floor($diaLaborable['numero_Horas']);
											$minutos = floor(($diaLaborable['numero_Horas'] - $horas) * 60);
											$resultado = $horas . " horas " . $minutos . " min"; 
											echo $resultado ?>
										</td>
									</tr>
									<?php endforeach ?>
								</tbody>
								<tfoot>
									<?php 
										$horas = floor($horario['SUM(dh.numero_Horas)']);
										$minutos = floor(($horario['SUM(dh.numero_Horas)'] - $horas) * 60);
										$resultado = $horas . " horas " . $minutos . " min"; 
									?>
									<tr>
										<td colspan="2"><b>Total de horas:</b></td>
										<td style="display: none;"></td>
										<td colspan="1" style=""><?php echo $resultado ?></td>
									</tr>
								</tfoot>
							</table>
						</div>
						<?php if ($horario['default'] != 1): ?>
						<div class="card-body">
							<form class="mb-3" id="empleado-horario-form<?php echo $horario['idHorarios'] ?>">
							  <?php $empleados = ControladorEmpleados::ctrVerEmpleados(null,null); ?>
							  <?php $empleadosHorarios = ControladorFormularios::ctrVerEmpleadosHorarios("Horarios_idHorarios", $horario['idHorarios']); ?>
							  <select id='pre-selected-options' multiple='multiple' name='empleados_has_horarios[]'>
							    <?php foreach ($empleados as $empleado): ?>
							      <?php $selected = false; ?>
							      <?php if (!empty($empleadosHorarios[0])): ?>
							        <?php foreach ($empleadosHorarios as $empleadoHorario): ?>
							          <?php if ($empleadoHorario['Empleados_idEmpleados'] == $empleado['idEmpleados']): ?>
							            <?php $selected = true; ?>
							          <?php endif ?>
							        <?php endforeach ?>
							      <?php endif ?>
							      <?php if ($selected): ?>
							        <option value='<?php echo $empleado['idEmpleados']; ?>' selected><?php echo $empleado['name']." ".$empleado['lastname']; ?></option>
							      <?php else: ?>
							        <option value='<?php echo $empleado['idEmpleados']; ?>'><?php echo $empleado['name']." ".$empleado['lastname']; ?></option>
							      <?php endif ?>
							    <?php endforeach ?>
							  </select>
							  <input type="hidden" name="horario" value="<?php echo $horario['idHorarios'] ?>">
							</form>
						</div>
						<div class="card-footer p-0 text-center d-flex justify-content-center">
							<div class="card-footer-item card-footer-item-bordered">
								<div class="row">
									<div class="col-6">
										<button data-dismiss="modal" class="card-link btn btn-outline-secondary btn-block">Cerrar</button>
									</div>
									<div class="col-6">
										<button class="card-link btn btn-outline-primary btn-block"
														type="button"
														id="empleado-horario-btn<?php echo $horario['idHorarios'] ?>"
														data-dismiss="modal">
											Actualizar lista
										</button>
									</div>
								</div>
							</div>
						</div>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>

		$(document).ready(function() {
			$("#empleado-horario-btn<?php echo $horario['idHorarios'] ?>").click(function() {
				var formData = $("#empleado-horario-form<?php echo $horario['idHorarios'] ?>").serialize(); // Obtener los datos del formulario
				$.ajax({
					url: "ajax/horarios.php", // Ruta al archivo PHP que procesará los datos del formulario
					type: "POST",
					data: formData,
					success: function(response) {
						if (response === '"cambio"') {
							$("#form-result").val("");
							$("#form-result").parent().after(`
								<div class='alert alert-success' role="alert" id="alerta">Horarios de empleados actualizados</div>
								`);
							deleteAlert();
						}else if (response === '"eliminado"') {
							$("#form-result").val("");
							$("#form-result").parent().after(`
								<div class='alert alert-warning' role="alert" id="alerta">Plantilla de horarios vacia</div>
								`);
							deleteAlert();
						}else{
							$("#form-result").val("");
							$("#form-result").parent().after(`
								<div class='alert alert-danger' role="alert" id="alerta"><b>Error</b>, No se pudo actualizar los horarios de los empleados, intenta nuevamente</div>
								`);
							deleteAlert();
						}
					}
				});
			});
		});

	</script>
<?php endforeach ?>
<script src="assets/vendor/multi-select/js/jquery.multi-select.js"></script>
<script>
	$('#my-select, #pre-selected-options').multiSelect({
	  selectableHeader: "<div class='card-header'>Fuera de plantilla</div>",
	  selectionHeader: "<div class='card-header'>Dentro de plantilla</div>"
	});

function deleteAlert() {
  setTimeout(function() {
    var alert = $('#alerta');
    alert.fadeOut('slow', function() {
      alert.remove();
    });
  }, 1500);
}

</script>