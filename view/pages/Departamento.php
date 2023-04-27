<?php $departamento = ControladorFormularios::ctrVerDepartamentos(null, null); ?>
<div class="container-fluid dashboard-content ">
	<!-- ============================================================== -->
	<!-- pageheader	-->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header">
				<h2 class="pageheader-title">Departamentos</h2>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="Inicio" class="breadcrumb-link">IN Consulting México</a></li>
							<li class="breadcrumb-item active" aria-current="page">Departamentos</li>
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
					<a href="CrearDepartamentos" class="btb btn-success p-2 rounded mb-3 float-right">
						Crear Departamentos<i class="fas fa-user-plus ml-2"></i>
					</a>
					<div class="table-responsive">
						<table id="Departamentos" class="table table-striped table-bordered first" style="width:100%">
							<thead>
								<tr>
									<th width="43%">Nombre Depto</th>
									<th width="43%">Encargado</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($departamento as $key => $depa): ?>
									<?php 
									if ($depa['Empleados_idEmpleados'] != 0) {
										$empleado = ControladorFormularios::ctrVerEmpleados("idEmpleados", $depa['Empleados_idEmpleados']);
										$nombreEmpleado = ucwords(strtolower($empleado['name']." ".$empleado['lastname']));
									}else{
										$nombreEmpleado = "-";
									}
									?>
									<tr>
										<td><?php echo $depa['nameDepto'] ?></td>
										<td><?php echo $nombreEmpleado; ?></td>
										<td>
											<table>
												<tr>
													<td>
														<form method="POST" action="EditarDepto">
															<input type="hidden" name="Edicion" value="<?php echo $depa['idDepartamentos'] ?>">
															<button type="submit" class="btn btn-primary rounded btn-block"><i class="far fa-edit"></i></button>
														</form>
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
			</div>
		</div>
	</div>
</div>