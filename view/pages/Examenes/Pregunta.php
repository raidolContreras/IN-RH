<?php
if (isset($_GET['pregunta'])) {
	$Evaluaciones = ControladorFormularios::ctrVerPreguntas('idPregunta', $_GET['pregunta']);
	if (empty($Evaluaciones)) {
		echo '<script>window.location.href="Evaluaciones"</script>';
	}
}
?>
<link rel="stylesheet" href="assets/vendor/summernote/css/summernote-bs4.css">
<div class="container-fluid dashboard-content">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<form id="pregunta-form" class="container mt-4">
							<div class="form-row">
								<div class="col-md-12 p-0">
									<div class="form-group">

										<!---->
										<label class="control-label sr-only" for="pregunta">Descripciones:</label>
										<textarea class="form-control texteditor" name="pregunta" id="pregunta" rows="3" placeholder="Describe la pregunta">
											
										</textarea>
										<!---->

									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="tipo_pregunta">Tipo de pregunta:</label>
										<div class="input-group">
											<select class="form-control selectpicker" name="tipo_pregunta" id="tipo_pregunta">
												<option>Elije el tipo de pregunta</option>
												<option value="opcion_multiple">Opción multiple</option>
												<option value="escala">Escala</option>
												<option value="abierta">Abierta</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group float-right">
								<input type="hidden" name="examen" value="<?php echo $_GET['pregunta']; ?>">
								<button type="button" class="btn btn-success rounded " id="pregunta-btn">
									Crear pregunta
								</button>
								<a href="Evaluaciones" class="btn btn-danger rounded ">
									Cancelar
								</a>
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
		$("#pregunta-btn").click(function() {
		var contenidoEditor = tinymce.get('pregunta').getContent();
		$("#pregunta").val(contenidoEditor);
		var formData = $("#pregunta-form").serialize(); // Obtener los datos del formulario

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
						  <b>Error</b>, no se creo la pregunta, intenta nuevamente
						</div>
							`);
						deleteAlert();
					}else if (response === 'campos vacios') {
						$("#form-result").val("");
						$("#form-result").html(`
						<div class='alert alert-warning' role="alert" id="alerta">
						  <i class="fas fa-check-circle"></i>
						  Debes de completar los campos
						</div>
							`);
						deleteAlert();
					}else{
						$("#form-result").val("");
						$("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
						  <i class="fas fa-check-circle"></i>
						  Nueva pregunta creada
						</div>
							`);
						deleteAlert();
						window.location.href='Pregunta&pregunta='+response
					}

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
	});
</script>