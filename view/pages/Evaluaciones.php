<?php if (!empty($rol) && $rol['Ver_Evaluaciones'] == 1): ?>
<?php
$Evaluaciones = ControladorFormularios::ctrVerEvaluaciones(null, null);
?>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="card mx-5 menu-ajustes">
			<div class="row card-header" style="align-items: center;">
				<div class="encabezado">
					EVALUACIONES
				</div>
				<?php if (!empty($rol) && $rol['Editar_Evaluaciones'] == 1): ?>
				<div class="float-right">
					<a href="crearEvaluacion" class="btb btn-success p-2 rounded float-right">
						Crear evaluación
					</a>
				</div>
				<?php endif ?>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table examenes">
						<thead>
							<tr>
								<th>#</th>
								<th>Nombre del examen</th>
								<th>Rango de fechas</th>
								<th>Tiempo limite</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; foreach ($Evaluaciones as $Evaluacion):
								$tiempo = ControladorFormularios::ctrFormatearTiempo($Evaluacion['tiempo_limite']);
							?>
								<tr>
									<td>
										<?php if (strlen($i)==1) {
											echo '0'.$i;
										}else{
											echo $i;
										}$i++;?>
									</td>
									<td><?php echo $Evaluacion['titulo']; ?></td>
									<td>
										<?php
										if ($Evaluacion['fecha_inicio'] == null) {
											if ($Evaluacion['fecha_fin'] == null) {
												echo 'Siempre Abierto';
											}else{
												$fecha_fin = ControladorFormularios::ctrFormatearMes($Evaluacion['fecha_fin']);
												echo 'Hasta el '.$fecha_fin;
											}
										}else{

											$fecha_inicio = ControladorFormularios::ctrFormatearMes($Evaluacion['fecha_inicio']);

											echo $fecha_inicio;

											if ($Evaluacion['fecha_fin'] != null) {
												$fecha_fin = ControladorFormularios::ctrFormatearMes($Evaluacion['fecha_fin']);
												echo ' al '.$fecha_fin;
											}
										}
										?>
									</td>
									<td><?php echo $tiempo; ?></td>
									<td>
										<div class="dropdown">
											<button class="btn btn-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fas fa-ellipsis-v"></i>
											</button>
											<div class="dropdown-menu mr-0" aria-labelledby="dropdownMenuButton">
												<?php if (!empty($rol) && $rol['Editar_Evaluaciones'] == 1): ?>
												<a class="IN-dropdown-item" href="crearEvaluacion&evaluacion=<?php echo $Evaluacion['idExamen']; ?>">
													<i class="fas fa-edit"></i> Editar
												</a>
												<a class="IN-dropdown-item" href="AddEmpleados&evaluacion=<?php echo $Evaluacion['idExamen']; ?>">
													<i class="fas fa-user-plus"></i> Agregar empleados
												</a>
												<?php endif ?>
												<a class="IN-dropdown-item" href="Preguntas&evaluacion=<?php echo $Evaluacion['idExamen']; ?>">
													<i class="fas fa-clipboard-list"></i> Ver preguntas
												</a>
												<a class="IN-dropdown-item" href="Calificaciones&evaluacion=<?php echo $Evaluacion['idExamen']; ?>">
													<i class="fas fa-tasks"></i> Calificaciones
												</a>
												<?php if (!empty($rol) && $rol['Del_Evaluaciones'] == 1): ?>
												<a class="IN-dropdown-item"
												href="eliminarExamen&evaluacion=<?php echo $Evaluacion['idExamen']; ?>">
													<i class="fas fa-trash"></i> Eliminar
												</a>
												<?php endif ?>
											</div>
										</div>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php else: ?>
	<script>
		window.location.href = 'Evaluaciones_Asignadas';
	</script>
<?php endif ?>