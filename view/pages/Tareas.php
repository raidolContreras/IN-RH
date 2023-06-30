<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />
<style>
	.dropzone {
		border: 2px dashed #ccc;
		padding: 20px;
	}

	.dropzone .dz-message {
		text-align: center;
		font-size: 1.5em;
		color: #999;
	}
</style>
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
						<form id="tarea-form">
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
								<input type="hidden" id="nameArchivos" name="nameArchivos">
							</div>
						</form>
						<div class="row mt-3">
							<div class="col-xl-12 card">
								<form class="dropzone my-3" id="documentos-dropzone" enctype="multipart/form-data">
									<div class="dz-message">
										Arrastra y suelta archivos aquí o haz clic para seleccionar archivos para cargar.
										<p class="subtitulo-sup">Tipos de archivo permitidos .xlsx,.xls,.pdf (Tamaño máximo 10 MB)</p>
									</div>
								</form>
							</div>
						</div>
						<div class="col-xl-12 mt-2">
							<button class="btn btn-outline-primary btn-block rounded" id="submit-btn" type="button">Asignar tarea</button>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

<script>
var nameTarea = document.getElementById('nameTarea');
var descripcion = document.getElementById('descripcion');
var empleado = document.getElementById('empleado');
var vencimiento = document.getElementById('vencimiento');
Dropzone.autoDiscover = false;

$(document).ready(function() {
		var myDropzone = new Dropzone("#documentos-dropzone", {
				url: "ajax/upload.documents.php",
				paramName: "file",
				maxFilesize: 10,
				acceptedFiles: ".xlsx,.xls,.pdf",
				addRemoveLinks: true,
				uploadMultiple: true,
				dictRemoveFile: "Eliminar archivo",
				autoProcessQueue: false // Habilita la carga automática de archivos
		});
		
		$("#submit-btn").click(function() {
			if (nameTarea !== 0 && descripcion !== 0 && empleado !== 0 && vencimiento !== 0 ) {

				myDropzone.processQueue();

				myDropzone.on("success", function(file, archivos) {
						if (archivos === "error_tamano") {
								// Mensaje de error: tamaño de archivo excedido
								console.log("Error: Tamaño de archivo excedido.");
						} else if (archivos === "error_tipo") {
								// Mensaje de error: tipo de archivo no permitido
								console.log("Error: Tipo de archivo no permitido.");
						} else {
								console.log("Archivo cargado correctamente.");
								var nameArchivos = document.getElementById("nameArchivos");
								nameArchivos.value = archivos;
						}
				});

			}else{
				$("#form-result").val("");
				$("#form-result").html(`
				<div class='alert alert-danger' role="alert" id="alerta">
					<i class="fas fa-exclamation-triangle"></i>
					<b>Error</b>, no se pudo asignar la tarea, intenta nuevamente
				</div>
					`);
				deleteAlert();
			}

			var formData = $("#tarea-form").serialize(); // Obtener los datos del formulario
			$.ajax({
				url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
				type: "POST",
				data: formData,
				success: function(response) {
					if (response === 'error') {
						$("#form-result").val("");
						$("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
							<i class="fas fa-exclamation-triangle"></i>
							<b>Error</b>, no se pudo asignar la tarea, intenta nuevamente
						</div>
							`);
						deleteAlert();
					}else if(response === 'campos vacios'){
						$("#form-result").val("");
						$("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
							<i class="fas fa-exclamation-triangle"></i>
							<b>Error</b>, Rellena los campos vacios e intenta nuevamente
						</div>
							`);
						deleteAlert();
					}else{
						$("#form-result").val("");
						$("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
							<i class="fas fa-check-circle"></i>
							Nueva tarea asignada correctamente
						</div>
							`);

						deleteAlert();
						/*setTimeout(function() {
							location.reload();
						}, 1600);*/
					}
				}
			});

		});
	});

	function deleteAlert() {
		setTimeout(function() {
			var alert = $('#alerta');
			alert.fadeOut('slow', function() {
				alert.remove();
			});
		}, 1500);
	}
</script>