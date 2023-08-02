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
						<div class="col-xl-6 col-12">
							<form id="actualizarGasto-form<?php echo $gasto['idGastos'] ?>" enctype="multipart/form-data">
								<div class="row" style="align-items: center;" >
									<div class="form-group col-xl-12">
										<label for="recipient-name" class="col-form-label">Categoría:</label>
										<select
											class="form-control"
											id="categoria"
											name="categoriaUpdate" 
											<?php echo $gasto['status'] != 0 ? 'disabled' : ''; ?>>
											<option value="">Selecciona una categoría</option>
											<?php foreach ($categorias as $categoria): ?>
												<?php if ($categoria['idCategoria'] == $gasto['categoria']): ?>
												<option value="<?php echo $categoria['idCategoria'] ?>" selected >
												<?php else: ?>
												<option value="<?php echo $categoria['idCategoria'] ?>">
												<?php endif ?>
												<?php echo $categoria['nameCategoria'] ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="form-group col-xl-12">
										<label for="message-text" class="col-form-label">Nombre del vendedor:</label>
										<input
											type="text"
											class="form-control"
											name="nameVendedorUpdate"
											id="nameVendedor"
											value="<?php echo $gasto['nameVendedor'] ?>" 
											<?php echo $gasto['status'] != 0 ? 'disabled' : ''; ?>>
									</div>
									<div class="form-group col-xl-6">
										<label for="recipient-name" class="col-form-label">Divisas:</label>
										<select
											class="form-control"
											id="divisa"
											name="divisaUpdate" 
											<?php echo $gasto['status'] != 0 ? 'disabled' : ''; ?>>
											<option value="">Selecciona una divisa</option>
											<?php foreach ($divisas as $divisa): ?>
												<?php if ($divisa['idDivisa'] == $gasto['divisa']): ?>
												<option value="<?php echo $divisa['idDivisa'] ?>" selected>
												<?php else: ?>
												<option value="<?php echo $divisa['idDivisa'] ?>">
												<?php endif ?>
												<?php echo $divisa['divisa']." (".$divisa['nameDivisa'].")"; ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="form-group col-xl-6">
										<label for="message-text" class="col-form-label">Importe total:</label>
										<input
											type="number"
											class="form-control"
											name="importeTotalUpdate"
											id="importeTotal"
											value="<?php echo $gasto['importeTotal'] ?>"
											<?php echo $gasto['status'] != 0 ? 'disabled' : ''; ?>>
									</div>
									<div class="form-group col-xl-6">
										<label for="message-text" class="col-form-label">Importe del IVA:</label>
										<input
											type="number"
											class="form-control"
											name="importeIVAUpdate"
											id="importeIVA"
											value="<?php echo $gasto['importeIVA'] ?>"
											<?php echo $gasto['status'] != 0 ? 'disabled' : ''; ?>>
									</div>
									<div class="form-group col-xl-6">
										<label for="message-text" class="col-form-label">Fecha del documento:</label>
										<input
											type="date"
											class="form-control"
											name="fechaDocumentoUpdate"
											id="fechaDocumento"
											value="<?php echo $gasto['fechaDocumento'] ?>"
											<?php echo $gasto['status'] != 0 ? 'disabled' : ''; ?>>
									</div>
									<div class="form-group col-xl-12">
										<label for="message-text" class="col-form-label">Descripción:</label>
										<textarea
											class="form-control"
											id="descripcionGasto"
											name="descripcionGastoUpdate" 
											<?php echo $gasto['status'] != 0 ? 'disabled' : ''; ?>><?php echo $gasto['descripcionGasto'] ?></textarea>
									</div>
									<div class="form-group col-xl-12">
										<label for="message-text" class="col-form-label">Referencia interna:</label>
										<input
											type="text"
											class="form-control"
											name="referenciaInternaUpdate"
											id="referenciaInterna"
											placeholder="Agregar una referencia interna (opcional)"
											value="<?php echo $gasto['referenciaInterna'] ?>" 
											<?php echo $gasto['status'] != 0 ? 'disabled' : ''; ?>>
									</div>
									<input
										type="hidden"
										name="actualizarGastoUpdate"
										id="actualizarGasto"
										value="<?php echo $gasto['idGastos'] ?>">
									<?php if ($gasto['status'] == 0): ?>
									<div class="form-group col-xl-12">
										<button type="button" id="actualizarGasto-btn<?php echo $gasto['idGastos'] ?>" class="btn btn-primary rounded btn-block">Actualizar Gasto</button>
									</div>
									<?php endif ?>
								</div>
							</form>
						</div>

							<?php if (empty($documentos)) {
								echo '
									<div class="col-xl-6 col-12 row figure-attachment p-3 rounded"
									style="justify-content: center; align-content: flex-start; justify-content: flex-start;"
									id="div'.$gasto['idGastos'].'">
									<div class="col-lg-6 col-sm-12">
										<center>Sin Documentos adjuntados</center>
									</div>
									';
							}else{
								echo '<div class="col-xl-6 col-12 row figure-attachment p-3 rounded" style="align-content: flex-start; justify-content: flex-start;" id="div'.$gasto['idGastos'].'">';
							}
							?>

							<?php if ($gasto['status'] == 0): ?>
							<div class="form-group col-xl-12 row" style="justify-content: center;">
								<form id="addDocNew-form<?php echo $gasto['idGastos'] ?>" class="col-9" enctype="multipart/form-data">
									<input type="hidden" name="addDocNew" id="addDocNew<?php echo $gasto['idGastos'] ?>" value="<?php echo $gasto['idGastos'] ?>">
									<input type="file" name="file" id="file<?php echo $gasto['idGastos'] ?>" class="form-control-file" accept=".pdf, .xls, .xlsx">
								</form>
								<button id="addDocNew-btn<?php echo $gasto['idGastos'] ?>" class="btn btn-outline-success rounded-circle px-2 py-0">
									<i class="fas fa-plus"></i>
								</button>
							</div>
							<?php endif ?>

							<?php foreach ($documentos as $documento): ?>
							<div class="col-lg-6 col-sm-12" id="<?php echo $documento['nameDocumento']; ?>">
								<div class="card card-figure">
									<?php if ($gasto['status'] == 0): ?>
										<div class="row mb-2" style="justify-content: flex-end;">
											<a href="#"
											class="btn btn-danger px-1 py-0 btn-eliminar-documento"
											data-documento-id="<?php echo $documento['idDocumento_Gasto'] ?>"
											data-gastos-id="<?php echo $gasto['idGastos'] ?>"
											data-name="<?php echo $documento['nameDocumento'] ?>">
											&times;
											</a>
										</div>
									<?php endif ?>
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
													<span>
														<?php if ($documento['tipo'] == 'excel'): ?>
															<i class="fas fa-file-excel"></i>
														<?php else: ?>
															<i class="fa fa-file-pdf"></i>
														<?php endif ?>
													</span>
													 <?php echo $documento['nameDocumento'] ?> 
												</li>
												<li class="list-inline-item">
													<a download="" href="view/Gastos/<?php echo $gasto['idGastos'] ?>/<?php echo $documento['nameDocumento'] ?>">
														<i class="fas fa-download "></i>
													</a>
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
	</div>

