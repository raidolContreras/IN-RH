<?php
$peticiones = ControladorFormularios::ctrVerPeticiones($_SESSION['idEmpleado']);
$peticionesDepartamentales = ControladorFormularios::ctrVerPeticionesDepartamentales($_SESSION['idEmpleado']);
?>

<p class="titulo-tablero titulo">Peticiones de asistencia</p>
<div class="row">
	<div class="mx-3 mt-2 pb-0 table-responsive">
		<table id="example" class="table Peticiones table-hover">
			<thead>
				<tr>
					<th width="20%">Nombre</th>
					<th>Comentario</th>
					<th width="20%">Horario</th>
					<th width="10%"></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($peticiones as $peticion): ?>
					<?php if ($peticion['Empleados_idEmpleados'] != $_SESSION['idEmpleado']): ?>
						<?php if ($peticion['status_justificante'] == null): ?>
						<?php
						$empleado = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $peticion['Empleados_idEmpleados']);
						$asistencia = ControladorFormularios::ctrVerAsistencia("idAsistencias", $peticion['Asistencias_idAsistencias']);

						$status = ($asistencia['entrada'] == "00:00:00") ? "Ausencia" : " (".$asistencia['entrada']." - ".$asistencia['salida'].")";

						?>
							<tr>
								<td><?php echo $empleado['lastname']." ".$empleado['name']; ?></td>
								<td><?php echo $peticion['Comentario']; ?></td>
								<td><?php echo date("d/m/Y", strtotime($asistencia['fecha_asistencia'])).$status; ?></td>
								<td>
									<?php if ($peticion['status_justificante'] == null): ?>
										<div class="row">
											<form id="approve-form-<?php echo $peticion['idJustificantes']; ?>" class="col-6">
												<input type="hidden" name="aprobarJustificacion" value="<?php echo $peticion['idJustificantes']; ?>">
												<button type="button" class="btn btn-outline-success btn-rounded approve-btn" data-id="<?php echo $peticion['idJustificantes']; ?>">
													<i class="fas fa-check"></i>
												</button>
											</form>
											<form id="decline-form-<?php echo $peticion['idJustificantes']; ?>" class="col-6">
												<input type="hidden" name="declinarJustificacion" value="<?php echo $peticion['idJustificantes']; ?>">
												<button type="button" class="btn btn-outline-danger btn-rounded decline-btn" data-id="<?php echo $peticion['idJustificantes']; ?>">
													<i class="fas fa-times"></i>
												</button>
											</form>
										</div>
									<?php endif ?>
								</td>
							</tr>
						<?php endif ?>
					<?php endif ?>
				<?php endforeach ?>

				<?php foreach ($peticionesDepartamentales as $peticion): ?>
					<?php if ($peticion['Empleados_idEmpleados'] != $_SESSION['idEmpleado']): ?>
						<?php if ($peticion['status_justificante'] == null): ?>
							<?php
							$empleado = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $peticion['Empleados_idEmpleados']);
							$asistencia = ControladorFormularios::ctrVerAsistencia("idAsistencias", $peticion['Asistencias_idAsistencias']);
							?>
							<tr>
								<td><?php echo $empleado['lastname']." ".$empleado['name']; ?></td>
								<td><?php echo $peticion['Comentario']; ?></td>
								<td><?php echo date("d/m/Y", strtotime($asistencia['fecha_asistencia']))." (".$asistencia['entrada']." - ".$asistencia['salida'].")"; ?></td>
								<td>
									<?php if ($peticion['status_justificante'] == null): ?>
										<div class="row">
											<form id="approve-form-<?php echo $peticion['idJustificantes']; ?>" class="col-6">
												<input type="hidden" name="aprobarJustificacion" value="<?php echo $peticion['idJustificantes']; ?>">
												<button type="button" class="btn btn-outline-success btn-rounded approve-btn" data-id="<?php echo $peticion['idJustificantes']; ?>">
													<i class="fas fa-check"></i>
												</button>
											</form>
											<form id="decline-form-<?php echo $peticion['idJustificantes']; ?>" class="col-6">
												<input type="hidden" name="declinarJustificacion" value="<?php echo $peticion['idJustificantes']; ?>">
												<button type="button" class="btn btn-outline-danger btn-rounded decline-btn" data-id="<?php echo $peticion['idJustificantes']; ?>">
													<i class="fas fa-times"></i>
												</button>
											</form>
										</div>
									<?php endif ?>
								</td>
							</tr>
						<?php endif ?>
					<?php endif ?>
				<?php endforeach ?>

			</tbody>
		</table>
	</div>
</div>

<script>
	$(document).ready(function() {
		$(".approve-btn").click(function() {
			var formId = $(this).closest('form').attr('id');
			var value = $("#" + formId).serialize(); // Obtener los datos del formulario

			$.ajax({
				url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
				type: "POST",
				data: value,
				success: function(response) {
					if (response === '"ok"') {
						$("#justify-result").val("");
						$("#justify-result").html(`
							<div class='alert alert-success' role="alert" id="alerta">Asistencia justificada</div>
						`);
						deleteAlert();
					} else {
						$("#justify-result").val("");
						$("#justify-result").html(`
							<div class='alert alert-danger' role="alert" id="alerta"><b>Error</b>, no se pudo justificar la asistencia, intenta nuevamente</div>
						`);
						deleteAlert();
					}
				}
			});
		});

		$(".decline-btn").click(function() {
			var formId = $(this).closest('form').attr('id');
			var value = $("#" + formId).serialize(); // Obtener los datos del formulario

			$.ajax({
				url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
				type: "POST",
				data: value,
				success: function(response) {
					if (response === '"ok"') {
						$("#justify-result").val("");
						$("#justify-result").html(`
							<div class='alert alert-success' role="alert" id="alerta">Asistencia Rechazada</div>
						`);
						deleteAlert();
					} else {
						$("#justify-result").val("");
						$("#justify-result").html(`
							<div class='alert alert-danger' role="alert" id="alerta"><b>Error</b>, no se pudo rechazar la asistencia, intenta nuevamente</div>
						`);
						deleteAlert();
					}
				}
			});
		});

		function deleteAlert() {
			setTimeout(function() {
				var alert = $('#alerta');
				alert.fadeOut('slow', function() {
					alert.remove();
				});
			}, 1500);

			setTimeout(function() {
				location.reload();
			}, 1700);
		}
	});
</script>
