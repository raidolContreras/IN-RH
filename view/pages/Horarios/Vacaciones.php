<?php 
$permisos = ControladorFormularios::ctrVerPermisos(null,null); 
$empleados_has_permisos = ControladorFormularios::ctrVerPermisosEmpleados($_SESSION['idEmpleado']);
$tiempoContratado = $empleados_has_permisos[0]['tiempoContrato'];
$calculo_vacaciones = ControladorFormularios::ctrCalculoVacacional($tiempoContratado);
$vacaciones = ControladorFormularios::ctrVerSolicitudesVacaciones($_SESSION['idEmpleado']);
$dias_consumidos = 0;
$dias_pendientes = 0;
foreach ($vacaciones as $value) {
	if ($value['respuesta'] == 1) {
		if ($value['status_vacaciones'] == 1 || $value['status_vacaciones'] == 0) {
			$dias_consumidos += $value['dias'];
		}
		if ($value['respuesta'] == null) {
			$dias_pendientes += $value['dias'];
		}
	}
}
$dias_disponibles = $calculo_vacaciones - $dias_consumidos - $dias_pendientes;
?>

<style>

<?php foreach ($permisos as $permiso): ?>
<?php $name = strtr($permiso['namePermisos'], " ", "-"); ?>

.badge-<?php echo $name; ?> {
	background-color: <?php echo $permiso['colorPermisos']; ?>;
}

.badge-<?php echo $name; ?>[href]:focus,
.badge-<?php echo $name; ?>[href]:hover {
	color: #fff;
	background-color: #17c0dc;
	text-decoration: none;
}

.btn-<?php echo $name; ?> {
	color: #343;
	background-color: <?php echo $permiso['colorPermisos']; ?>;
	border-color: <?php echo $permiso['colorPermisos']; ?>;
}
.btn-<?php echo $name; ?>:hover{
	color: #fff;
	background-color: #727A83;
	border-color: #727A83;
}

<?php endforeach ?>


.badge-incapacidad {
	background-color: <?php echo $permiso['colorPermisos']; ?>;
}

.badge-incapacidad[href]:focus,
.badge-incapacidad[href]:hover {
	color: #fff;
	background-color: #17c0dc;
	text-decoration: none;
}

