<link rel="stylesheet" href="assets/vendor/summernote/css/summernote-bs4.css">
<div class="container-fluid dashboard-content">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<div id="form-result"></div>
						<form id="examen-form" class="container mt-4">
							<div class="form-row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="titulo">Nombre de la evaluación:</label>
										<input type="text" class="form-control" id="titulo" name="titulo" required>
									</div>
								</div>
								<div class="col-md-12 p-0">
									<div class="form-group">
										<label class="control-label sr-only" for="summernote">Descripciones:</label>
										<textarea class="form-control" id="summernote" name="editordata" rows="6" placeholder="Escribe descripciones"></textarea>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="tiempo_limite">Límite de tiempo (min):</label>
										<div class="input-group">
											<input class="form-control" type="text" pattern="[0-9]+" id="tiempo_limite" name="tiempo_limite" oninput="this.value=this.value.replace(/[^0-9]/g,'');" disabled>
											<div class="input-group-append">
												<div class="input-group-text">
													<input type="checkbox" id="check_tiempo_limite">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="fecha_inicio">Fecha de inicio:</label>
										<div class="input-group">
											<input class="form-control" type="datetime-local" id="fecha_inicio" name="fecha_inicio" disabled>
											<div class="input-group-append">
												<div class="input-group-text">
													<input type="checkbox" id="check_fecha_inicio">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="fecha_fin">Fecha de fin:</label>
										<div class="input-group">
											<input class="form-control" type="datetime-local" id="fecha_fin" name="fecha_fin" disabled>
											<div class="input-group-append">
												<div class="input-group-text">
													<input type="checkbox" id="check_fecha_fin">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="intentos_maximos">Límite de intentos:</label>
										<div class="input-group">
											<input class="form-control" type="text" pattern="[0-9]+" id="intentos_maximos" name="intentos_maximos" oninput="this.value=this.value.replace(/[^0-9]/g,'');" disabled>
											<div class="input-group-append">
												<div class="input-group-text">
													<input type="checkbox" id="check_intentos_maximos">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="hidden" name="examen" value="1">
								<button type="button" class="btn btn-primary rounded btn-block" id="examen-btn">Crear examen</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/vendor/summernote/js/summernote-bs4.js"></script>
<script>
	$(document).ready(function() {
		$('.js-example-basic-multiple').select2({ tags: true });
	});

	$(document).ready(function() {
		$('#summernote').summernote({
			height: 300
		});
	});

	$(document).ready(function() {
		$('#check_tiempo_limite').on('change', function() {
			if (this.checked) {
				$('#tiempo_limite').prop('disabled', false).val('');
			} else {
				$('#tiempo_limite').prop('disabled', true).val('');
			}
		});

		$('#check_fecha_inicio').on('change', function() {
			if (this.checked) {
				$('#fecha_inicio').prop('disabled', false).val('');
			} else {
				$('#fecha_inicio').prop('disabled', true).val('');
			}
		});

		$('#check_fecha_fin').on('change', function() {
			if (this.checked) {
				$('#fecha_fin').prop('disabled', false).val('');
			} else {
				$('#fecha_fin').prop('disabled', true).val('');
			}
		});

		$('#check_intentos_maximos').on('change', function() {
			if (this.checked) {
				$('#intentos_maximos').prop('disabled', false).val('');
			} else {
				$('#intentos_maximos').prop('disabled', true).val('');
			}
		});
	});
</script>
