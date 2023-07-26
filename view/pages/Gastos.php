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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="container-fluid dashboard-content">
	<div class="container">
		<div class="card mx-3">
			<div class="card-header">
				Resumen de gastos
				<button type="button" class="btn btn-outline-primary rounded float-right" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-plus"></i> Agregar gastos</button>
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
							<tr>
								<td>Juanito</td>
								<td>17/07/2023</td>
								<td>$ 2,250.00</td>
								<td>Combustible</td>
								<td><span class="badge badge-success-dot"><span class="badge-dot badge-success"></span>Aprobado</span></td>
								<td>
									<div class="dropdown">
										<button class="btn btn-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fas fa-ellipsis-v"></i>
										</button>
										<div class="dropdown-menu mr-0" aria-labelledby="dropdownMenuButton">
											<a class="dropdown-item" href="#"><i class="fas fa-edit"></i> Editar</a>
											<a class="dropdown-item" href="#"><i class="fas fa-trash"></i> Eliminar</a>
											<a class="dropdown-item" href="#">
											<i class="fas fa-user-plus"></i> Aprobar</a>
										</div>
									</div>
								</td>
							</tr>
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
				<div class="row" style="align-items: center;">
					<form class="col-xl-6">
						<div class="row">
							<div class="form-group col-xl-12">
								<label for="recipient-name" class="col-form-label">Categoría:</label>
								<select class="form-control" id="categorias">
									<option value="">Selecciona una categoría</option>
									<option value="Vivienda">Vivienda</option>
									<option value="Alimentación">Alimentación</option>
									<option value="Transporte">Transporte</option>
									<option value="Salud">Salud</option>
									<option value="Educación">Educación</option>
									<option value="Entretenimiento">Entretenimiento</option>
									<option value="Ropa y calzado">Ropa y calzado</option>
									<option value="Ahorros e inversiones">Ahorros e inversiones</option>
									<option value="Gastos de viaje">Gastos de viaje</option>
									<option value="Seguros">Seguros</option>
								</select>
							</div>
							<div class="form-group col-xl-12">
								<label for="message-text" class="col-form-label">Nombre del vendedor:</label>
								<input type="text" class="form-control" name="nameVendedor" id="nameVendedor">
							</div>
							<div class="form-group col-xl-6">
								<label for="recipient-name" class="col-form-label">Divisas:</label>
								<select class="form-control" id="categorias">
									<option value="">Selecciona una divisa</option>
									<option value="MXN">MXN (peso mexicano)</option>
								</select>
							</div>
							<div class="form-group col-xl-6">
								<label for="message-text" class="col-form-label">Importe total:</label>
								<input type="number" class="form-control" name="nameVendedor" id="nameVendedor">
							</div>
							<div class="form-group col-xl-6">
								<label for="message-text" class="col-form-label">Importe del IVA:</label>
								<input type="number" class="form-control" name="nameVendedor" id="nameVendedor">
							</div>
							<div class="form-group col-xl-6">
								<label for="message-text" class="col-form-label">Fecha del documento:</label>
								<input type="date" class="form-control" name="nameVendedor" id="nameVendedor">
							</div>
							<div class="form-group col-xl-12">
								<label for="message-text" class="col-form-label">Descripción:</label>
								<textarea class="form-control" id="message-text"></textarea>
							</div>
							<div class="form-group col-xl-12">
								<label for="message-text" class="col-form-label">Referencia interna:</label>
								<input type="text" class="form-control" name="nameVendedor" id="nameVendedor" placeholder="Agregar una referencia interna (opcional)">
							</div>
							<input type="hidden" name="CrearGasto" id="CrearGasto">
						</div>
					</form>
					<div class="col-xl-6">
						<form class="dropzone my-3" id="documentos-dropzone" enctype="multipart/form-data">
							<input type="hidden" id="idTarea" name="idTarea" value="<?php echo $tareas[0]['idTareas']; ?>">
							<div class="dz-message">
								Arrastra y suelta archivos aquí o haz clic para seleccionar archivos para cargar.
								<p class="subtitulo-sup">Tipos de archivo permitidos .xlsx,.xls,.pdf (Tamaño máximo 10 MB)</p>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary rounded" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary rounded">Subir gasto</button>
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
});
$('#exampleModal').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) // Button that triggered the modal
	var recipient = button.data('whatever') // Extract info from data-* attributes
	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	var modal = $(this)
	modal.find('#CrearGasto').val(recipient)
})
</script>