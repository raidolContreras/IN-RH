<?php 
	$gastos = ControladorFormularios::ctrVerGastos(null, null);
?>
<p class="titulo-tablero titulo">Lista de Gastos</p>
<div class="table-responsive">
	<table class="table Peticiones table-hover">
		<thead>
			<tr>
				<th>Fecha del documento</th>
				<th>Proveedor</th>
				<th>Empleado</th>
				<th width="20%">Acciones</th>
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
				?>

				<?php if ($_SESSION['idEmpleado'] != $gasto['Empleados_idEmpleados']): ?>
					<?php foreach ($jefes as $jefe): ?>
						<?php if ($jefe == $_SESSION['idEmpleado'] && $gasto['status'] == 0): ?>
							<tr>
								<td>
									<a class="btn btn-in-consulting">
										<span><?php echo $gasto['fechaDocumento'] ?></span>
									</a>
								</td>
								<td><?php echo $gasto['nameVendedor'] ?></td>
								<td><?php echo $nombre ?></td>
								<td>
									<form class="row" id="gastos-form">
										<div class="col-6">
											<button type="button" class="btn btn-success rounded" id="aceptar-btn" onclick="aceptar(<?php echo $gasto['idGastos']; ?>)">Aceptar</button>
										</div>
										<div class="col-6">
											<button type="button" class="btn btn-danger rounded" id="rechazar-btn" onclick="rechazar(<?php echo $gasto['idGastos']; ?>)">Rechazar</button>
										</div>
									</form>
								</td>
							</tr>
						<?php endif ?>
					<?php endforeach ?>
				<?php endif ?>
			<?php endforeach ?>
		</tbody>
	</table>
</div>

<script>
	
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
						location.href = 'Inicio';
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
						location.href = 'Inicio';
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