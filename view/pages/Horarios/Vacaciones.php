<?php 
$permisos = ControladorFormularios::ctrVerPermisos(null,null); 
$empleados_has_permisos = ControladorFormularios::ctrVerPermisosEmpleados($_SESSION['idEmpleado']);
$tiempoContratado = $empleados_has_permisos[0]['tiempoContrato'];
$calculo_vacaciones = ControladorFormularios::ctrCalculoVacacional($tiempoContratado);
?>

<style>

<?php foreach ($permisos as $permiso): ?>
	
.btn-<?php echo strtr($permiso['namePermisos'], " ", "-"); ?> {
	color: #343;
	background-color: <?php echo $permiso['colorPermisos']; ?>;
	border-color: <?php echo $permiso['colorPermisos']; ?>;
}
.btn-<?php echo strtr($permiso['namePermisos'], " ", "-"); ?>:hover{
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
							<button class="btn btn-outline-primary btn-block rounded" disabled>Solicitar</button>
						<?php else: ?>
							<button class="btn btn-outline-primary btn-block rounded">Solicitar</button>
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
						    <button class="btn btn-<?php echo $name; ?> rounded float-right" id="<?php echo $name; ?>-btn">Solicitar</button>
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
										<th></th>
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
											<td><span class="badge-danger p-1 px-2 rounded-circle">x</span></td>
										</tr>										<?php endif ?>
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