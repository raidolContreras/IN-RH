<?php 
$empresas = ControladorFormularios::ctrVerEmpresas(null,null);
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
					<a href="RegistroEmpresa" class="btb btn-success p-2 rounded mb-3 float-right">
						Nueva empresa<i class="fas fa-user-plus ml-2"></i>
					</a>
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered second" style="width:100%">
							<thead>
								<tr>
									<th>Registro patronal</th>
									<th>R.F.C.</th>
									<th>Nombre o Razón social</th>
									<th>Actividad económica</th>
									<th>Calle</th>
									<th>Numero</th>
									<th>Colonia</th>
									<th>C.P.</th>
									<th>Entidad</th>
									<th>Población y municipio / alcaldia</th>
									<th>Teléfono</th>
									<th>Convenio de reembolso de suministros (checkbox)</th>
									<th>Delegación IMSS</th>
									<th>Subdelegación IMSS</th>
									<th>Clave subdelegación</th>
									<th>Mes del inicio del modulo de afiliación</th>
									<th>Año del inicio del modulo de afiliación</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($empresas as $key => $empresa): ?>
									<tr>
										<td><?php echo $empresa['registro_patronal']; ?></td>
										<td><?php echo $empresa['rfc']; ?></td>
										<td><?php echo $empresa['nombre_razon_social']; ?></td>
										<td><?php echo $empresa['actividad_economica']; ?></td>
										<td><?php echo $empresa['calle']; ?></td>
										<td><?php echo $empresa['numero']; ?>, N° interior:<? echo $empresa['numero_interior']; ?></td>
										<td><?php echo $empresa['colonia']; ?></td>
										<td><?php echo $empresa['cp']; ?></td>
										<td><?php echo $empresa['entidad']; ?></td>
										<td><?php echo $empresa['poblacion_municipio']; ?></td>
										<td><?php echo $empresa['telefono']; ?></td>
										<td><?php echo $empresa['convenio_reembolso']; ?></td>
										<td><?php echo $empresa['delegacion_imss']; ?></td>
										<td><?php echo $empresa['subdelegacion']; ?></td>
										<td><?php echo $empresa['clave_subdelegacion']; ?></td>
										<td><?php echo $empresa['mes_inicio_afiliacion']; ?></td>
										<td><?php echo $empresa['anio_inicio_afiliacion']; ?></td>
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