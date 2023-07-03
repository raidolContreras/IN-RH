<?php $tareas = ControladorFormularios::ctrVerTareas("idTareas", $_GET['tarea']); 
$empleado = ControladorEmpleados::ctrVerEmpleados('idEmpleados', $tareas[0]['Empleados_idEmpleados']);
$nombre = mb_strtoupper($empleado['lastname']." ".$empleado['name']);
?>
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
			<div class="col-xl-12">
				<div class="card p-3">
						<form id="tarea-form">
							<div class="row">
								<div class="col-xl-6">
									<label for="nameTarea">Nombre de la tarea</label>
									<p class="titulo"><?php echo mb_strtoupper($tareas[0]['nameTarea']) ?></p>
								</div>
								<div class="col-xl-6">
									<label for="descripcion">Descripción de la tarea</label>
									<p class="titulo"><?php echo mb_strtoupper($tareas[0]['descripcion']) ?></p>
								</div>
								<div class="col-xl-6">
									<label for="empleado">Asignado a</label>
									<p class="titulo"><?php echo $nombre ?></p>
								</div>
								<div class="col-xl-6">
									<label for="vencimiento">Vencimiento</label>
									<p class="titulo"><?php echo date('d/m/Y', strtotime($tareas[0]['Vencimiento'])) ?></p>
								</div>
							</div>
						</form>
						<div class="row mt-3">
							<div class="col-xl-12 card">
								<form class="dropzone my-3" id="documentos-dropzone" enctype="multipart/form-data">
									<input type="hidden" id="idTarea" name="idTarea" value="<?php echo $tareas[0]['idTareas']; ?>">
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
var idTarea = document.getElementById("idTarea");
Dropzone.autoDiscover = false;

$(document).ready(function() {
		var myDropzone = new Dropzone("#documentos-dropzone", {
			url: "ajax/upload.documents.php",
			type: "POST",
			data: idTarea,
			paramName: "file",
			maxFilesize: 10,
			acceptedFiles: ".xlsx,.xls,.pdf",
			addRemoveLinks: true,
			dictRemoveFile: "Eliminar archivo",
			autoProcessQueue: false // Habilita la carga automática de archivos
		});
		
		$("#submit-btn").click(function() {
				myDropzone.processQueue();

				myDropzone.on("success", function(file, response) {
						$("#form-result").val("");
					if (response === "error_tamano") {
						// Mensaje de error: tamaño de archivo excedido
						$("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
							<i class="fas fa-exclamation-triangle"></i>
							<b>Error:</b>, Tamaño de archivo excedido.
						</div>
							`);
						deleteAlert();
					} else if (response === "error_tipo") {
						// Mensaje de error: tipo de archivo no permitido
						$("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
							<i class="fas fa-exclamation-triangle"></i>
							<b>Error:</b>, Tipo de archivo no permitido.
						</div>
							`);
						deleteAlert();
					} else {
						$("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
							<i class="fas fa-check-circle"></i>
							Documento(s) cargados correctamente.
						</div>
							`);

						deleteAlert();
						setTimeout(function() {
							location.href = 'Tareas';
						}, 1600);
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