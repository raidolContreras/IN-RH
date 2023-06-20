<?php 
$empleados = ControladorEmpleados::ctrVerEmpleados(null, null); 
$empresas = ControladorFormularios::ctrVerEmpresas(null, null);
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="card mx-5">
			<div class="card-header encabezado">Resumen de Asistencias</div>
			<div class="row">
				<div class="card-side-nav col-xl-2 col-lg-3 col-md-4 col-sm-4 lista-ajustes">
						<div class="active">
							<button class="btn btn-block btn-in-consulting-link textos activo" data-id="General">
								GENERAL
							</button>
						</div>
					<?php foreach ($empresas as $empresa): ?>
						<div class="">
							<button class="btn btn-block btn-in-consulting-link textos" data-id="empresa-<?php echo $empresa['idEmpresas'] ?>">
								<?php echo $empresa['nombre_razon_social'] ?>
							</button>
						</div>
					<?php endforeach ?>
				</div>
					<div class=" col-xl-10 col-lg-9 col-md-8 col-sm-8" id="horarios">
						<div class="row mr-4 ml-2 mt-3">
							<div class="table-responsive tabla-contenedor">
								<table class="table">
									<thead>
										<tr>
											<th>Nombre</th>
											<th>Registrado</th>
											<th>Esperado</th>
											<th width="40"></th>
										</tr>
									</thead>
									<tbody>
										<?php if (!empty($empleados)): ?>
											<?php foreach ($empleados as $empleado): ?>
												<?php $nombre = ucwords(mb_strtolower($empleado['lastname']." ".$empleado['name'])); ?>
										<tr>
											<td><a class="" href="Asistencia&perfil=<?php echo $empleado['idEmpleados'] ?>"><?php echo $nombre ?></a></td>
											<td>117h 14min</td>
											<td>110h 0min</td>
											<td>
												<form class="exportarExcel-form">
													<input type="hidden" name="genExcel" value="<?php echo $empleado['idEmpleados'] ?>">
													<button type="button" class="btn btn-outline-success btn-rounded btn-block btn-lg exportarExcel-btn">
														<i class="mdi mdi-download"></i> Descargar Excel
													</button>
												</form>
											</td>
										</tr>
											<?php endforeach ?>
									<?php endif ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="assets/libs/js/exportar_asistencias.js"></script>
<div id="form-result" class="alerta-flotante"></div>