<script>
	
	$('#actualizarGasto-btn<?php echo $gasto['idGastos'] ?>').click(function() {
		var updateData = $("#actualizarGasto-form<?php echo $gasto['idGastos'] ?>").serialize();
		$.ajax({
			url: "ajax/ajax.formularios.php",
			type: "POST",
			data: updateData,
			success: function(response) {
				$("#form-result").val("");
				if (response === 'ok') {
					$("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
							<i class="fas fa-check-circle"></i>
							Gasto actualizado exitosamente.
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
							<b>Error</b>, no se pudo actualizar el gasto, intentalo nuevamente.
						</div>
					`);
					deleteAlert();
				}
			}
		});
	});


$('#addDocNew-btn<?php echo $gasto['idGastos'] ?>').click(function() {
    var addDocNew = document.getElementById('addDocNew<?php echo $gasto['idGastos'] ?>').value;
    var fileInput = document.getElementById('file<?php echo $gasto['idGastos'] ?>');
    var file = fileInput.files[0]; // Obtener el archivo del campo de entrada de archivos

    // Crear objeto FormData para enviar el archivo
    var formData = new FormData();
    formData.append('file', file);
    formData.append('addDocNew', addDocNew);

    $.ajax({
        url: "ajax/ajax.formularios.php",
        type: "POST",
        data: formData,
        contentType: false, // Importante: desactivar la configuración contentType para que jQuery configure automáticamente el encabezado
        processData: false, // Importante: desactivar el procesamiento de datos para que jQuery no convierta el objeto FormData en una cadena
        success: function(response) {
            $("#form-result").val("");
            if (response !== 'error') {
                $("#form-result").html(`
                    <div class='alert alert-success' role="alert" id="alerta">
                        <i class="fas fa-check-circle"></i>
                        Documento agregado exitosamente.
                    </div>
                `);
                deleteAlert();
                addDiv(response);
            } else {
                $("#form-result").html(`
                    <div class='alert alert-danger' role="alert" id="alerta">
                        <i class="fas fa-exclamation-triangle"></i>
                        <b>Error</b>, no se pudo agregar el documento, intentalo nuevamente.
                    </div>
                `);
                deleteAlert();
            }
        }
    });
});

</script>
<?php endforeach ?>