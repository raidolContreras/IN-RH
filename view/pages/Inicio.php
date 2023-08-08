<div class="container-fluid dashboard-content ">

	<div class="row">

		<div class="col-xl-3 col-lg-12 px-0">
			<!--Tablero de empleado del mes-->
			<div class="row gx-1">
				<div class="col-xl-12 col-lg-12">
					<div class="card">
						<div class="mt-1 mb-1 contenedor">
							<?php include "view/pages/modulos/EmpleadoMes.php" ?>
						</div>
					</div>
				</div>
				<!--Tablero de empleado del mes-->
				<div class="col-xl-12 col-lg-12">
					<div class="card contenedor">
						<div class="card-body">
							<?php include "view/pages/modulos/Responsable.php" ?>
						</div>
					</div>
				</div>
				<!--Tablero de cumpleaños empleado-->
				<div class="col-xl-12 col-lg-12">
					<div class="card">
						<div class="card-body contenedor">
							<?php include "view/pages/modulos/Birtday.php" ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--Tablero de Notificaciones-->
		<div class="col-xl-9 col-lg-12 order-first order-xl-last px-0">
			<div class="row">
				<div class="col-12 order-xl-1">
					<div class="card">
						<div class="m-2 altura">
							<?php include "view/pages/modulos/TableroNoticias.php" ?>
						</div>
					</div>
				</div>
				<?php if (!empty($jefeDepartamento)): ?>
					<div class="col-xl-4 col-lg-12 order-xl-2 order-lg-3">
						<div class="card">
							<div class="card-body contenedor">
								<?php include "view/pages/modulos/Aniversario.php" ?>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-lg-12 order-xl-3 order-lg-2">
						<div class="card">
							<div class="float-right" style="z-index: 2 !important;" id="justify-result">
							</div>
							<div class="card-body contenedor" style="z-index: 0 !important;">
								<?php include "view/pages/modulos/Peticiones.php" ?>
							</div>
						</div>
					</div>
					<div class="col-xl-12 order-xl-4 order-lg-3">
						<div class="card">
							<div class="float-right" style="z-index: 2 !important;" id="justify-result">
							</div>
							<div class="card-body contenedor" style="z-index: 0 !important;">
								<?php include "view/pages/modulos/Tareas.php" ?>
							</div>
						</div>
					</div>
					<div class="col-xl-12 order-xl-6 order-lg-5">
						<div class="card">
							<div class="float-right" style="z-index: 2 !important;" id="justify-result">
							</div>
							<div class="card-body contenedor" style="z-index: 0 !important;">
								<?php include "view/pages/modulos/Gastos.php" ?>
							</div>
						</div>
					</div>
				<?php else: ?>
					<div class="col-lg-12 order-xl-2">
						<div class="card">
							<div class="card-body contenedor">
								<?php include "view/pages/modulos/Aniversario.php" ?>
							</div>
						</div>
					</div>
				<?php endif ?>
				<div class="col-xl-12 order-xl-5 order-lg-4">
					<div class="card">
						<div class="float-right" style="z-index: 2 !important;" id="justify-result">
						</div>
						<div class="card-body contenedor" style="z-index: 0 !important;">
							<?php include "view/pages/modulos/Encargos.php" ?>
						</div>
					</div>
				</div>

			</div>
		</div>

	</div>

