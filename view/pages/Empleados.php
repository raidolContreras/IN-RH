<?php 
$empleados = ControladorFormularios::ctrVerEmpleados(null, null); 
?><div class="container-fluid dashboard-content ">
	<!-- ============================================================== -->
	<!-- pageheader  -->
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
	<!-- end pageheader  -->
	<!-- ============================================================== -->
	<div class="ecommerce-widget">
		<!-- ============================================================== -->
		<!-- data table  -->
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
									<th>Nombre(s)</th>
									<th>Apellidos</th>
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
									<td><?php echo strtoupper($value['name']); ?></td>
									<td><?php echo strtoupper($value['lastname']); ?></td>
									<td><?php echo $value['fNac']; ?></td>

								<?php if ($value['numI']==null || $value['numI'] == ""): ?>
									<td><?php echo strtoupper($value['street'].", #".$value['numE'].", ".$value['colonia'].", ".$value['municipio'].", ".$value['estado']."."); ?></td>

								<?php else: ?>

									<td><?php echo strtoupper($value['street'].", #".$value['numE'].", #".$value['numI'].", ".$value['colonia'].", ".$value['municipio'].", ".$value['estado']."."); ?></td>
								<?php endif ?>

									<td><?php echo $value['phone']; ?></td>
									<td><?php echo $value['email']; ?></td>
									<td>
										<table>
											<tr>
												<td>
													<form method="POST" action="Edicion">
													<button class="btn btn-primary rounded" value="<?php echo $value['idEmpleados'];?>">
														<i class="fa fa-edit"></i>
													</button>
													</form>
												</td>
												<td>
													<form method="POST" action="InformacionLaboral">
													<button class="btn btn-warning rounded" value="<?php echo $value['idEmpleados'];?>">
														<i class="fa fa-user"></i>
													</button>
												</td>
												<td>
													<form method="POST" action="Eliminacion">
													<button class="btn btn-danger rounded" value="<?php echo $value['idEmpleados'];?>">
														<i class="fa fa-trash"></i>
													</button>
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