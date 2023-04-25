<?php 
$empleados = ControladorFormularios::ctrVerEmpleados(null, null); 
?><div class="container-fluid dashboard-content ">
	<!-- ============================================================== -->
	<!-- pageheader	-->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header">
				<h2 class="pageheader-title">Empleados</h2>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="Inicio" class="breadcrumb-link">IN Consulting México</a></li>
							<li class="breadcrumb-item active" aria-current="page">Empleados</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- end pageheader	-->
	<!-- ============================================================== -->
	<div class="ecommerce-widget">
		<!-- ============================================================== -->
		<!-- data table	-->
		<!-- ============================================================== -->
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="card">
				<div class="card-body">
					<a href="RegistroEmpleados" class="btb btn-success p-2 rounded mb-3 float-right">
						Registrar empleados<i class="fas fa-user-plus ml-2"></i>
					</a>
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered second" style="width:100%">
							<thead>
								<tr>
									<th>N° de Identificación</th>
									<th>Nombre Completo</th>
									<th>Fecha de Nacimiento</th>
									<th>Dirección</th>
									<th>Teléfono</th>
									<th>Email</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($empleados as $key => $value): ?>
								<tr>
									<td><?php echo strtoupper($value['identificacion']); ?></td>
									<td><?php echo strtoupper($value['name'].' '.$value['lastname']); ?></td>
									<td><?php echo $value['fNac']; ?></td>

								<?php if ($value['numI']==null || $value['numI'] == ""): ?>
									<td><?php echo strtoupper($value['street'].", #".$value['numE'].", ".$value['colonia'].", ".$value['municipio'].", ".$value['estado']."."); ?></td>

								<?php else: ?>

									<td><?php echo strtoupper($value['street'].", #".$value['numE'].", #".$value['numI'].", ".$value['colonia'].", ".$value['municipio'].", ".$value['estado']."."); ?></td>
								<?php endif ?>

								<?php 
									$formattedNumber = ControladorFormularios::ctrNumeroTelefonico($value['phone']);
								?>
									<td><?php echo $formattedNumber; ?></td>
									<td><?php echo $value['email']; ?></td>
									<td>
										<table>
											<tr>
												<td>
													<form method="POST" action="Colaborador">
													<input type="hidden" name="Eliminar" value="no">
													<button class="btn btn btn-outline-secondary rounded btn-block" name="Editar" value="<?php echo $value['idEmpleados'];?>">
														<i class="fas fa-address-card"></i>
													</button>
													</form>
													
													<!--<div class="container">
														<button type="button" class="btn btn-info rounded" data-toggle="modal" data-target="#<?php echo $value['idEmpleados'] ?>">
														Emergencia
														</button>

														<div class="modal fade" id="<?php echo $value['idEmpleados'] ?>">
														<div class="modal-dialog">
															<div class="modal-content">
															
															<div class="modal-header">
																<h4 class="modal-title">Datos de emergencia (<?php echo strtoupper($value['name']." ".$value['lastname']); ?>)</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															
															<div class="modal-body">
															<?php 
																$formattedNumber = ControladorFormularios::ctrNumeroTelefonico($value['phoneEmer']);
															?>
																Nombre: <?php echo strtoupper($value['nameEmer']); ?><br>
																Parentesco: <?php echo strtoupper($value['parentesco']); ?><br>
																Teléfono: <?php echo $formattedNumber;?>
															</div>
															 
															</div>
														</div>
														</div>
														
													</div>	
												</td>
												<td> 
													<form method="POST" action="Edicion">
													<button class="btn btn-primary rounded" name="Editar" value="<?php echo $value['idEmpleados'];?>">
														<i class="fa fa-edit"></i>
													</button>
													</form>
												</td>
												<td>

													<form method="POST" action="HistorialLaboral">
													<button class="btn btn-warning rounded" name="Historial" value="<?php echo $value['idEmpleados'];?>">
														<i class="fas fa-history"></i>
													</button>
												</td>
												<td>
													<form method="POST" action="Borrar">
													<button class="btn btn-danger rounded" name="Borrar" value="<?php echo $value['idEmpleados'];?>">
														<i class="fas fa-eraser"></i>
													</button>-->
												</td>
											</tr>
										</table>
										</form>
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
</div>