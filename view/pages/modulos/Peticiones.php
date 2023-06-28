<?php
$peticiones = ControladorFormularios::ctrVerPeticiones($_SESSION['idEmpleado']);
$peticionesDepartamentales = ControladorFormularios::ctrVerPeticionesDepartamentales($_SESSION['idEmpleado']);
$departamento = ControladorFormularios::ctrVerDepartamentos('Empleados_idEmpleados',$_SESSION['idEmpleado']);
$puestos = ControladorFormularios::ctrVerPuestos(null,null);

$pertenencias = ControladorEmpleados::ctrEquipoDeTrabajo($departamento['idDepartamentos']);
$empleados = array();
foreach ($pertenencias as $value) {
	if ($value['idEmpleados'] == $value['jefeDepa']) {
		$empleados[] = $value['idEmpleados'];
	}
}
foreach ($puestos as $puesto) {
	if ($puesto['Departamentos_idDepartamentos'] == $departamento['idDepartamentos'] && $_SESSION['idEmpleado'] != $puesto[4]) {
		$empleados[] = ($puesto[4]);
	}
}
?>

<p class="titulo-tablero titulo">Solicitudes pendientes</p>
<div class="row">
	<div class="mx-3 mt-2 pb-0 table-responsive">
		<table id="example" class="table Peticiones table-hover">
			<thead>
				<tr>
					<th width="20%">Nombre</th>
					<th width="35%">Comentario</th>
					<th width="20%">Horario</th>
					<th> 	 </th>
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
										<div class="row" style="margin-left: -15px; margin-right: -5px;">
											<form id="approve-form-<?php echo $peticion['idJustificantes']; ?>" class="col">
												<input type="hidden" name="aprobarJustificacion" value="<?php echo $peticion['idJustificantes']; ?>">
												<button type="button" class="btn btn-outline-success btn-rounded approve-btn" data-id="<?php echo $peticion['idJustificantes']; ?>">
													<i class="fas fa-check"></i>
												</button>
											</form>
											<form id="decline-form-<?php echo $peticion['idJustificantes']; ?>" class="col">
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
										<div class="row" style="margin-left: -15px; margin-right: -5px;">
											<form id="approve-form-<?php echo $peticion['idJustificantes']; ?>" class="col">
												<input type="hidden" name="aprobarJustificacion" value="<?php echo $peticion['idJustificantes']; ?>">
												<button type="button" class="btn btn-outline-success btn-rounded approve-btn" data-id="<?php echo $peticion['idJustificantes']; ?>">
													<i class="fas fa-check"></i>
												</button>
											</form>
											<form id="decline-form-<?php echo $peticion['idJustificantes']; ?>" class="col">
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

				<?php foreach ($empleados as $value): ?>
					<?php
						$empleado = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $value);
						$vacaciones = ControladorFormularios::ctrVerSolicitudesVacaciones($value);
					?>

					<?php foreach ($vacaciones as $vacacion): ?>

					<?php if ($vacacion[12] != null): ?>
						<?php if ($vacacion['respuesta'] == null): ?>
							<?php if ($vacacion['status_vacaciones'] == 1): ?>
						<tr>
							<td><?php echo $empleado['lastname']." ".$empleado['name']; ?></td>
							<td>Solicitud de vacaciones</td>
							<td><?php echo $vacacion[12]; ?></td>
							<td>
								<div class="row" style="margin-left: -15px; margin-right: -5px;">
									<form id="approve-form-<?php echo $vacacion['idVacaciones']; ?>" class="col">
										<input type="hidden" name="aprobarVacaciones" value="<?php echo $vacacion['idVacaciones']; ?>">
										<button type="button" class="btn btn-outline-success btn-rounded approve-btn" data-id="<?php echo $vacacion['idVacaciones']; ?>">
											<i class="fas fa-check"></i>
										</button>
									</form>
									<form id="decline-form-<?php echo $vacacion['idVacaciones']; ?>" class="col">
										<input type="hidden" name="declinarVacaciones" value="<?php echo $vacacion['idVacaciones']; ?>">
										<button type="button" class="btn btn-outline-danger btn-rounded decline-btn" data-id="<?php echo $vacacion['idVacaciones']; ?>">
											<i class="fas fa-times"></i>
										</button>
									</form>
								</div>
							</td>
						</tr>
							<?php endif ?>
						<?php endif ?>
					<?php endif ?>
						
					<?php endforeach ?>
				<?php endforeach ?>

				<?php foreach ($empleados as $value): ?>
					<?php
						$empleado = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $value);
						$empleados_has_permisos = ControladorFormularios::ctrVerSolicutudesPermisosEmpleados($value);
					?>
					<?php if (!empty($empleados_has_permisos)): ?>
						<?php foreach ($empleados_has_permisos as $emPermiso): ?>
							<?php if ($emPermiso['statusPermiso'] == null): ?>
								
							<tr>
								<td><?php echo $empleado['lastname']." ".$empleado['name']; ?></td>
								<td><?php echo $emPermiso['descripcion']." (".$emPermiso['permiso'].")"; ?></td>
								<td><?php echo $emPermiso['rango']; ?></td>
								<td>
									<div class="row" style="margin-left: -15px; margin-right: -5px;">
										<form id="approve-form-<?php echo $emPermiso['idPermiso']; ?>" class="col">
											<input type="hidden" name="aprobarPermiso" value="<?php echo $emPermiso['idPermiso']; ?>">
											<button type="button" class="btn btn-outline-success btn-rounded approve-btn" data-id="<?php echo $emPermiso['idPermiso']; ?>">
												<i class="fas fa-check"></i>
											</button>
										</form>
										<form id="decline-form-<?php echo $emPermiso['idPermiso']; ?>" class="col">
											<input type="hidden" name="declinarPermiso" value="<?php echo $emPermiso['idPermiso']; ?>">
											<button type="button" class="btn btn-outline-danger btn-rounded decline-btn" data-id="<?php echo $emPermiso['idPermiso']; ?>">
												<i class="fas fa-times"></i>
											</button>
										</form>
									</div>
								</td>
							</tr>

							<?php endif ?>
							
						<?php endforeach ?>
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
						$("#form-result").val("");
						$("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
						  <i class="fas fa-check-circle"></i>
						  Solicitud Aprobada Exitosamente
						</div>
						`);
						deleteAlert();

						setTimeout(function() {
							location.reload();
						}, 1700);
					} else {
						$("#form-result").val("");
						$("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
						  <i class="fas fa-exclamation-triangle"></i>
						  <b>Error</b>, no se pudo aprobar la solicitud, intenta nuevamente
						</div>
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
						$("#form-result").val("");
						$("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
						  <i class="fas fa-check-circle"></i>
						  Solicitud Rechazada Correctamente</div>
						`);
						deleteAlert();

						setTimeout(function() {
							location.reload();
						}, 1700);
					} else {
						$("#form-result").val("");
						$("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
						  <i class="fas fa-exclamation-triangle"></i>
						  <b>Error</b>, no se pudo rechazar la solicitud, intenta nuevamente</div>
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
		}
	});
</script>
