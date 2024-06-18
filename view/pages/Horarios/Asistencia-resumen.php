<?php if (!empty($rol) && $rol['Resumenes_Asistencias'] == 1): ?>

<?php 
	$idEmpresas = 0;
$empresas = ControladorFormularios::ctrVerEmpresas(null, null);
if (isset($_GET['empresa'])) {
	$idEmpresas = $_GET['empresa'];
	$empleados = ControladorFormularios::ctrEmpleadosEspecial("idEmpresas", $idEmpresas);
}else{
	$empleados = ControladorEmpleados::ctrVerEmpleados(null, null);
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="card mx-5 menu-ajustes">
			<div class="card-header encabezado">
				RESUMEN DE ASISTENCIAS
				<form class="exportarExcelEmpresas-form float-right">
					<div class="row" style="flex-wrap: nowrap;">
						<input type="hidden" name="genExcelEmpresas" value="<?php echo $idEmpresas ?>">
						<input type="month" class="form-control" id="fecha" name="fecha" min="2023-01" />
						<button type="button" class="btn btn-outline-success btn-rounded btn-lg exportarExcelEmpresas-btn">
							<i class="mdi mdi-download"></i> Descargar Excel
						</button>
					</div>
				</form>
			</div>
			<div class="row">
				<div class="card-side-nav col-xl-2 col-lg-3 col-md-4 col-3 lista-ajustes">
<?php if (isset($_GET['empresa'])): ?>
						<div>
<?php else: ?>
						<div class="active">
<?php endif ?>
							<a href="Asistencia-resumen" class="btn btn-block btn-in-consulting-link textos activo">
								GENERAL
							</a>
						</div>
<?php foreach ($empresas as $empresa): ?>
	<?php if ($idEmpresas == $empresa['idEmpresas']): ?>
						<div class="active">
	<?php else: ?>
						<div>
	<?php endif ?>
							<a href="Asistencia-resumen&empresa=<?php echo $empresa['idEmpresas'] ?>" class="btn btn-block btn-in-consulting-link textos">
								<?php echo $empresa['nombre_razon_social'] ?>
							</a>
						</div>
<?php endforeach ?>
				</div>
					<div class=" col-xl-10 col-lg-9 col-md-8 col-9" id="horarios">
						<div class="row mr-4 ml-2 mt-3">
							<div class="table-responsive tabla-contenedor">
								<table id="example" class="table ResumenAsistencias">
									<thead>
										<tr>
											<th>Nombre</th>
											<th>Registrado</th>
											<th>Esperado</th>
											<th width="40"></th>
										</tr>
									</thead>
									<tbody>
<?php foreach ($empleados as $empleado): ?>

<?php
$Total_Horas = ControladorFormularios::ctrTotalHoras($empleado);
?>
									<tr>
										<td><a class="" href="Asistencia&perfil=<?php echo $empleado['idEmpleados'] ?>"><?php echo $Total_Horas['nombre'] ?></a></td>
										<td><?php echo $Total_Horas['horasRegistradas'] ?></td>
										<td><?php echo $Total_Horas['horasEsperadas'] ?></td>
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
<?php else: ?>
	<script>
		window.location.href = 'Asistencia';
	</script>
<?php endif ?>