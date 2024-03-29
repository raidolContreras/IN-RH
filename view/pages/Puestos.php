<?php $puestos = ControladorFormularios::ctrVerPuestos(null, null); ?>
<div class="container-fluid dashboard-content ">
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
						<table id="Puestos" class="table table-striped table-bordered Puestos" style="width:100%">
							<thead>
								<tr>
									<th width="30%">NOMBRE DEL PUESTO</th>
									<th width="30%">COLABORADOR</th>
									<th width="">SALARIO</th>
									<th width="">SALARIO DIARIO INTEGRADO</th>
									<th width="">HORARIO</th>
									<th width="">CURP</th>
									<th width="">RFC</th>
									<th width="">NSS</th>
									<th width="">CP</th>
									<th>ACCIONES</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($puestos as $key => $puesto): ?>
									<tr>
										<td><?php echo $puesto['namePuesto'] ?></td>
										<td><?php echo $puesto['name']." ".$puesto['lastname'] ?></td>
										<td><?php echo $puesto['salario'] ?></td>
										<td><?php echo $puesto['salario_integrado'] ?></td>
										<td><?php echo strtoupper($puesto['CURP']) ?></td>
                    					<td><?php echo strtoupper($puesto['RFC']) ?></td>
                    					<td><?php echo strtoupper($puesto['NSS']) ?></td>
                    					<td><?php echo strtoupper($puesto['CP']) ?></td>
										<td>
											<table>
												<tr>
													<td>
														<input type="hidden" name="Edicion" value="">
														<a href="EditarPuesto&puesto<?php echo $puesto['idPuesto'] ?>" class="btn btn-primary rounded btn-block"><i class="far fa-edit"></i></a>
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