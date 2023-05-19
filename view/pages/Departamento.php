<?php 
$empresas = ControladorFormularios::ctrVerEmpresas(null, null);
$departamento = ControladorFormularios::ctrVerDepartamentos(null, null); ?>
<div class="container-fluid dashboard-content ">
	<div class="ecommerce-widget">
		<!-- ============================================================== -->
		<!-- data table	-->
		<!-- ============================================================== -->
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="card">
				<div class="card-header tab-regular">
					<ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="general" data-toggle="tab" href="#card-1" role="tab" aria-controls="card-1" aria-selected="true">General</a>
						</li>
						<?php foreach ($empresas as $empresa): ?>
							<li class="nav-item">
								<a class="nav-link" id="card-tab-<?php echo $empresa['idEmpresas'] ?>" data-toggle="tab" href="#card-<?php echo $empresa['idEmpresas'] ?>" role="tab" aria-controls="card-<?php echo $empresa['idEmpresas'] ?>" aria-selected="false"><?php echo $empresa['nombre_razon_social'] ?></a>
							</li>
						<?php endforeach ?>
					</ul>
				</div> 
				<div class="card-body">
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="card-1" role="tabpanel" aria-labelledby="general">
							<a href="CrearDepartamentos" class="btb btn-success p-2 rounded mb-3 float-right">
								Crear Departamentos<i class="fas fa-user-plus ml-2"></i>
							</a>
							<div class="table-responsive">
								<table id="example" class="table table-striped table-bordered second" style="width:100%">
									<thead>
										<tr>
											<th width="33%">Nombre Depto</th>
											<th width="33%">Encargado</th>
											<th width="23%">empresa</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($departamento as $key => $depa): ?>
											<?php 
											if ($depa['Empleados_idEmpleados'] != 0) {
												$empleado = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $depa['Empleados_idEmpleados']);
												$nombreEmpleado = ucwords(strtolower($empleado['name']." ".$empleado['lastname']));
											}else{
												$nombreEmpleado = "-";
											}
												$empresa = ControladorFormularios::ctrVerEmpresas("idEmpresas", $depa['Empresas_idEmpresas']);
											?>
											<tr>

												<?php $depaEspe = ControladorFormularios::ctrVerDepartamentos("idDepartamentos",$depa['Pertenencia']); ?>
												<?php if (isset($depaEspe['nameDepto'])): ?>
														<?php $nameDepa = mb_strtoupper($depa['nameDepto']." (".$depaEspe['nameDepto'].")");?>
												<?php else: ?>
														<?php $nameDepa = mb_strtoupper($depa['nameDepto']);?>
												<?php endif ?>

												<td><?php echo $nameDepa ?></td>
												<td><?php echo $nombreEmpleado; ?></td>
												<td><?php echo $empresa['nombre_razon_social']." (".$empresa['rfc'].")"; ?></td>
												<td>
													<table>
														<tr>
															<td>
																<a href="EditarDepto&Edicion=<?php echo $depa['idDepartamentos'] ?>" class="btn btn-primary rounded btn-block"><i class="far fa-edit"></i></a>
															</td>
															<td>
																<form method="POST" action="EliminarDepto">
																	<input type="hidden" name="Eliminar" value="<?php echo $depa['idDepartamentos'] ?>">
																	<button type="submit" class="btn btn-danger rounded btn-block"><i class="fas fa-trash"></i></button>
																</form>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
						</div>
						<?php foreach ($empresas as $empresa): ?>
							<?php $depas = ControladorFormularios::ctrVerDepartamentos("Empresas_idEmpresas", $empresa['idEmpresas']); ?>
							<div class="tab-pane fade show" id="card-<?php echo $empresa['idEmpresas'] ?>" role="tabpanel" aria-labelledby="card-tab-<?php echo $empresa['idEmpresas'] ?>">
								<div class="table-responsive">
									<table id="example" class="table table-striped table-bordered second" style="width:100%">
										<thead>
											<tr>
												<th width="33%">Nombre Depto</th>
												<th width="33%">Encargado</th>
												<th width="23%">empresa</th>
												<th>Acciones</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($departamento as $key => $depa): ?>
												<?php 
												if ($depa['Empleados_idEmpleados'] != 0) {
													$empleado = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $depa['Empleados_idEmpleados']);
													$nombreEmpleado = ucwords(strtolower($empleado['name']." ".$empleado['lastname']));
												}else{
													$nombreEmpleado = "-";
												}
													$empresa = ControladorFormularios::ctrVerEmpresas("idEmpresas", $depa['Empresas_idEmpresas']);
												?>
												<tr>

													<?php $depaEspe = ControladorFormularios::ctrVerDepartamentos("idDepartamentos",$depa['Pertenencia']); ?>
													<?php if (isset($depaEspe['nameDepto'])): ?>
															<?php $nameDepa = mb_strtoupper($depa['nameDepto']." (".$depaEspe['nameDepto'].")");?>
													<?php else: ?>
															<?php $nameDepa = mb_strtoupper($depa['nameDepto']);?>
													<?php endif ?>

													<td><?php echo $nameDepa ?></td>
													<td><?php echo $nombreEmpleado; ?></td>
													<td><?php echo $empresa['nombre_razon_social']." (".$empresa['rfc'].")"; ?></td>
													<td>
														<table>
															<tr>
																<td>
																	<a href="EditarDepto&Edicion=<?php echo $depa['idDepartamentos'] ?>" class="btn btn-primary rounded btn-block"><i class="far fa-edit"></i></a>
																</td>
																<td>
																	<form method="POST" action="EliminarDepto">
																		<input type="hidden" name="Eliminar" value="<?php echo $depa['idDepartamentos'] ?>">
																		<button type="submit" class="btn btn-danger rounded btn-block"><i class="fas fa-trash"></i></button>
																	</form>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											<?php endforeach ?>
										</tbody>
									</table>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>