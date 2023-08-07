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
				<th>status</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($gastos as $gasto): 
				$empleado = ControladorEmpleados::ctrVerEmpleados('idEmpleados', $gasto['Empleados_idEmpleados']);
				$nombre = $empleado['lastname']." ".$empleado['name'];
				?>
				<?php if ($gasto['status'] == 0): ?>
				<tr>
					<td>
						<a class="btn btn-in-consulting" >
							<span>
								<?php echo $gasto['fechaDocumento'] ?>
							</span>
						</a>
					</td>
					<td><?php echo $gasto['nameVendedor'] ?></td>
					<td><?php echo $nombre ?></td>
					<?php
					switch ($gasto['status']) {
						case 0:
							echo '<td><span class="badge badge-warning-dot"><span class="badge-dot badge-warning"></span>Pendiente</span></td>';
							break;
						
						case 1:
							echo '<td><span class="badge badge-success-dot"><span class="badge-dot badge-success"></span>Aprobado</span></td>';
							break;
						
						case 2:
							echo '<td><span class="badge badge-danger-dot"><span class="badge-dot badge-danger"></span>Rechazado</span></td>';
							break;
						
						case 3:
							echo '<td><span class="badge badge-info-dot"><span class="badge-dot badge-info"></span>Pagado</span></td>';
							break;
						
						default:
							echo '<td><span class="badge badge-danger">Error</span></td>';
							break;
					}
					?>
				</tr>
				<?php endif ?>
			<?php endforeach ?>
		</tbody>
	</table>
</div>