<?php $gastos = ControladorFormularios::ctrVerGastos(null, null); 
	$divisas = ControladorFormularios::ctrVerDivisa(null, null);
	$categorias = ControladorFormularios::ctrVerCategoria(null, null);
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />
<style>
	.dropzone {
		border: 2px dashed #ccc;
		padding: 60px;
	}

	.dropzone .dz-message {
		text-align: center;
		font-size: 1.5em;
		color: #999;
	}
</style>
<div class="container-fluid dashboard-content">
	<div class="container">
		<div class="card mx-3">
			<div class="card-header">
				Resumen de gastos
				<button type="button" class="btn btn-outline-primary rounded float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Agregar gastos</button>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table gastos">
						<thead>
							<tr>
								<th>Proveedor</th>
								<th width="150">Fecha del documento</th>
								<th>Importe</th>
								<th>Categoría</th>
								<th width="50">Estado</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($gastos as $gasto):
								$divisa = ControladorFormularios::ctrVerDivisa('idDivisa', $gasto['divisa']);
								$categoria = ControladorFormularios::ctrVerCategoria('idCategoria', $gasto['categoria']);
							?>
							<tr>
								<td><button class="btn btn-in-consulting" data-toggle="modal" data-target="#gasto<?php echo $gasto['idGastos'] ?>"><span><?php echo $gasto['nameVendedor'] ?></span></button></td>
								<td><?php echo date('d/m/Y', strtotime($gasto['fechaDocumento'])) ?></td>
								<td><?php echo ControladorFormularios::formatearNumero($gasto['importeTotal'], $divisa['divisa']) ?></td>
								<td><?php echo $categoria['nameCategoria'] ?></td>
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
								<td>
									<?php if ($gasto['status'] == 0): ?>
										<div class="btn-group dropright">
											<button class="btn btn-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fas fa-ellipsis-v"></i>
											</button>
											<div class="dropdown-menu mr-0" aria-labelledby="dropdownMenuButton">
												<button
													class="dropdown-item btn btn-link float-left"
													data-toggle="modal"
													data-target="#delGasto"
													data-del="<?php echo $gasto['idGastos'] ?>"
													style="font-size: 13px;">
													<i class="fas fa-trash"></i> Eliminar
												</button>
											</div>
										</div>
									<?php endif ?>
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

<?php require_once "view/pages/Gastos/ActualizarGastos.php"; ?>
<?php require_once "view/pages/Gastos/AddGastos.php"; ?>
<?php require_once "view/pages/Gastos/DelGastos.php"; ?>

<!-- Modal de confirmación de eliminación -->
<div class="modal fade" id="modalEliminarDocumento" tabindex="-1" role="dialog" aria-labelledby="modalEliminarDocumentoLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalEliminarDocumentoLabel">Eliminar documento</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>¿Estás seguro de que deseas eliminar este documento?</p>
			</div>
			<form id="eliminarDocumento-form">
				<input type="hidden" id="eliminarDocumento" name="eliminarDocumento">
				<input type="hidden" id="eliminarDocumentoGasto" name="eliminarDocumentoGasto">
				<input type="hidden" id="eliminarNameDocumento" name="eliminarNameDocumento">
			</form>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-danger" id="eliminarDocumento-btn">Eliminar</button>
			</div>
		</div>
	</div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

<script>

const errorMessages = {
	'error-categoria': 'El campo de categoría está vacío. Por favor, selecciona una categoría.',
	'error-nameVendedor': 'El campo del nombre del vendedor está vacío. Por favor, ingresa el nombre del vendedor.',
	'error-divisa': 'El campo de la divisa está vacío. Por favor, selecciona una divisa.',
	'error-importeTotal': 'El campo de importe total está vacío. Por favor, ingresa el importe total.',
	'error-importeIVA': 'El campo del importe del IVA está vacío. Por favor, ingresa el importe del IVA.',
	'error-fechaDocumento': 'El campo de fecha de documento está vacío. Por favor, selecciona la fecha del documento.',
	'error-descripcionGasto': 'El campo de descripción está vacío. Por favor, ingresa una descripción del gasto.'
};

Dropzone.autoDiscover = false;

