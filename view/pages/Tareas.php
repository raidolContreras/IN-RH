<?php 
	$empresas = ControladorFormularios::ctrVerEmpresas(null,null);
	$empleados = ControladorEmpleados::ctrVerEmpleados(null,null);
	$tareas = ControladorFormularios::ctrVerTareas("Jefe_idEmpleados", $_SESSION['idEmpleado']);
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="row">
			<div class="col-xl-8">
				<div class="card">
					<div class="card-body">
						<p class="titulo-tablero titulo">Lista de Tareas</p>
						<div class="table-responsive">
							<table class="table Extras">
								<thead>
									<tr>
										<th>Nombre de la tarea</th>
										<th>Asignado a</th>
										<th>Vencimiento</th>
										<th>status</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($tareas as $tarea): ?>
										<?php
											$empleado = ControladorEmpleados::ctrVerEmpleados('idEmpleados', $tarea['Empleados_idEmpleados']);
											$statusBadge = '';
											$nombre = mb_strtoupper($empleado['lastname']." ".$empleado['name']);
											
											if ($tarea['status_tarea'] == 0 && $tarea['Vencimiento'] <= date('Y-m-d')) {
												$statusBadge = '<span class="badge badge-danger">Retrasado</span>';
											} elseif ($tarea['status_tarea'] == 0 && $tarea['Vencimiento'] >= date('Y-m-d')) {
												$statusBadge = '<span class="badge badge-dark">Pendiente</span>';
											} elseif ($tarea['status_tarea'] == 1) {
												if ($tarea['fecha_envio'] <= $tarea['Vencimiento']) {
													$statusBadge = '<span class="badge badge-warning">Pendiente de revisar</span>';
												} else {
													$statusBadge = '<span class="badge badge-danger">Pendiente de revisar</span>';
												}
											} elseif ($tarea['status_tarea'] == 2) {
												if ($tarea['fecha_envio'] <= $tarea['Vencimiento']) {
													$statusBadge = '<span class="badge badge-success">Entregado</span>';
												} else {
													$statusBadge = '<span class="badge badge-warning">Entregado</span>';
												}
											} elseif ($tarea['status_tarea'] == 3) {
												$statusBadge = '<span class="badge badge-warning">Incompleto o incorrecto</span>';
											}
										?>

										<tr>
											<td><button type="button" 
													class="btn btn-in-consulting" 
													data-toggle="modal" 
													data-target="#tarea<?php echo $tarea['idTareas'] ?>"
													data-name=<?php echo $nombre; ?>>
													<span><?php echo $tarea['nameTarea'] ?></span>
												</button>
											</td>
											<td><?php echo $nombre; ?></td>
											<td><?php echo date('d/m/Y', strtotime($tarea['Vencimiento'])); ?></td>
											<td><?php echo $statusBadge; ?></td>
										</tr>
									<?php endforeach ?>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4">
				<div class="card p-3">
						<form id="tarea-form">
							<div class="row">
								<div class="col-xl-12">
									<label for="nameTarea">Nombre de la tarea</label>
									<input type="text" id="nameTarea" name="nameTarea" class="form-control" required>
								</div>
								<div class="col-xl-12 mt-2">
									<label for="descripcion">Descripción de la tarea</label>
									<textarea id="descripcion" name="descripcion" class="form-control" required></textarea>
								</div>
								
								<div class="col-xl-12 mt-2">
									<label for="empresa" class="col-form-label font-weight-bold">Empresa:</label>
									<select class="form-control form-control-lg" id="empresa" name="empresasSeleccion" required>
										<option>
											Seleccionar empresa
										</option>
									<?php foreach ($empresas as $empresa): ?>
										<?php if ($empresasSelect['idEmpresas'] == $empresa['idEmpresas']): ?>
										<option value="<?php echo $empresa['idEmpresas']; ?>" selected>
											<?php echo mb_strtoupper($empresa['nombre_razon_social']." (".$empresa['rfc'].")"); ?>
										</option>
										<?php else: ?>
										<option value="<?php echo $empresa['idEmpresas']; ?>">
											<?php echo mb_strtoupper($empresa['nombre_razon_social']." (".$empresa['rfc'].")"); ?>
										</option>
										<?php endif ?>
									<?php endforeach ?>
									</select>
								</div>

								<div class="col-xl-12 mt-2">
									<label for="empleado">Asignado a</label>
									<select type="text" id="empleado" name="empleado" class="form-control" required>
										<option>
											Selecciona una empresa
										</option>
									</select>
								</div>
								<div class="col-xl-12 mt-2">
									<label for="vencimiento">Vencimiento</label>
									<input type="date" id="vencimiento" name="vencimiento" class="form-control" min="<?php echo date('Y-m-d'); ?>" required>
								</div>
							</div>
						</form>
						<div class="col-xl-12 mt-2">
							<button class="btn btn-outline-primary btn-block rounded" id="submit-btn" type="button">Asignar tarea</button>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php foreach ($tareas as $tarea): 
	$empleado = ControladorEmpleados::ctrVerEmpleados('idEmpleados', $tarea['Empleados_idEmpleados']);
	$documentos = ControladorFormularios::ctrVerDocumentosTareas($tarea['idTareas']);
	$nombre = mb_strtoupper($empleado['lastname']." ".$empleado['name']);
