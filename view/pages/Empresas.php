<?php 
$empresas = ControladorFormularios::ctrVerEmpresas(null,null);
// Leer el archivo JSON de estados
$estadosJson = file_get_contents('view/pages/json/estados.json');

// Convertir el JSON a un array asociativo
$estadosArray = json_decode($estadosJson, true);
$regimenJson = file_get_contents('view/pages/json/regimen.json');
$regimenArray = json_decode($regimenJson, true); 
?>
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
									<th>Régimen</th>
									<th>Actividad económica</th>
									<th>Dirección</th>
									<th>Entidad y Población o municipio/alcaldia</th>
									<th>Teléfono</th>
									<th>Delegación IMSS</th>
									<th>Subdelegación IMSS</th>
									<th>Clave subdelegación</th>
									<th>Fecha de inicio de operaciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($empresas as $key => $empresa): ?>
									<tr>
										<td><?php echo $empresa['registro_patronal']; ?></td>
										<td><?php echo $empresa['rfc']; ?></td>
										<td><?php echo $empresa['nombre_razon_social']; ?></td>
										<?php foreach ($regimenArray as $key => $value): ?>
											<?php if ($value['clave'] == $empresa['regimen']): ?>
												<td>(<?php echo $value['clave']; ?>) <?php echo $value['nombre']; ?></td>
											<?php endif ?>
										<?php endforeach ?>
										<td><?php echo $empresa['actividad_economica']; ?></td>
										<td>Calle / Avenida: <?php echo $empresa['calle']; ?>,
										N°: <?php echo $empresa['numero']; ?>, N° interior: <? echo $empresa['numero_interior']; ?>,
										Colonia: <?php echo $empresa['colonia']; ?>
										C.P.: <?php echo $empresa['cp']; ?></td>
										<td><?php echo $empresa['poblacion_municipio']; ?>, <?php echo $empresa['entidad']; ?></td>
										<td><?php echo $empresa['telefono']; ?></td>
										<?php foreach ($estadosArray as $key => $value): ?>
											<?php if ($value['clave'] == $empresa['delegacion_imss']): ?>
												<td><?php echo $value['nombre']; ?></td>
											<?php endif ?>
										<?php endforeach ?>
										<td><?php echo $empresa['subdelegacion']; ?></td>
										<td><?php echo $empresa['clave_subdelegacion']; ?></td>
										<td><?php echo $empresa['dia_inicio_afiliacion']; ?> de <?php echo $empresa['mes_inicio_afiliacion']; ?> del <?php echo $empresa['anio_inicio_afiliacion']; ?></td>
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