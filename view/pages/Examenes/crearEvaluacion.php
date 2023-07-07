<?php
$titulo = '';
$descripcion = '';
$tiempo_limite = null;
$intentos_maximos = null;
$fecha_inicio = null;
$fecha_fin = null;
$idExamen = 0;

if (isset($_GET['evaluacion'])) {
	$Evaluaciones = ControladorFormularios::ctrVerEvaluaciones('idExamen', $_GET['evaluacion']);
	if (!empty($Evaluaciones)) {
		$titulo = $Evaluaciones['titulo'];
		$idExamen = $_GET['evaluacion'];
		if ($Evaluaciones['Descripcion'] != null) {
			$descripcion = $Evaluaciones['Descripcion'];
		}
		if ($Evaluaciones['tiempo_limite'] != null) {
			$tiempo_limite = $Evaluaciones['tiempo_limite'];
		}
		if ($Evaluaciones['intentos_maximos'] != null) {
			$intentos_maximos = $Evaluaciones['intentos_maximos'];
		}
		if ($Evaluaciones['fecha_inicio'] != null) {
			$fecha_inicio = date('Y-m-d\TH:i', strtotime($Evaluaciones['fecha_inicio']));
		}
		if ($Evaluaciones['fecha_fin'] != null) {
			$fecha_fin = date('Y-m-d\TH:i', strtotime($Evaluaciones['fecha_fin']));
		}
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
						<form id="examen-form" class="container mt-4">
							<div class="form-row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="titulo">Nombre de la evaluación:</label>
										<input type="text" class="form-control" id="titulo" name="titulo" value='<?php echo $titulo; ?>' required>
									</div>
								</div>
								<div class="col-md-12 p-0">
									<div class="form-group">

										<!---->
										<label class="control-label sr-only" for="summernote">Descripciones:</label>
										<textarea class="form-control texteditor" name="mensaje" id="mensaje" rows="3" placeholder="Describe las instrucciones">
											<?php echo $descripcion; ?>
										</textarea>
										<!---->

									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="tiempo_limite">Límite de tiempo (min):</label>
										<div class="input-group">
											<input class="form-control" type="text" pattern="[0-9]+" id="tiempo_limite" name="tiempo_limite" value='<?php echo $tiempo_limite; ?>' oninput="this.value=this.value.replace(/[^0-9]/g,'');" disabled>
											<div class="input-group-append">
												<div class="input-group-text">
													<?php if ($tiempo_limite != null): ?>
														<input type="checkbox" id="check_tiempo_limite" checked>
													<?php else: ?>
														<input type="checkbox" id="check_tiempo_limite">
													<?php endif ?>
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
											<input type="hidden" name="idExamen" id="idExamen" value="<?php echo $idExamen; ?>">
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
		var mensaje = '';
		var error = '';
		var id = document.getElementById("idExamen");
		if (id.value !== '0') {

			mensaje = `<div class='alert alert-success' role="alert" id="alerta">
						<i class="fas fa-check-circle"></i>
						Se actualizó el examen <p class='Titulo'>"`;
			error = `<div class='alert alert-danger' role="alert" id="alerta">
						<i class="fas fa-exclamation-triangle"></i>
						<b>Error</b>, no se pudo actualizar el examen, intenta nuevamente.
					</div>`;

		}else{
			mensaje = `<div class='alert alert-success' role="alert" id="alerta">
							<i class="fas fa-check-circle"></i>
							Se creo el examen <p class='Titulo'>"`;
			error = `<div class='alert alert-danger' role="alert" id="alerta">
						<i class="fas fa-exclamation-triangle"></i>
						<b>Error</b>, no se crear el examen, intenta nuevamente.
					</div>`;
		}

		var currentDate = obtenerFechaActual(); // Obtener la fecha actual

		$('#check_tiempo_limite').on('change', function() {
			if (this.checked) {
				$('#tiempo_limite').prop('disabled', false).val('10');
			} else {
				$('#tiempo_limite').prop('disabled', true).val('');
			}
		});

		$('#check_fecha_inicio').on('change', function() {
			if (this.checked) {
				$('#fecha_inicio').prop('disabled', false).val(currentDate);
			} else {
				$('#fecha_inicio').prop('disabled', true).val('');
			}
		});

		$('#check_fecha_fin').on('change', function() {
			if (this.checked) {
				$('#fecha_fin').prop('disabled', false).val(currentDate);
			} else {
				$('#fecha_fin').prop('disabled', true).val('');
			}
		});

		$('#check_intentos_maximos').on('change', function() {
			if (this.checked) {
				$('#intentos_maximos').prop('disabled', false).val('1');
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
						$("#form-result").html(mensaje+response+`".</p>
						</div>
							`);
						deleteAlert();
						setTimeout(function() {
							location.href = 'Evaluaciones';
						}, 900);
					}else{
						$("#form-result").val("");
						$("#form-result").html(error);

						deleteAlert();
					}

				}
			});
		});

	});



	function obtenerFechaActual() {
		let date = new Date();
		let year = date.getFullYear();
		let month = ('0' + (date.getMonth() + 1)).slice(-2);
		let day = ('0' + date.getDate()).slice(-2);

		let currentDate = `${year}-${month}-${day}T00:00`; // Formato de fecha y hora para input datetime-local
		return currentDate;
	}

	function deleteAlert() {
		setTimeout(function() {
			var alert = $('#alerta');
			alert.fadeOut('slow', function() {
				alert.remove();
			});
		}, 800);
	}
<?php if ($tiempo_limite != null): ?>
		$('#check_tiempo_limite').prop('checked', true);
        $('#tiempo_limite').prop('disabled', false).val('<?php echo $tiempo_limite; ?>');
<?php endif ?>
<?php if ($intentos_maximos != null): ?>
		$('#check_intentos_maximos').prop('checked', true);
        $('#intentos_maximos').prop('disabled', false).val('<?php echo $intentos_maximos; ?>');
<?php endif ?>
<?php if ($fecha_inicio != null): ?>
		$('#check_intentos_maximos').prop('checked', true);
        $('#fecha_inicio').prop('disabled', false).val('<?php echo $fecha_inicio; ?>');
<?php endif ?>
<?php if ($fecha_fin != null): ?>
		$('#check_intentos_maximos').prop('checked', true);
        $('#fecha_fin').prop('disabled', false).val('<?php echo $fecha_fin; ?>');
<?php endif ?>

</script>