<?php 
	$empleados = ControladorEmpleados::ctrVerEmpleados(null, null);
?>
<div class="container-fluid dashboard-content ">
	<div class="card col-12 p-4 row">
		<h3>Tabla de Datos de Asistencias del Mes</h3>
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Registrado</th>
						<th>Esperado</th>
						<th>Horas Extras</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($empleados as $empleado):

						$Total_Horas = ControladorFormularios::ctrTotalHoras($empleado);
					
					?>
						<tr>
							<td><?php echo $Total_Horas['nombre'] ?></td>
							<td><?php echo $Total_Horas['horasRegistradas'] ?></td>
							<td><?php echo $Total_Horas['horasEsperadas'] ?></td>
							<td><?php echo $Total_Horas['horasExtras'] ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>