?>
	<div class="modal fade" id="tarea<?php echo $tarea['idTareas'] ?>">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="align-items: center;">
					<h3 class="ml-2 mt-3">Detalles de la tarea</h3>
					<div>
						<a href="#" class=""><i class="fas fa-edit"></i></a>
						<a href="#" class="px-2 "><i class="fas fa-trash"></i></a>
					</div>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xl-12 pb-5">
							<p class="titulo titulo-tablero pb-2">Nombre de la tarea</p>
							<p class="titulo"><?php echo mb_strtoupper($tarea['nameTarea']) ?></p>
						</div>
						<div class="col-xl-4">
							<p class="titulo titulo-tablero pb-2">Asignado a</p>
							<p class="titulo"><?php echo $nombre ?></p>
						</div>
						<div class="col-xl-4">
							<p class="titulo titulo-tablero pb-2">Entregado</p>
							<?php if ($tarea['fecha_envio']!= null): ?>
								<p class="titulo"><?php echo date('d/m/Y', strtotime($tarea['fecha_envio'])) ?></p>
							<?php endif ?>
						</div>
						<div class="col-xl-4">
							<p class="titulo titulo-tablero pb-2">Vencimiento</p>
							<p class="titulo"><?php echo date('d/m/Y', strtotime($tarea['Vencimiento'])) ?></p>
						</div>
						<div class="col-xl-12 pt-5">
							<p class="titulo titulo-tablero pb-2">Descripción de la tarea</p>
							<p class="titulo"><?php echo mb_strtoupper($tarea['descripcion']) ?></p>
						</div>
						<?php if (empty($documentos)): ?>
						<div class="col-xl-12 pt-5">
							<p class="titulo titulo-tablero pb-2">Adjuntados</p>
							<p class="titulo">Sin documentos adjuntados</p>
						</div>
						<?php else: ?>
							<div class="col-xl-12 row pt-5">
								<?php foreach ($documentos as $documento): ?>
									<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="card card-figure" style="overflow: hidden; text-overflow: ellipsis;">
										<figure class="figure">
											<div class="figure-attachment">
												<span class="fa-stack fa-lg">
													<i class="fa fa-square fa-stack-2x text-primary"></i>
													<?php if ($documento['tipo'] == 'excel'): ?>
														<i class="fas fa-file-excel fa-stack-1x fa-inverse"></i>
													<?php else: ?>
														<i class="fa fa-file-pdf fa-stack-1x fa-inverse"></i>
													<?php endif ?>
												</span>
											</div>
											<figcaption class="figure-caption">
												<ul class="list-inline d-flex text-muted mb-0">
													<li class="list-inline-item text-truncate mr-auto">
														<a href="view/tareas/<?php echo $documento['nameDocumento'] ?>" download><?php echo $documento['nameDocumento'] ?></a>
													</li>
												</ul>
											</figcaption>
										</figure>
									</div>
								</div>
								<?php endforeach ?>
							</div>
						<?php endif ?>
						<div class="col-xl-6">
							<a class="btn btn-outline-primary rounded btn-block" href="SubirDocumentos&tarea=<?php echo $tarea['idTareas'] ?>">Subir Documentos</a>
						</div>
						<div class="col-xl-6">
							<a class="btn btn-outline-secondary rounded btn-block">Marcar como finalizado</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
<?php endforeach ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script>
var nameTarea = document.getElementById('nameTarea');
var descripcion = document.getElementById('descripcion');
var empleado = document.getElementById('empleado');
var vencimiento = document.getElementById('vencimiento');
var empresa = document.getElementById('empresa');

$(document).ready(function() {

	$("#empresa").change(function() {
		var empresaId = $(this).val();
		$.ajax({
			url: "ajax/ajax.formularios.php",
			type: "POST",
			data: {
			empresaEmpleadoID: empresaId
			},
			success: function(response) {
			var perteneceDepa = JSON.parse(response);

			// Limpiar las opciones actuales del select de ciudades
			empleado.innerHTML = '';

			// Agregar una opción predeterminada
			var opcionPredeterminada = document.createElement('option');
			opcionPredeterminada.text = 'Sin departamento';
			empleado.add(opcionPredeterminada);

			// Agregar las opciones de ciudades correspondientes al estado seleccionado
			perteneceDepa.forEach(function(datos) {
				var opcionDepartamento = document.createElement('option');
				var nombreEmpleado = datos.lastname + " " + datos.name;
				var nombreEmpleadoMayusculas = nombreEmpleado.toLocaleUpperCase();
				opcionDepartamento.text = nombreEmpleadoMayusculas;


				opcionDepartamento.value = datos.idEmpleados;
				empleado.add(opcionDepartamento);
			});
			}
		});
	});

	$("#submit-btn").click(function() {
		if (nameTarea !== 0 && descripcion !== 0 && empleado !== 0 && vencimiento !== 0 ) {

			var formData = $("#tarea-form").serialize(); // Obtener los datos del formulario
			$.ajax({
				url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
				type: "POST",
				data: formData,
				success: function(response) {
					if (response === 'error') {
						$("#form-result").val("");
						$("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
							<i class="fas fa-exclamation-triangle"></i>
							<b>Error</b>, no se pudo asignar la tarea, intenta nuevamente
						</div>
							`);
						deleteAlert();
					}else if(response === 'campos vacios'){
						$("#form-result").val("");
						$("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
							<i class="fas fa-exclamation-triangle"></i>
							<b>Error</b>, Rellena los campos vacios e intenta nuevamente
						</div>
							`);
						deleteAlert();
					}else{
						$("#form-result").val("");
						$("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
							<i class="fas fa-check-circle"></i>
							Nueva tarea asignada correctamente
						</div>
							`);

						deleteAlert();
						setTimeout(function() {
							location.reload();
						}, 1600);
					}
				}
			});
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
</script>