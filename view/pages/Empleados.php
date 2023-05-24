<?php 
$empleados = ControladorEmpleados::ctrVerEmpleados(null, null); 
$empresas = ControladorFormularios::ctrVerEmpresas(null, null);
?>

<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="card">
				<div class="card-header tab-regular">
					<ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
					<?php if (!isset($_GET['depa'])): ?>
						<li class="nav-item">
							<a class="nav-link active" href="Empleados">General</a>
						</li>
						<?php foreach ($empresas as $empresa): ?>
							<li class="nav-item">
								<a class="nav-link" href="Empleados&depa=<?php echo $empresa['idEmpresas'] ?>"><?php echo $empresa['nombre_razon_social'] ?></a>
							</li>
						<?php endforeach ?>
					<?php else: ?>
						<li class="nav-item">
							<a class="nav-link" href="Empleados">General</a>
						</li>
						<?php foreach ($empresas as $empresa): ?>
							<li class="nav-item">
								<?php if ($_GET['depa'] == $empresa['idEmpresas']): ?>
								<a class="nav-link active" href="Empleados&depa=<?php echo $empresa['idEmpresas'] ?>"><?php echo $empresa['nombre_razon_social'] ?></a>
								<?php else: ?>
								<a class="nav-link" href="Empleados&depa=<?php echo $empresa['idEmpresas'] ?>"><?php echo $empresa['nombre_razon_social'] ?></a>
								<?php endif ?>
							</li>
						<?php endforeach ?>
					<?php endif ?>
					</ul>
				</div>
				<div class="card-body">
					<div class="tab-content" id="myTabContent">
						<?php if (!empty($empleados)): ?>
							<div class="tab-pane fade show active" id="card-1" role="tabpanel" aria-labelledby="general">
								<a href="RegistroEmpleados" class="btb btn-success p-2 rounded mb-3 float-right">
									Registrar empleados<i class="fas fa-user-plus ml-2"></i>
								</a>
								<div class="table-responsive">
									<table id="example" class="table table-striped table-bordered second" style="width:100%; height:100%">
										<thead>
											<tr>
												<th>Nombre Completo</th>
												<th>Puesto</th>
												<th>Departamento</th>
												<th>Empresa</th>
												<th>N° de Identificación</th>
												<th>Fecha de Nacimiento</th>
												<th>Dirección</th>
												<th>Teléfono</th>
												<th>Email</th>
												<th>Estado</th>
											</tr>
										</thead>
										<tbody>
											<?php if (!isset($_GET['depa'])): ?>
												<?php foreach ($empleados as $value): ?>
													<tr>
														<td>
															<a class="btn btn-link" href="Empleado&perfil=<?php echo $value['idEmpleados'];?>">
																<?php echo mb_strtoupper($value['name'].' '.$value['lastname'], 'UTF-8'); ?>
															</a>
														</td>
														<?php if ($value['status'] == 1): ?>
															<?php $puesto = ControladorFormularios::ctrVerPuestos("Empleados_idEmpleados", $value['idEmpleados']) ?>
															<?php $depa = ControladorFormularios::ctrVerDepartamentos("idDepartamentos", $puesto['Departamentos_idDepartamentos']) ?>
															<?php $empresa = ControladorFormularios::ctrVerEmpresas("idEmpresas", $depa['Empresas_idEmpresas']) ?>
															<td><?php echo $puesto['namePuesto'] ?></td>
															<td><?php echo $depa['nameDepto'] ?></td>
															<td><?php echo $empresa['nombre_razon_social'] ?></td>
														<?php else: ?>
															<td></td>
															<td></td>
															<td></td>
														<?php endif ?>
														<td><?php echo strtoupper($value['identificacion']); ?></td>
														<td><?php echo $value['fNac']; ?></td>
														<?php if ($value['numI'] == null || $value['numI'] == ""): ?>
															<td><?php echo strtoupper($value['street'].", #".$value['numE'].", ".$value['colonia'].", ".$value['municipio'].", ".$value['estado']."."); ?></td>
														<?php else: ?>
															<td><?php echo strtoupper($value['street'].", #".$value['numE'].", #".$value['numI'].", ".$value['colonia'].", ".$value['municipio'].", ".$value['estado']."."); ?></td>
														<?php endif ?>
														<?php $formattedNumber = ControladorFormularios::ctrNumeroTelefonico($value['phone']); ?>
														<td><?php echo $formattedNumber; ?></td>
														<td><?php echo $value['email']; ?></td>
														<td>
															<?php if ($value['status'] == 1): ?>
																<span class="mr-2"><span class="badge-dot badge-success"></span>Activo</span>
															<?php else: ?>
																<span class="mr-2"><span class="badge-dot badge-warning"></span>Inactivo</span>
															<?php endif ?>
														</td>
													</tr>
												<?php endforeach ?>
											<?php else: ?>
												<?php $empleadosSeleccionados = ControladorFormularios::ctrEmpleadosEspecial("idEmpresas", $_GET['depa']); ?>
												<?php foreach ($empleadosSeleccionados as $value): ?>
													<tr>
														<td>
															<a class="btn btn-link" href="Empleado&perfil=<?php echo $value['idEmpleados'];?>">
																<?php echo mb_strtoupper($value['name'].' '.$value['lastname'], 'UTF-8'); ?>
															</a>
														</td>
														<?php if ($value['status'] == 1): ?>
															<?php $puesto = ControladorFormularios::ctrVerPuestos("Empleados_idEmpleados", $value['idEmpleados']) ?>
															<?php $depa = ControladorFormularios::ctrVerDepartamentos("idDepartamentos", $puesto['Departamentos_idDepartamentos']) ?>
															<?php $empresa = ControladorFormularios::ctrVerEmpresas("idEmpresas", $depa['Empresas_idEmpresas']) ?>
															<td><?php echo $puesto['namePuesto'] ?></td>
															<td><?php echo $depa['nameDepto'] ?></td>
															<td><?php echo $empresa['nombre_razon_social'] ?></td>
														<?php else: ?>
															<td></td>
															<td></td>
															<td></td>
														<?php endif ?>
														<td><?php echo strtoupper($value['identificacion']); ?></td>
														<td><?php echo $value['fNac']; ?></td>
														<?php if ($value['numI'] == null || $value['numI'] == ""): ?>
															<td><?php echo strtoupper($value['street'].", #".$value['numE'].", ".$value['colonia'].", ".$value['municipio'].", ".$value['estado']."."); ?></td>
														<?php else: ?>
															<td><?php echo strtoupper($value['street'].", #".$value['numE'].", #".$value['numI'].", ".$value['colonia'].", ".$value['municipio'].", ".$value['estado']."."); ?></td>
														<?php endif ?>
														<?php $formattedNumber = ControladorFormularios::ctrNumeroTelefonico($value['phone']); ?>
														<td><?php echo $formattedNumber; ?></td>
														<td><?php echo $value['email']; ?></td>
														<td>
															<?php if ($value['status'] == 1): ?>
																<span class="mr-2"><span class="badge-dot badge-success"></span>Activo</span>
															<?php else: ?>
																<span class="mr-2"><span class="badge-dot badge-warning"></span>Inactivo</span>
															<?php endif ?>
														</td>
													</tr>
												<?php endforeach ?>
											<?php endif ?>
										</tbody>
									</table>
								</div>
							</div>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
