<?php $peticiones = ControladorFormularios::ctrVerPeticiones($_SESSION['idEmpleado']); ?>
<p class="titulo-tablero titulo">Peticiones de asistencia</p>
<div class="row">
	<div class="mx-3 mt-2 pb-0 table-responsive">

		<table id="example" class="table Peticiones table-hover">
			<thead>
				<tr>
					<th width="20%">Nombre</th>
					<th>Comentario</th>
					<th width="20%">Horario</th>
					<th width="10%"></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($peticiones as $peticion): ?>
					<?php $empleado = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $peticion['Empleados_idEmpleados']) ?>
					<?php $asistencia = ControladorFormularios::ctrVerAsistencia("idAsistencias", $peticion['Asistencias_idAsistencias']) ?>
					<tr>
						<td><?php echo $empleado['lastname']." ".$empleado['name']; ?></td>
						<td><?php echo $peticion['Comentario']; ?></td>
						<td><?php echo date("d/m/Y", strtotime($asistencia['fecha_asistencia']))." (".$asistencia['entrada']." - ".$asistencia['salida'].")"; ?></td>
						<td>
							<button class="btn btn-outline-success btn-rounded">
								<i class="fas fa-check"></i>
							</button>
							<button class="btn btn-outline-danger btn-rounded">
								<i class="fas fa-times"></i>
							</button>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>

	</div>
</div>