.btn-incapacidad {
	color: #343;
	background-color: #08c738;
	border-color: #08c738;
}
.btn-incapacidad:hover{
	color: #fff;
	background-color: #727A83;
	border-color: #727A83;
}
</style>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="row" style="justify-content: center;">
			<div class="col-xl-2 col-lg-12 col-md-12 col-12">
				<div class="card caja">
					<div class="card-header">
						<p class="titulo-tablero titulo">Vacaciones</p>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-6 col-vacations-left p-0 mb-2">
								Saldo inicial:
							</div>
							<div class="col-6 col-vacations-right mb-2">
								<?php echo $calculo_vacaciones; ?> días
							</div>
							<div class="col-6 col-vacations-left p-0 mt-2">
								Aprobadas:
							</div>
							<div class="col-6 col-vacations-right mt-2">
								<?php echo $dias_consumidos ?> días
							</div>
							<div class="col-6 col-vacations-left p-0 mt-3">
								Pendientes:
							</div>
							<div class="col-6 col-vacations-right mt-3">
								<?php echo $dias_pendientes ?> días
							</div>
						</div>
					</div>
						<div class="card-footer row">
							<div class="col-6 col-vacations-left p-0">
								<p class="titulo-tablero titulo">Disponibles</p>
							</div>
							<div class="col-6 col-vacations-right">
								<p class="titulo-tablero titulo"><?php echo $dias_disponibles; ?> días</p>
							</div>
						</div>
					<div class="card-header">
						<?php if ($tiempoContratado == 0): ?>
							<button class="btn btn-vacaciones btn-block rounded" disabled>Solicitar</button>
						<?php else: ?>
						<button type="button" 
						class="btn btn-vacaciones btn-block rounded" id="vacaciones-btn"
						data-toggle="modal"
						data-target="#permiso"
						data-name="Vacaciones"
						data-whatever="0">
								Solicitar
						  </button>
						<?php endif ?>
					</div>
				</div>
			</div>
			<div class="col-xl-2 col-lg-12 col-md-12 col-12">
				<div class="card caja contenedor">
					<div class="card-header">
						<p class="titulo-tablero titulo">Solicitar permisos</p>
					</div>
						<div class="card-header">
							<p class="subtitulo-tablero mt-3 mb-0">
								Incapacidad
							</p>
							<button type="button" 
								class="btn btn-incapacidad rounded float-right" id="incapacidad-btn"
								data-toggle="modal"
								data-target="#Incapacidad"
								data-name="Incapacidad"
								data-whatever="0">
								Registrar
							</button>
						</div>
					<?php foreach ($permisos as $permiso): ?>
						<?php $name = strtr($permiso['namePermisos'], " ", "-"); ?>
						<div class="card-header">
							<p class="subtitulo-tablero mt-3 mb-0">
								<?php echo $permiso['namePermisos'] ?>
							</p>
							<button type="button" 
								class="btn btn-<?php echo $name; ?> rounded float-right" id="<?php echo $name; ?>-btn"
								data-toggle="modal"
								data-target="#permiso"
								data-name="<?php echo $name; ?>"
								data-whatever="<?php echo $permiso['idPermisos']; ?>">
								Solicitar
							</button>
						</div>
					<?php endforeach ?>
				</div>
			</div>
			<div class="col-xl-8 col-md-12 col-12">
				<div class="card">
					<div class="card-header">
						Historial de ausencias
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered Puestos">
								<thead>
									<tr>
										<th>Periodo</th>
										<th>Tipo</th>
										<th>Estado</th>
										<th width="10"></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($empleados_has_permisos as $value): ?>
										<?php if ($value['idPermiso'] != null): ?>
										<tr>
											<td><?php echo $value['rango'] ?></td>
											<td><?php echo $value['permiso'] ?></td>
											<td>
												<?php if (empty($value['statusPermiso'])): ?>
													<span class="badge-dark p-1 rounded">Pendiente</span>
												<?php elseif ($value['statusPermiso'] == 1): ?>
													<span class="badge-success p-1 rounded">Aprobado</span>
												<?php else: ?>
													<span class="badge-danger p-1 rounded">Rechazado</span>
												<?php endif ?>
											</td>
											<td class="float-right">
												<button class="btn btn-danger rounded-circle btn-sm"
											data-toggle="modal"
											data-target="#eliminar"
											data-name="<?php echo $value['rango']; ?>"
											data-whatever="<?php echo $value['idPermiso']; ?>">
													&times;
											  </button>
											</td>
										</tr>
										<?php endif ?>
									<?php endforeach ?>
									<?php foreach ($vacaciones as $vacacion): ?>
										<?php if ($vacacion['status_vacaciones'] == 1): ?>
										<tr>
											<?php if ($vacacion['respuesta'] == 2): ?>
												<td><button class="btn btn-secondary-link"><?php echo $vacacion['rango'] ?></button></td>
											<?php else: ?>
												<td><?php echo $vacacion['rango'] ?></td>
											<?php endif ?>
											<td>Solicitud de vacaciones</td>
											<td>
												<?php if (empty($vacacion['respuesta'])): ?>
													<span class="badge-dark p-1 rounded">Pendiente</span>
												<?php elseif ($vacacion['respuesta'] == 1): ?>
													<span class="badge-success p-1 rounded">Aprobado</span>
												<?php else: ?>
													<span class="badge-danger p-1 rounded">Rechazado</span>
												<?php endif ?>
											</td>
											<td class="float-right">
												<button class="btn btn-danger rounded-circle btn-sm"
											data-toggle="modal"
											data-target="#eliminarV"
											data-name="<?php echo $vacacion['rango']; ?>"
											data-whatever="<?php echo $vacacion['idVacaciones']; ?>">
													&times;
											  </button>
											</td>
										</tr>
										<?php endif ?>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- The Modal -->
<div class="modal fade rounded" id="permiso">
	<div class="modal-dialog modal-dialog-centered modal-lg ">
		<div class="modal-content">

		<!-- Modal Header -->
			<div class="modal-header" style="flex-direction: column; align-items: center;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				
				<p class="titulo-tablero titulo" id="titulo">
					<span class="badge-dot"></span>
				</p>
				<p class="subtitulo-tablero ">Solicitar ausencia</p>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form class="form-container" id="solicitud-permiso-form">

					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="fechaPermiso">Desde:</label>
								<input class="form-control" type="date" id="fechaPermiso" name="fechaPermiso" min="<?php echo date('Y-m-d') ?>">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="fechaFin">Hasta:</label>
								<input class="form-control" type="date" id="fechaFin" name="fechaFin" min="<?php echo date('Y-m-d') ?>" disabled>
							</div>
						</div>
						<div class="col-12" id="description">
							<div class="form-group">
								<label for="descripcion">Descripción:</label>
								<textarea class="form-control" name="descripcion" id="descripcion" rows="5"></textarea>
							</div>
						</div>
					</div>
					<input type="hidden" id="id" name="generarPeticion">
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button id="solicitud-permiso-btn" type="button" class="btn btn-primary rounded" data-dismiss="modal">Solicitar</button>
				<button type="button" class="btn btn-danger rounded" data-dismiss="modal">Cancelar</button>
			</div>

		</div>
	</div>
