<?php 
$permisos = ControladorFormularios::ctrVerPermisos(null,null); 
$empleados_has_permisos = ControladorFormularios::ctrVerPermisosEmpleados($_SESSION['idEmpleado']);
$tiempoContratado = $empleados_has_permisos[0]['tiempoContrato'];
$calculo_vacaciones = ControladorFormularios::ctrCalculoVacacional($tiempoContratado);
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
							<div class="col-6 col-vacations-left p-0">
								Saldo inicial:
							</div>
							<div class="col-6 col-vacations-right">
								<?php echo $calculo_vacaciones; ?> días
							</div>
							<div class="col-6 col-vacations-left p-0 mt-3">
								Disfrutadas:
							</div>
							<div class="col-6 col-vacations-right mt-3">
								0 días
							</div>
							<div class="col-6 col-vacations-left p-0 mt-3">
								Planificado:
							</div>
							<div class="col-6 col-vacations-right mt-3">
								0 días
							</div>
						</div>
					</div>
						<div class="card-footer row">
							<div class="col-6 col-vacations-left p-0">
								<p class="titulo-tablero titulo">Disponibles</p>
							</div>
							<div class="col-6 col-vacations-right">
								<p class="titulo-tablero titulo"><?php echo $calculo_vacaciones; ?> días</p>
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

<script src="assets/libs/js/generar_permisos_vacaciones.js"></script>