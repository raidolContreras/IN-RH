<?php $puestos = ControladorFormularios::ctrVerPuestos(null, null); ?>
<div class="container-fluid dashboard-content ">
	<!-- ============================================================== -->
	<!-- pageheader	-->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header">
				<h2 class="pageheader-title">Puestos</h2>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="Inicio" class="breadcrumb-link">IN Consulting México</a></li>
							<li class="breadcrumb-item active" aria-current="page">Puestos</li>
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
					<a href="CrearPuestos" class="btb btn-success p-2 rounded mb-3 float-right">
						Asignar Puestos<i class="fas fa-user-plus ml-2"></i>
					</a>
					<div class="table-responsive">
						<table id="Departamentos" class="table table-striped table-bordered first" style="width:100%">
							<thead>
								<tr>
									<th width="43%">Nombre del puesto</th>
									<th width="43%">Colaborador</th>
									<th width="43%">Salario</th>
									<th width="43%">Salario diario integrado</th>
									<th width="43%">Horario</th>
									<th width="43%">Datos fiscales</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($puestos as $key => $puesto): ?>
									<tr>
										<td><?php echo $puesto['namePuesto'] ?></td>
										<td><?php echo $puesto['name']." ".$puesto['lastname'] ?></td>
										<td><?php echo $puesto['salario'] ?></td>
										<td><?php echo $puesto['salario_integrado'] ?></td>
										<td><?php echo $puesto['horario_entrada']." - ".$puesto['horario_salida']?></td>
										<td>
											<div class="card-body border-top">
												<button type="button" class="btn btn-lg btn-primary" data-toggle="popover" data-placement="top" data-html="true"
													title="Datos fiscales" 
													data-content="<strong>RFC:</strong> <?php echo strtoupper($puesto['RFC']) ?><br><strong>NSS:</strong> <?php echo strtoupper($puesto['NSS']) ?><br><strong>CP:</strong> <?php echo strtoupper($puesto['CP']) ?>">
													Datos fiscales
											</button>
											</div>
                    </td>
										<td>
											<table>
												<tr>
													<td>
														<form method="POST" action="EditarDepto">
															<input type="hidden" name="Edicion" value="">
															<button type="submit" class="btn btn-primary rounded btn-block"><i class="far fa-edit"></i></button>
														</form>
													</td>
													<td>
														<form method="POST" action="EliminarDepto">
															<input type="hidden" name="Eliminar" value="">
															<button type="submit" class="btn btn-danger rounded btn-block"><i class="fas fa-trash"></i></button>
														</form>
													</td>
												</tr>
											</table>
										</td>
									</tr
								<?php endforeach ?>>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>