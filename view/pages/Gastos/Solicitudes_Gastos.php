<?php if (!empty($jefeDepartamento)): ?>
<div class="container-fluid dashboard-content">
	<div class="row">
		<div class="container col-xl-9 col-md-12 order-xl-1 order-md-2">
			<div class="card">
				<?php 
					$gastos = ControladorFormularios::ctrVerGastos(null, null);
				?>
				<div class="card-body">
					<p class="titulo-tablero titulo mb-3">LISTA DE GASTOS</p>
					<div class="table-responsive">
						<table id="example" class="table solicitud-gastos">
							<thead>
								<tr>
									<th width="20%">MOTIVO</th>
									<th>EMPLEADO</th>
									<th width="150">FECHA DEL DOCUMENTO</th>
									<th>PROVEEDOR</th>
									<th>IMPORTE</th>
									<th>CATEGORÍA</th>
									<th>CANTIDAD</th>
									<th>MONEDA</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($gastos as $gasto): 
									// Consulta todas las pertenencias de departamentos y almacena los ID de jefes en un array
									$jefes = array();
									$ctrDeptosEspecial = ControladorFormularios::ctrVerPertenenciasDepartamentos('Empleados_idEmpleados', $gasto['Empleados_idEmpleados']);
									$Pertenencia = $ctrDeptosEspecial[0]['Pertenencia'];
									$jefes[] = $ctrDeptosEspecial[0]['Empleados_idEmpleados'];
									do {
										$ctrDeptosEspecial = ControladorFormularios::ctrVerPertenenciasDepartamentos('idDepartamentos', $Pertenencia);
										$Pertenencia = $ctrDeptosEspecial[0]['Pertenencia'];
										$jefes[] = $ctrDeptosEspecial[0]['Empleados_idEmpleados'];
									} while ($Pertenencia != 0);

									// Consulta el nombre del empleado
									$empleado = ControladorEmpleados::ctrVerEmpleados('idEmpleados', $gasto['Empleados_idEmpleados']);
									$nombre = $empleado['lastname'] . " " . $empleado['name'];
									$folio = ControladorFormularios::ctrVerFolioGastos('idFolio_Gasto', $gasto['folio']);
									$divisa = ControladorFormularios::ctrVerDivisa('idDivisa', $gasto['divisa']);
									$categoria = ControladorFormularios::ctrVerCategoria('idCategoria', $gasto['categoria']);

									?>

									<?php if ($_SESSION['idEmpleado'] != $gasto['Empleados_idEmpleados']): ?>
										<?php foreach ($jefes as $jefe): ?>
											<?php if ($jefe == $_SESSION['idEmpleado']): ?>
												<tr>
													<td><?php echo $folio['nameFolio'] ?></td>
													<td><?php echo $nombre ?></td>
													<td><?php echo date('d/m/Y', strtotime($gasto['fechaDocumento'])) ?></td>
													<td><?php echo $gasto['nameVendedor'] ?></td>
													<td><?php echo ControladorFormularios::formatearNumero($gasto['importeTotal'], $divisa['divisa']) ?></td>
													<td><?php echo $categoria['nameCategoria'] ?></td>
													<td><?php echo $gasto['importeTotal'] ?></td>
													<td><?php echo $divisa['divisa'] ?></td>
													<td>
														<?php if ($gasto['status'] == 0): ?>
														<form class="row" id="gastos-form">
															<div class="col-6">
																<button type="button" class="btn btn-success rounded" id="aceptar-btn" onclick="aceptar(<?php echo $gasto['idGastos']; ?>)">Aceptar</button>
															</div>
															<div class="col-6">
																<button type="button" class="btn btn-danger rounded" id="rechazar-btn" onclick="rechazar(<?php echo $gasto['idGastos']; ?>)">Rechazar</button>
															</div>
														</form>
														<?php elseif ($gasto['status'] == 1): ?>
														<button type="button" class="btn btn-warning rounded" id="excel" onclick="pagado(<?php echo $gasto['idGastos'] ?>)">
															Marcar como pagado
														</button>
														<?php elseif ($gasto['status'] == 3): ?>
														<span class="badge badge-success">Pagado</span>
														<?php endif ?>
													</td>
												</tr>
											<?php endif ?>
										<?php endforeach ?>
									<?php endif ?>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>

	function pagado(gastosid){
		$.ajax({
			url: "ajax/ajax.formularios.php",
			type: "POST",
			data: {marcarPagado: gastosid},
			success: function(response) {
				$("#form-result").val("");
				if (response !== 'error') {
					$("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
							<i class="fas fa-check-circle"></i>
							Se marco como pagado correctamente.
						</div>
					`);
					setTimeout(function() {
						location.href = 'Solicitudes_Gastos';
					}, 900);
					deleteAlert();
				} else {
					$("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
							<i class="fas fa-exclamation-triangle"></i>
							<b>Error</b>, no se pudo marcar como pagado, intentalo nuevamente.
						</div>
					`);
					deleteAlert();
				}
			}
		});
	}
	
	function aceptar(id){
		$.ajax({
			url: "ajax/ajax.formularios.php",
			type: "POST",
			data: {aceptarGasto: id},
			success: function(response) {
				$("#form-result").val("");
				if (response === 'ok') {
					$("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
							<i class="fas fa-check-circle"></i>
							Gasto aceptado.
						</div>
					`);
					setTimeout(function() {
						location.href = 'Solicitudes_Gastos';
					}, 900);
					deleteAlert();
				}
				else {
					$("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
							<i class="fas fa-exclamation-triangle"></i>
							<b>Error</b>, no se pudo aceptar el gasto, intentalo nuevamente.
						</div>
					`);
					deleteAlert();
				}
			}
		});
	}

	function rechazar(id){
		$.ajax({
			url: "ajax/ajax.formularios.php",
			type: "POST",
			data: {rechazarGasto: id},
			success: function(response) {
				$("#form-result").val("");
				if (response === 'ok') {
					$("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
							<i class="fas fa-check-circle"></i>
							Gasto rechazado.
						</div>
					`);
					setTimeout(function() {
						location.href = 'Solicitudes_Gastos';
					}, 900);
					deleteAlert();
				}
				else {
					$("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
							<i class="fas fa-exclamation-triangle"></i>
							<b>Error</b>, no se pudo rechazar el gasto, intentalo nuevamente.
						</div>
					`);
					deleteAlert();
				}
			}
		});
	}

function deleteAlert() {
	setTimeout(function() {
		var alert = $('#alerta');
		alert.fadeOut('slow', function() {
			alert.remove();
		});
	}, 1500);
}
</script>
<?php else: ?>
	<script>
		location.href = 'Gastos';
	</script>
<?php endif ?>