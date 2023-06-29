<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="row">
			<div class="col-xl-8">
				<div class="card">
					<div class="card-body">
						<p class="titulo-tablero titulo">Lista de Tareas</p>
						<div class="table-responsive">
							<table class="table Extras">
								<thead>
									<tr>
										<th>Nombre de la tarea</th>
										<th>Asignado a</th>
										<th>Vencimiento</th>
										<th>status</th>
									</tr>
								</thead>
								<tbody>
										<tr>
											<td>Creación de documentos de Excel</td>
											<td>Contreras Oscar</td>
											<td>17/Jul/2023</td>
											<td><span class="badge badge-success">Entregado</span></td>
										</tr>
										<tr>
											<td>Desarrollo de sitio web</td>
											<td>López María</td>
											<td>25/Jun/2023</td>
											<td><span class="badge badge-warning">En proceso</span></td>
										</tr>
										<tr>
											<td>Revisión de informe</td>
											<td>Gómez Juan</td>
											<td>10/Ago/2023</td>
											<td><span class="badge badge-success">Entregado</span></td>
										</tr>
										<tr>
											<td>Actualización de base de datos</td>
											<td>Rodríguez Ana</td>
											<td>30/Jul/2023</td>
											<td><span class="badge badge-success">Entregado</span></td>
										</tr>
										<tr>
											<td>Elaboración de presentación</td>
											<td>Pérez Luis</td>
											<td>05/Sep/2023</td>
											<td><span class="badge badge-danger">Pendiente</span></td>
										</tr>
										<tr>
											<td>Redacción de informe técnico</td>
											<td>Martínez Carlos</td>
											<td>20/Ago/2023</td>
											<td><span class="badge badge-warning">En proceso</span></td>
										</tr>
										<tr>
											<td>Configuración de servidor</td>
											<td>Hernández Laura</td>
											<td>15/Sep/2023</td>
											<td><span class="badge badge-danger">Pendiente</span></td>
										</tr>
										<tr>
											<td>Retraso en la entrega</td>
											<td>Ramírez Alejandro</td>
											<td>10/Jun/2023</td>
											<td><span class="badge badge-danger">Retrasado</span></td>
										</tr>
										<tr>
											<td>Análisis de datos</td>
											<td>Gutiérrez Sofia</td>
											<td>28/Ago/2023</td>
											<td><span class="badge badge-success">Entregado</span></td>
										</tr>
										<tr>
											<td>Configuración de red</td>
											<td>Ortega Manuel</td>
											<td>18/Sep/2023</td>
											<td><span class="badge badge-success">Entregado</span></td>
										</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4">
				<div class="card p-3">
					<form id="tarea-form"  enctype="multipart/form-data">
						<div class="row">
							<div class="col-xl-12">
								<label for="nameTarea">Nombre de la tarea</label>
								<input type="text" id="nameTarea" name="nameTarea" class="form-control" required>
							</div>
							<div class="col-xl-12 mt-2">
								<label for="descripcion">Descripción de la tarea</label>
								<textarea id="descripcion" name="descripcion" class="form-control" required></textarea>
							</div>
							<div class="col-xl-12 mt-2">
								<label for="empleado">Asignado a</label>
								<select type="text" id="empleado" name="empleado" class="form-control" required>
									<option>Selecciona un Empleado</option>
									<option value="1">Contreras Oscar</option>
									<option value="2">Natividad Erick</option>
								</select>
							</div>
							<div class="col-xl-12 mt-2">
								<label for="vencimiento">Vencimiento</label>
								<input type="date" id="vencimiento" name="vencimiento" class="form-control" min="<?php echo date('Y-m-d'); ?>" required>
							</div>
							<div class="col-xl-12 mt-2 dropzone">
<input type="file" name="file" />
							</div>
							<div class="col-xl-12 mt-2">
								<button class="btn btn-outline-primary btn-block rounded">Asignar tarea</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>