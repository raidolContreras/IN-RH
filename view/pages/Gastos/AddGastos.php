
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