$(document).ready(function() {
	var myDropzone = new Dropzone("#documentos-dropzone", {
		url: "ajax/ajax.formularios.php",
		type: "POST",
		paramName: "file",
		maxFilesize: 10,
		acceptedFiles: ".xlsx,.xls,.pdf",
		addRemoveLinks: true,
		dictRemoveFile: "Eliminar archivo",
		parallelUploads: 100,
		maxFiles: 10,
		uploadMultiple: true,
		autoProcessQueue: false // Habilita la carga automática de archivos
	});

	var idGasto; // Variable para almacenar el ID del gasto

	$("#subirGasto-btn").click(function() {
		var formData = $("#subirGasto-form").serialize(); // Obtener los datos del formulario
		$.ajax({
			url: "ajax/ajax.formularios.php",
			type: "POST",
			data: formData,
			success: function(response) {
				$("#form-result").val("");
				if (response === 'error-categoria' || response === 'error-nameVendedor' || response === 'error-divisa' ||response === 'error-importeTotal' || response === 'error-importeIVA' || response === 'error-fechaDocumento'|| response === 'error-descripcionGasto') {
					showErrorAlert(response);
					deleteAlert();
				}else {
					$("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
						<i class="fas fa-check-circle"></i>
						Gasto subido exitosamente
						</div>
						`);

					// Almacenar el ID del gasto en la variable idGasto
					idGasto = response;

					myDropzone.processQueue();
					// Vaciar los campos del formulario
					$("#categoria").val("");
					$("#nameVendedor").val("");
					$("#divisa").val("");
					$("#importeTotal").val("");
					$("#importeIVA").val("");
					$("#fechaDocumento").val("");
					$("#descripcionGasto").val("");
					$("#referenciaInterna").val("");

					// Limpiar el Dropzone
					myDropzone.removeAllFiles();
					deleteAlert();
					setTimeout(function() {
						location.href = 'Gastos';
					}, 900);
				}
			}
		});
	});

	$('#eliminarGasto-btn').click(function() {
		var delData = $("#eliminarGasto-form").serialize();
		$.ajax({
			url: "ajax/ajax.formularios.php",
			type: "POST",
			data: delData,
			success: function(response) {
				$("#form-result").val("");
				if (response === 'ok' || response === 'No se pudo eliminar la carpeta o la carpeta no existe.') {
					$("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
							<i class="fas fa-check-circle"></i>
							Gasto eliminado exitosamente.
						</div>
					`);
					deleteAlert();
					setTimeout(function() {
						location.href = 'Gastos';
					}, 900);
				}
				else {
					$("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
							<i class="fas fa-exclamation-triangle"></i>
							<b>Error</b>, no se pudo eliminar el gasto, intentalo nuevamente.
						</div>
					`);
					deleteAlert();
				}
			}
		});
	});

	$('#eliminarDocumento-btn').click(function() {
		var delDoc = $("#eliminarDocumento-form").serialize();
		$.ajax({
			url: "ajax/ajax.formularios.php",
			type: "POST",
			data: delDoc,
			success: function(response) {
				$("#form-result").val("");
				if (response === 'ok') {
					$("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
							<i class="fas fa-check-circle"></i>
							Documento eliminado exitosamente.
						</div>
					`);
					deleteAlert();
					setTimeout(function() {
						location.href = 'Gastos';
					}, 900);
				}
				else {
					$("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
							<i class="fas fa-exclamation-triangle"></i>
							<b>Error</b>, no se pudo eliminar el documento, intentalo nuevamente.
						</div>
					`);
					deleteAlert();
				}
			}
		});
	});

	// Configuración del evento 'sending' del Dropzone
	myDropzone.on("sending", function(file, xhr, formData) {
		// Solo agregar el campo idGasto si se cumple la condición response !== "error"
		if (idGasto !== 'error') {
			formData.append("idGasto", idGasto);
		}
	});

	// Al hacer clic en el enlace de eliminar documento
	$('.btn-eliminar-documento').click(function(e) {
		e.preventDefault();
		// Obtener los IDs del gasto y el documento que se eliminará
		var documentoId = $(this).data('documento-id');
		var gastosid = $(this).data('gastos-id');
		var eliminarNameDocumento = $(this).data('name');
		
		var eliminarDocumento = $('#eliminarDocumento');
		var eliminarDocumentoGasto = $('#eliminarDocumentoGasto');
		var nameDocumento = $('#eliminarNameDocumento');
		
		// Al hacer clic en el botón "Eliminar" dentro del modal de confirmación
		$('#eliminarDocumento-btn').click(function() {
				// Aquí puedes agregar el código para procesar la eliminación del documento si es necesario
		});

		console.log(documentoId);
		console.log(gastosid);
		console.log(eliminarNameDocumento);
		// Mostrar el modal de confirmación
		$('#modalEliminarDocumento').modal('show');

		eliminarDocumento.val(documentoId);
		eliminarDocumentoGasto.val(gastosid);
		nameDocumento.val(eliminarNameDocumento);

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

// Función para mostrar el mensaje de error
function showErrorAlert(response) {
	const errorMessage = errorMessages[response];
	if (errorMessage) {
		$("#form-result").html(`
			<div class='alert alert-danger' role="alert" id="alerta">
				<i class="fas fa-exclamation-triangle"></i>
				<b>Error</b>, ${errorMessage}
			</div>
		`);
		deleteAlert();
	}
}

</script>