</div>
<?php 
$tareas = ControladorFormularios::ctrVerTareas("Jefe_idEmpleados", $_SESSION['idEmpleado']);
foreach ($tareas as $tarea): 
	$empleado = ControladorEmpleados::ctrVerEmpleados('idEmpleados', $tarea['Empleados_idEmpleados']);
	$documentos = ControladorFormularios::ctrVerDocumentosTareas($tarea['idTareas']);
	$nombre = mb_strtoupper($empleado['lastname']." ".$empleado['name']);
	?>
	<div class="modal fade" id="tarea<?php echo $tarea['idTareas'] ?>">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header" style="align-items: center;">
					<h3 class="ml-2 mt-3">Detalles de la tarea</h3>
					<div>
						<a href="#" class=""><i class="fas fa-edit"></i></a>
						<a href="#" class="px-2 "><i class="fas fa-trash"></i></a>
					</div>
				</div>
				<div class="modal-header">
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
					</div>
				</div>
				<div class="modal-body">
					<?php if ($tarea['status_tarea'] == 0): ?>
						<div class="col-xl-12">
							<a class="btn btn-outline-primary rounded btn-block" href="EntregarTarea&tarea=<?php echo $tarea['idTareas'] ?>">Entregar encargo</a>
						</div>
					<?php else: 
						$documentos = ControladorFormularios::ctrVerDocumentosEntregas($tarea['idTareas']);

						if (empty($documentos)): ?>
							<div class="col-xl-12 pt-5">
								<p class="titulo titulo-tablero pb-2">Adjuntados</p>
								<p class="titulo">Sin documentos adjuntados</p>
							</div>
						<?php else: ?>
							<div class="col-xl-12 row">
								<p class="titulo titulo-tablero mb-0 col-xl-12">Archivos Subidos</p>
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
															<a href="view/tareas/<?php echo $tarea['idTareas'] ?>/<?php echo $documento['nameDocumento'] ?>" download><?php echo $documento['nameDocumento'] ?></a>
														</li>
													</ul>
												</figcaption>
											</figure>
										</div>
									</div>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					<?php endif ?>

				</div>
				<?php if ($tarea['status_tarea'] != 2): ?>
					<div class="modal-footer">
						<div class="col-xl-6">
							<a class="btn btn-outline-primary rounded btn-block" href="SubirDocumentos&tarea=<?php echo $tarea['idTareas'] ?>">Subir Documentos</a>
						</div>
						<div class="col-xl-6">
							<a class="btn btn-outline-success rounded btn-block" href="FinalizarTarea&tarea=<?php echo $tarea['idTareas'] ?>">Marcar como finalizado</a>
						</div>
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>
<?php endforeach ?>
<?php 
$encargos = ControladorFormularios::ctrVerTareas("Empleados_idEmpleados", $_SESSION['idEmpleado']);
foreach ($encargos as $tarea): 
	$empleado = ControladorEmpleados::ctrVerEmpleados('idEmpleados', $tarea['Jefe_idEmpleados']);
	$documentos = ControladorFormularios::ctrVerDocumentosTareas($tarea['idTareas']);
	$nombre = mb_strtoupper($empleado['lastname']." ".$empleado['name']);
	?>
	<div class="modal fade" id="encargos<?php echo $tarea['idTareas'] ?>">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="ml-2 mt-3">Detalles del encargo</h3>
				</div>
				<div class="modal-header">
					<div class="row">
						<div class="col-xl-12 pb-5">
							<p class="titulo titulo-tablero pb-2">Nombre de la tarea</p>
							<p class="titulo"><?php echo mb_strtoupper($tarea['nameTarea']) ?></p>
						</div>
						<div class="col-xl-4">
							<p class="titulo titulo-tablero pb-2">Asignado por</p>
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
					</div>
				</div>

				<div class="modal-body">
					<?php if ($tarea['status_tarea'] == 0): ?>
						<div class="col-xl-12">
							<a class="btn btn-outline-primary rounded btn-block" href="EntregarTarea&tarea=<?php echo $tarea['idTareas'] ?>">Entregar encargo</a>
						</div>
					<?php else: 
						$documentos = ControladorFormularios::ctrVerDocumentosEntregas($tarea['idTareas']);

						if (empty($documentos)): ?>
							<div class="col-xl-12 pt-5">
								<p class="titulo titulo-tablero pb-2">Adjuntados</p>
								<p class="titulo">Sin documentos adjuntados</p>
							</div>
						<?php else: ?>
							<div class="col-xl-12 row">
								<p class="titulo titulo-tablero mb-0 col-xl-12">Archivos Subidos</p>
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
															<a href="view/tareas/<?php echo $tarea['idTareas'] ?>/<?php echo $documento['nameDocumento'] ?>" download><?php echo $documento['nameDocumento'] ?></a>
														</li>
													</ul>
												</figcaption>
											</figure>
										</div>
									</div>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach ?>