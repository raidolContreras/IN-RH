<link rel="stylesheet" href="assets/vendor/summernote/css/summernote-bs4.css">
<div class="container-fluid dashboard-content">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
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

										<!---->
										<label class="control-label sr-only" for="summernote">Descripciones:</label>
										<textarea class="form-control texteditor" name="mensaje" id="mensaje" rows="3" placeholder="Describe las instrucciones"></textarea>
										<!---->

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

<script>
	tinymce.init({
	selector: '.texteditor',
	plugins: 'advlist lists',
	menubar: '',
	toolbar: 'bold italic underline | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat'

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

		$("#examen-btn").click(function() {
		var contenidoEditor = tinymce.get('mensaje').getContent();
		$("#mensaje").val(contenidoEditor);

		if ($("#mensaje").val() === "") {
			$("#mensaje").val("null");
		}
		
		if ($("#tiempo_limite").val() === "") {
			$("#tiempo_limite").val("null");
		}
		
		if ($("#fecha_inicio").val() === "") {
			$("#fecha_inicio").val("null");
		}
		
		if ($("#fecha_fin").val() === "") {
			$("#fecha_fin").val("null");
		}
		
		if ($("#intentos_maximos").val() === "") {
			$("#intentos_maximos").val("null");
		}
		
		var formData = $("#examen-form").serialize(); // Obtener los datos del formulario

			$.ajax({
				url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
				type: "POST",
				data: formData,
				success: function(response) {

					if (response !== 'error') {
						$("#form-result").val("");
						$("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
							<i class="fas fa-check-circle"></i>
							Se creo el examen <p class='Titulo'>"`+response+`".</p>
						</div>
							`);
						deleteAlert();
						setTimeout(function() {
							location.href = 'Evaluaciones';
						}, 900);
					}else{
						$("#form-result").val("");
						$("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
							<i class="fas fa-exclamation-triangle"></i>
							<b>Error</b>, no se crear el examen, intenta nuevamente.
						</div>
							`);

						deleteAlert();
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
			}, 800);
		}
</script>
