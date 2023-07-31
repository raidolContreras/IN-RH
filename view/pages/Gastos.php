<?php $gastos = ControladorFormularios::ctrVerGastos(null, null); ?>
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
								<th>Estado</th>
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
									<div class="dropdown">
										<button class="btn btn-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fas fa-ellipsis-v"></i>
										</button>
										<div class="dropdown-menu mr-0" aria-labelledby="dropdownMenuButton">
											<!-- <a class="dropdown-item" href="#"><i class="fas fa-edit"></i> Editar</a>
											<a class="dropdown-item" href="#"><i class="fas fa-user-plus"></i> Aprobar</a>-->
											<a class="dropdown-item" href="#"><i class="fas fa-trash"></i> Eliminar</a>
										</div>
									</div>
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
<div
	class="modal fade"
	id="exampleModal"
	tabindex="-1"
	role="dialog"
	aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<?php $divisas = ControladorFormularios::ctrVerDivisa(null, null); ?>
	<?php $categorias = ControladorFormularios::ctrVerCategoria(null, null); ?>
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row" style="flex-direction: column;">
					<p class="titulo-tablero mb-0" id="exampleModalLabel">Añadir un nuevo gasto</p>
					<p class="subtitulo-sup" id="exampleModalLabel">Llena el formulario con los detalles del gasto</p>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="row" style="align-items: center;" id="subirGasto-form" enctype="multipart/form-data">
					<div class="col-xl-6">
						<div class="row">
							<div class="form-group col-xl-12">
								<label for="recipient-name" class="col-form-label">Categoría:</label>
								<select class="form-control" id="categoria" name="categoria">
									<option value="">Selecciona una categoría</option>
									<?php foreach ($categorias as $categoria): ?>
										<option value="<?php echo $categoria['idCategoria'] ?>"><?php echo $categoria['nameCategoria'] ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group col-xl-12">
								<label for="message-text" class="col-form-label">Nombre del vendedor:</label>
								<input type="text" class="form-control" name="nameVendedor" id="nameVendedor">
							</div>
							<div class="form-group col-xl-6">
								<label for="recipient-name" class="col-form-label">Divisas:</label>
								<select class="form-control" id="divisa" name="divisa">
									<option value="">Selecciona una divisa</option>
									<?php foreach ($divisas as $divisa): ?>
										<option value="<?php echo $divisa['idDivisa'] ?>"><?php echo $divisa['divisa']." (".$divisa['nameDivisa'].")"; ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group col-xl-6">
								<label for="message-text" class="col-form-label">Importe total:</label>
								<input type="number" class="form-control" name="importeTotal" id="importeTotal">
							</div>
							<div class="form-group col-xl-6">
								<label for="message-text" class="col-form-label">Importe del IVA:</label>
								<input type="number" class="form-control" name="importeIVA" id="importeIVA">
							</div>
							<div class="form-group col-xl-6">
								<label for="message-text" class="col-form-label">Fecha del documento:</label>
								<input type="date" class="form-control" name="fechaDocumento" id="fechaDocumento">
							</div>
							<div class="form-group col-xl-12">
								<label for="message-text" class="col-form-label">Descripción:</label>
								<textarea class="form-control" id="descripcionGasto" name="descripcionGasto"></textarea>
							</div>
							<div class="form-group col-xl-12">
								<label for="message-text" class="col-form-label">Referencia interna:</label>
								<input type="text" class="form-control" name="referenciaInterna" id="referenciaInterna" placeholder="Agregar una referencia interna (opcional)">
							</div>
							<input type="hidden" name="CrearGasto" id="CrearGasto">
						</div>
					</div>
					<div class="col-xl-6">
						<div class="dropzone my-3" id="documentos-dropzone">
							<div class="dz-message">
								Arrastra y suelta archivos aquí o haz clic para seleccionar archivos para cargar.
								<p class="subtitulo-sup">
									Tipos de archivo permitidos .xlsx,.xls,.pdf (Tamaño máximo 10 MB)
								</p>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary rounded" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary rounded" id="subirGasto-btn">Subir gasto</button>
			</div>
		</div>
	</div>
</div>

<?php foreach ($gastos as $gasto): 
	$divisa = ControladorFormularios::ctrVerDivisa('idDivisa', $gasto['divisa']);
	$categoria = ControladorFormularios::ctrVerCategoria('idCategoria', $gasto['categoria']);
	$importe = ControladorFormularios::formatearNumero($gasto['importeTotal'], $divisa['divisa']);
	$documentos = ControladorFormularios::ctrVerDocGastos('Gastos_idGastos', $gasto['idGastos']);
?>

	<div
	class="modal fade"
	id="gasto<?php echo $gasto['idGastos'] ?>"
	tabindex="-1"
	role="dialog"
	aria-labelledby="exampleModalLabel"
	aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<div class="row" style="flex-direction: column;">
						<p class="titulo-tablero mb-0" id="exampleModalLabel">Información del gasto: </p>
						<p class="subtitulo-sup" id="exampleModalLabel"><?php echo $gasto['nameVendedor']." (".$importe.")"; ?></p>
					</div>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<?php foreach ($documentos as $documento): ?>
						<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="card card-figure">
								<figure class="figure">
									<div class="figure-attachment">
										<span class="fa-stack fa-lg">
											<i class="fa fa-square fa-stack-2x text-primary"></i>
										<?php if ($documento['tipo'] == 'excel'): ?>
											<i class="fas fa-file-excel fa-stack-1x fa-inverse"></i>
										<?php else: ?>
											<i class="fa fa-file-pdf fa-stack-1x fa-inverse"></i>
										<?php endif ?>
										</span>
									</div>
									<figcaption class="figure-caption">
										<ul class="list-inline d-flex text-muted mb-0">
											<li class="list-inline-item text-truncate mr-auto">
												<a href="view/Gastos/<?php echo $gasto['idGastos'] ?>/<?php echo $documento['nameDocumento'] ?>" download><?php echo $documento['nameDocumento'] ?></a>
											</li>
										</ul>
									</figcaption>
								</figure>
							</div>
						</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endforeach ?>

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

	// Configuración del evento 'sending' del Dropzone
	myDropzone.on("sending", function(file, xhr, formData) {
		// Solo agregar el campo idGasto si se cumple la condición response !== "error"
		if (idGasto !== 'error') {
			formData.append("idGasto", idGasto);
		}
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