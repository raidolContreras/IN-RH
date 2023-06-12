<?php $peticiones = ControladorFormularios::ctrVerPeticiones($_SESSION['idEmpleado']); ?>
<?php $peticionesDepartamentales = ControladorFormularios::ctrVerPeticionesDepartamentales($_SESSION['idEmpleado']); ?>

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
						<?php $empleado = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $peticion['Empleados_idEmpleados']) ?>
						<?php $asistencia = ControladorFormularios::ctrVerAsistencia("idAsistencias", $peticion['Asistencias_idAsistencias']) ?>
						<tr>
							<td><?php echo $empleado['lastname']." ".$empleado['name']; ?></td>
							<td><?php echo $peticion['Comentario']; ?></td>
							<td><?php echo date("d/m/Y", strtotime($asistencia['fecha_asistencia']))." (".$asistencia['entrada']." - ".$asistencia['salida'].")"; ?></td>
							<td>
								<?php if ($peticion['status_justificante'] == Null): ?>
									<div class="row">
										<form id="approve-form" class="col">
											<input type="hidden" name="aprobarJustificacion" value="<?php echo $peticion['idJustificantes']; ?>">
											<button type="button" class="btn btn-outline-success btn-rounded" id="approve-btn<?php echo $peticion['idJustificantes']; ?>">
												<i class="fas fa-check"></i>
											</button>
										</form>
										<form id="decline-form" class="col">
											<input type="hidden" name="declinarJustificacion" value="<?php echo $peticion['idJustificantes']; ?>">
											<button type="button" class="btn btn-outline-danger btn-rounded" id="decline-btn<?php echo $peticion['idJustificantes']; ?>">
												<i class="fas fa-times"></i>
											</button>
										</form>
									</div>
								<?php else: $status = ($peticion['status_justificante'] == 1) ? ' class="badge badge-success">Aprobado' : ' class="badge badge-danger">Rechazado'; ?>
									<p<?php echo $status; ?></p>
								<?php endif ?>
							</td>
						</tr>
					<?php endif ?>
				<?php endforeach ?>
				<?php foreach ($peticionesDepartamentales as $peticion): ?>
					<?php if ($peticion['Empleados_idEmpleados'] != $_SESSION['idEmpleado']): ?>
						<?php $empleado = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $peticion['Empleados_idEmpleados']) ?>
						<?php $asistencia = ControladorFormularios::ctrVerAsistencia("idAsistencias", $peticion['Asistencias_idAsistencias']) ?>
						<tr>
							<td><?php echo $empleado['lastname']." ".$empleado['name']; ?></td>
							<td><?php echo $peticion['Comentario']; ?></td>
							<td><?php echo date("d/m/Y", strtotime($asistencia['fecha_asistencia']))." (".$asistencia['entrada']." - ".$asistencia['salida'].")"; ?></td>
							<td>
								<?php if ($peticion['status_justificante'] == Null): ?>
									<div class="row">
										<form id="approve-form" class="col">
											<input type="hidden" name="aprobarJustificacion" value="" value="<?php echo $peticion['idJustificantes']; ?>">
											<button type="button" class="btn btn-outline-success btn-rounded" id="approve-btn<?php echo $peticion['idJustificantes']; ?>">
												<i class="fas fa-check"></i>
											</button>
										</form>
										<form id="decline-form" class="col">
											<input type="hidden" name="declinarJustificacion" value="<?php echo $peticion['idJustificantes']; ?>">
											<button type="button" class="btn btn-outline-danger btn-rounded" id="decline-btn<?php echo $peticion['idJustificantes']; ?>">
												<i class="fas fa-times"></i>
											</button>
										</form>
									</div>
								<?php else: $status = ($peticion['status_justificante'] == 1) ? ' class="badge badge-success">Aprobado' : ' class="badge badge-danger">Rechazado'; ?>
									<p<?php echo $status; ?></p>
								<?php endif ?>
							</td>
						</tr>
					<?php endif ?>
				<?php endforeach ?>

			</tbody>
		</table>

	</div>
</div>

<?php foreach ($peticiones as $peticion): ?>
<script>
		$(document).ready(function() {
		$("#approve-btn<?php echo $peticion['idJustificantes']; ?>").click(function() {
		var value = $("#approve-form<?php echo $peticion['idJustificantes']; ?>").serialize(); // Obtener los datos del formulario

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
					}else{
						$("#justify-result").val("");
						$("#justify-result").html(`
							<div class='alert alert-danger' role="alert" id="alerta"><b>Error</b>, no se pudo justificar la asistencia, intenta nuevamente</div>
							`);
						deleteAlert();
					}

				}
			});
		});
	});


	$(document).ready(function() {
		$("#decline-btn<?php echo $peticion['idJustificantes']; ?>").click(function() {
		var value = $("#decline-form<?php echo $peticion['idJustificantes']; ?>").serialize(); // Obtener los datos del formulario

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
					}else{
						$("#justify-result").val("");
						$("#justify-result").html(`
							<div class='alert alert-danger' role="alert" id="alerta"><b>Error</b>, no se pudo rechazar la asistencia, intenta nuevamente</div>
							`);
						deleteAlert();
					}

				}
			});
		});
	});

</script>
<?php endforeach ?>.

<?php foreach ($peticionesDepartamentales as $peticion): ?>
<script>
		$(document).ready(function() {
		$("#approve-btn<?php echo $peticion['idJustificantes']; ?>").click(function() {
		var value = $("#approve-form<?php echo $peticion['idJustificantes']; ?>").serialize(); // Obtener los datos del formulario

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
					}else{
						$("#justify-result").val("");
						$("#justify-result").html(`
							<div class='alert alert-danger' role="alert" id="alerta"><b>Error</b>, no se pudo justificar la asistencia, intenta nuevamente</div>
							`);
						deleteAlert();
					}

				}
			});
		});
	});


	$(document).ready(function() {
		$("#decline-btn<?php echo $peticion['idJustificantes']; ?>").click(function() {
		var value = $("#decline-form<?php echo $peticion['idJustificantes']; ?>").serialize(); // Obtener los datos del formulario

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
					}else{
						$("#justify-result").val("");
						$("#justify-result").html(`
							<div class='alert alert-danger' role="alert" id="alerta"><b>Error</b>, no se pudo rechazar la asistencia, intenta nuevamente</div>
							`);
						deleteAlert();
					}

				}
			});
		});
	});

</script>
<?php endforeach ?>
<script>
function deleteAlert() {
  setTimeout(function() {
    var alert = $('#alerta');
    alert.fadeOut('slow', function() {
      alert.remove();
    });
  }, 1500);
}
</script>