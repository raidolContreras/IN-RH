<?php 
$empleados = ControladorEmpleados::ctrVerEmpleados(null, null); 
?><div class="container-fluid dashboard-content ">
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
								<?php foreach ($empleados as $key => $value): ?>
								<tr>
									<td>
										<a class="btn btn-link" href="Empleado&perfil=<?php echo $value['idEmpleados'];?>">
											<?php echo strtoupper($value['name'].' '.$value['lastname']); ?>
										</a>
									</td>

										<?php if ($value['status'] == 1): ?>
									<td>
										<?php $puesto = ControladorFormularios::ctrVerPuestos("Empleados_idEmpleados", $value['idEmpleados']) ?>
										<?php echo $puesto['namePuesto'] ?>
									</td>
									<td>
										<?php $depa = ControladorFormularios::ctrVerDepartamentos("idDepartamentos", $puesto['Departamentos_idDepartamentos']) ?>
										<?php echo $depa['nameDepto'] ?>
									</td>
									<td>
										<?php $empresa = ControladorFormularios::ctrVerEmpresas("idEmpresas", $depa['Empresas_idEmpresas']) ?>
										<?php echo $empresa['nombre_razon_social'] ?>
									</td>
									
										<?php else: ?>
											<td></td>
											<td></td>
											<td></td>
										<?php endif ?>

									<td><?php echo strtoupper($value['identificacion']); ?></td>
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
										<?php if ($value['status'] == 1): ?>
											<span class="mr-2"><span class="badge-dot badge-success"></span>Activo</span>
										<?php else: ?>
											<span class="mr-2"><span class="badge-dot badge-warning"></span>Inactivo</span>
										<?php endif ?>
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