</div>
<!-- The Modal -->
<div class="modal fade rounded" id="Incapacidad">
	<div class="modal-dialog modal-dialog-centered modal-lg ">
		<div class="modal-content">

		<!-- Modal Header -->
			<div class="modal-header" style="flex-direction: column; align-items: center;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				
				<p class="titulo-tablero titulo" id="titulo">
					<span class="badge-dot"></span>Registrar Incapacidad
				</p>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form class="form-container" id="solicitud-permiso-form">

					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label for="ramo_seguro">Ramo de Seguro:</label>
								<select name="ramo_seguro" id="ramo_seguro" class="form-control">
									<option>Selecciona un ramo de seguro</option>
									<option value="1">Riesgos de trabajo</option>
									<option value="2">Enfermedad General</option>
									<option value="3">Maternidad</option>
									<option value="4">Licencia 140 Bis</option>
								</select>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="tipo_riesgo">Tipo de Riesgo:</label>
								<select name="tipo_riesgo" id="tipo_riesgo" class="form-control" disabled>
									<option>Selecciona un tipo de riesgo</option>
									<option value="1">Accidente de Trabajo</option>
									<option value="2">Accidente de Trayecto</option>
									<option value="3">Enfermedad Profesional</option>
								</select>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="secuela_consecuencia">Secuela o Consecuencia:</label>
								<select name="secuela_consecuencia" id="secuela_consecuencia" class="form-control" disabled>
									<option>Selecciona una opción</option>
									<option value="1">Sí</option>
									<option value="2">No</option>
								</select>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="control_incapacidad">Control de la Incapacidad:</label>
								<select name="control_incapacidad" id="control_incapacidad" class="form-control">
									<option>Selecciona una opción</option>
									<option value="1">Unica</option>
									<option value="2">Inicial</option>
									<option value="3">Subsecuente</option>
									<option value="4">Alta Medica o ST-2</option>
								</select>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="fecha_inicio">Fecha de Inicio:</label>
								<input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="fecha_termino">Fecha de Termino:</label>
								<input type="date" name="fecha_termino" id="fecha_termino" class="form-control">
							</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<label for="folio">Folio:</label>
								<input type="text" name="folio" id="folio" class="form-control">
							</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<label for="dias">Días:</label>
								<input type="number" name="dias" id="dias" class="form-control">
							</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<label for="porcentaje">Porcentaje:</label>
								<input class="form-control" type="number" id="porcentaje" name="porcentaje" step="0.01" min="0" max="100">
							</div>
						</div>
					</div>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button id="solicitud-permiso-btn" type="button" class="btn btn-primary rounded" data-dismiss="modal">Solicitar</button>
				<button type="button" class="btn btn-danger rounded" data-dismiss="modal">Cancelar</button>
			</div>

		</div>
	</div>
</div>

<!-- The Modal Eliminar -->
<div class="modal fade rounded" id="eliminar">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">

		<!-- Modal Header -->
			<div class="modal-header" style="flex-direction: column; align-items: center;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<p class="titulo-tablero titulo" id="titulo">
					<span class="badge-dot"></span>
				</p>
				<p class="subtitulo-tablero ">Eliminar solicitud</p>
			</div>
			<div class="modal-body">
				¿Estás seguro de eliminar la solicitud?
				<form id="solicitud-eliminar-form">
					<input type="hidden" name="eliminarSolicitud" id="eliminarSolicitud">
				</form>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button id="solicitud-eliminar-btn" type="button" class="btn btn-danger rounded" data-dismiss="modal">Eliminar</button>
				<button type="button" class="btn btn-primary rounded" data-dismiss="modal">Cancelar</button>
			</div>

		</div>
	</div>
</div>

<!-- The Modal Eliminar Vacaciones -->
<div class="modal fade rounded" id="eliminarV">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">

		<!-- Modal Header -->
			<div class="modal-header" style="flex-direction: column; align-items: center;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<p class="titulo-tablero titulo" id="tituloV">
					<span class="badge-dot"></span>
				</p>
				<p class="subtitulo-tablero ">Eliminar solicitud</p>
			</div>
			<div class="modal-body">
				¿Estás seguro de eliminar la solicitud?
				<form id="solicitud-eliminarV-form">
					<input type="hidden" name="eliminarVSolicitud" id="eliminarVSolicitud">
				</form>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button id="solicitud-eliminarV-btn" type="button" class="btn btn-danger rounded" data-dismiss="modal">Eliminar</button>
				<button type="button" class="btn btn-primary rounded" data-dismiss="modal">Cancelar</button>
			</div>

		</div>
	</div>
</div>

<script src="assets/libs/js/generar_permisos_vacaciones.js"></script>
<script>
	
$(document).ready(function() {
	$('#ramo_seguro').change(function() {
		var selectedOption = $(this).val();
		if (selectedOption === "1") {
			$('#tipo_riesgo').prop('disabled', false);
			$('#secuela_consecuencia').prop('disabled', false);
		} else {
			$('#tipo_riesgo').prop('disabled', true);
			$('#tipo_riesgo').val('Selecciona un tipo de riesgo'); // Establecer el valor en una cadena vacía
			$('#secuela_consecuencia').prop('disabled', true);
			$('#secuela_consecuencia').val('Selecciona una opción'); // Establecer el valor en una cadena vacía
		}
	});

	// Verificar el valor inicial al cargar la página
	if ($('#ramo_seguro').val() === '') {
		$('#tipo_riesgo').prop('disabled', true);
		$('#tipo_riesgo').val('Selecciona un tipo de riesgo'); // Establecer el valor en una cadena vacía
		$('#secuela_consecuencia').prop('disabled', true);
		$('#secuela_consecuencia').val('Selecciona una opción'); // Establecer el valor en una cadena vacía
	}
});
</script>