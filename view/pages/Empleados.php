<?php 
$empleados = ControladorEmpleados::ctrVerEmpleados(null, null); 
$empresas = ControladorFormularios::ctrVerEmpresas(null, null);
?>

<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="card menu-ajustes">
				<div class="card-header tab-regular">
					<ul class="nav nav-tabs card-header-tabs nav-empresas" id="myTab" role="tablist">
					<?php if (!isset($_GET['depa'])): ?>
						<li class="nav-item nav-item-empresas" style="max-width: 150px;">
							<a class="nav-link active" href="Empleados">GENERAL</a>
						</li>
						<?php foreach ($empresas as $empresa): ?>
							<li class="nav-item nav-item-empresas" style="max-width: 150px;">
								<a class="nav-link" href="Empleados&depa=<?php echo $empresa['idEmpresas'] ?>"><?php echo $empresa['nombre_razon_social'] ?></a>
							</li>
						<?php endforeach ?>
					<?php else: ?>
						<li class="nav-item" style="max-width: 150px;">
							<a class="nav-link" href="Empleados">GENERAL</a>
						</li>
						<?php foreach ($empresas as $empresa): ?>
							<li class="nav-item nav-item-empresas" style="max-width: 150px;">
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
												<th width="20%">Nombre Completo</th>
												<th>Puesto de trabajo</th>
												<th>Departamento</th>
												<th>Empresa</th>
												<th>Fecha de Contratación</th>
												<th>Fecha de Baja</th>
												<th>Estado</th>
											</tr>
										</thead>
										<tbody style="font-size: 12px !important">
											<?php if (!isset($_GET['depa'])): ?>
												<?php foreach ($empleados as $value): ?>
													<tr>
														<td>
															<a class="btn btn-link" href="Empleado&perfil=<?php echo $value['idEmpleados'];?>">
																<?php echo mb_strtoupper($value['lastname'].' '.$value['name'], 'UTF-8'); ?>
															</a>
														</td>
														<?php if ($value['status'] == 1): ?>
															<?php $puesto = ControladorFormularios::ctrVerPuestos("Empleados_idEmpleados", $value['idEmpleados']) ?>
															<?php $depa = ControladorFormularios::ctrVerDepartamentos("idDepartamentos", $puesto['Departamentos_idDepartamentos']) ?>
															<?php $empresa = ControladorFormularios::ctrVerEmpresas("idEmpresas", $depa['Empresas_idEmpresas']); ?>
															<td><?php echo mb_strtoupper($puesto['namePuesto'], 'UTF-8') ?></td>
															<td><?php echo mb_strtoupper($depa['nameDepto'], 'UTF-8') ?></td>
															<td><?php echo mb_strtoupper($empresa['nombre_razon_social'], 'UTF-8') ?></td>
														<?php else: ?>
															<td colspan="3" style="text-align: center; color: red;">- Sin puesto laboral -</td>
															<td style="display: none;"></td>
															<td style="display: none;"></td>
														<?php endif ?>
														<td><?php $fecha_formateada = date("Y-m-d", strtotime($value['fecha_contratado']));
														echo $fecha_formateada; ?></td>
														<td><?php echo $value['fecha_baja']; ?></td>
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
																<?php echo mb_strtoupper($value['lastname'].' '.$value['name'], 'UTF-8'); ?>
															</a>
														</td>
														<?php if ($value['status'] == 1 && $value['fecha_baja'] == null): ?>
															<?php $puesto = ControladorFormularios::ctrVerPuestos("Empleados_idEmpleados", $value['idEmpleados']) ?>
															<?php $depa = ControladorFormularios::ctrVerDepartamentos("idDepartamentos", $puesto['Departamentos_idDepartamentos']) ?>
															<?php $empresa = ControladorFormularios::ctrVerEmpresas("idEmpresas", $depa['Empresas_idEmpresas']) ?>
															<td><?php echo mb_strtoupper($puesto['namePuesto'], 'UTF-8') ?></td>
															<td><?php echo mb_strtoupper($depa['nameDepto'], 'UTF-8') ?></td>
															<td><?php echo mb_strtoupper($empresa['nombre_razon_social'], 'UTF-8') ?></td>
														<?php else: ?>
															<td colspan="3" style="text-align: center; color: red;">- Sin puesto laboral -</td>
															<td style="display: none;"></td>
															<td style="display: none;"></td>
														<?php endif ?>
														<td><?php $fecha_formateada = date("Y-m-d", strtotime($value['fecha_contratado']));
														echo $fecha_formateada; ?></td>
														<td><?php echo $value['fecha_baja']; ?></td>
														<td>
															<?php if ($value['status'] == 1&& $value['fecha_baja'] == null): ?>
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
