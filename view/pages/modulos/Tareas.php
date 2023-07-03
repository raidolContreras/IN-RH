<?php 
	$tareas = ControladorFormularios::ctrVerTareas("Jefe_idEmpleados", $_SESSION['idEmpleado']);
?>
						<p class="titulo-tablero titulo">Lista de Tareas</p>
						<div class="table-responsive">
							<table class="table Peticiones table-hover">
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