<?php 

	$reuniones = ControladorFormularios::ctrVerReuniones("idReuniones", $_GET['reunion']);
	$postulante = ControladorFormularios::ctrVerPostulantes("idPostulantes", $reuniones['Postulantes_idPostulantes']);

?>

<div class="container-fluid dashboard-content ">
	<!-- ============================================================== -->
	<!-- pageheader	-->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header">
				<h2 class="pageheader-title">Reuniones</h2>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="Inicio" class="breadcrumb-link">IN Consulting México</a></li>
							<li class="breadcrumb-item"><a href="Vacantes" class="breadcrumb-link">Ofertas de empleo</a></li>
							<li class="breadcrumb-item">Postulantes (<?php echo $postulante['namePostulante'] ?>)</li>
							<li class="breadcrumb-item active" aria-current="page">Reuniones</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>

	<!-- ============================================================== -->
	<!-- end pageheader	-->
	<!-- ============================================================== -->
	<div class="ecommerce-widget">
		<!-- ============================================================== -->
		<!-- data table	-->
		<!-- ============================================================== -->
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div id="form-result"></div>
					<div class="container">
						<h1>Encuesta del entrevistador</h1>

						<form method="POST" id="reunion-form">

						  <div class="row">
							<div class="col">
							  <div class="form-group">
								<label for="pregunta1">¿Cómo calificaría la preparación del entrevistado para la entrevista?</label>
								<select class="form-control" id="pregunta1" name="pregunta1" required>
								  <option value="" disabled selected>Seleccione una opción</option>
								  <option value="1">Excelente</option>
								  <option value="2">Bueno</option>
								  <option value="3">Regular</option>
								  <option value="4">Malo</option>
								  <option value="5">Muy malo</option>
								</select>
							  </div>
							</div>
							<div class="col">
							  <div class="form-group">
								<label for="pregunta2">¿Cómo calificaría la actitud del entrevistado durante la entrevista?</label>
								<select class="form-control" id="pregunta2" name="pregunta2" required>
								  <option value="" disabled selected>Seleccione una opción</option>
								  <option value="1">Excelente</option>
								  <option value="2">Bueno</option>
								  <option value="3">Regular</option>
								  <option value="4">Malo</option>
								  <option value="5">Muy malo</option>
								</select>
							  </div>
							</div>
						  </div>
						  <div class="row">
							<div class="col">
							  <div class="form-group">
								<label for="pregunta3">¿Cómo calificaría la calidad de las respuestas del entrevistado?</label>
								<select class="form-control" id="pregunta3" name="pregunta3" required>
								  <option value="" disabled selected>Seleccione una opción</option>
								  <option value="1">Excelente</option>
								  <option value="2">Bueno</option>
								  <option value="3">Regular</option>
								  <option value="4">Malo</option>
								  <option value="5">Muy malo</option>
								</select>
							  </div>
							</div>
							<div class="col">
							  <div class="form-group">
								<label for="pregunta4">¿Recomendaría contratar al entrevistado?</label>
								<select class="form-control" id="pregunta4" name="pregunta4" required>
								  <option value="" disabled selected>Seleccione una opción</option>
								  <option value="1">Sí, definitivamente</option>
								  <option value="2">No estoy seguro</option>
								  <option value="3">No, definitivamente no</option>
								</select>
							  </div>
							</div>
						  </div>
						  <div class="row">
							<div class="col">
							  <div class="form-group">
								<label for="comentariosReunion">¿Tiene algún comentario adicional sobre el entrevistado?</label>
								<textarea class="form-control" id="comentariosReunion" name="comentariosReunion" rows="3"></textarea>
							  </div>
							</div>
						  </div>
						  <input type="hidden" name="reunion" value="<?php echo $_GET['reunion'] ?>">
						  <input type="hidden" name="postulante" value="<?php echo $reuniones['Postulantes_idPostulantes'] ?>">
						  <button id="submit-btn" type="submit" class="btn btn-primary">Enviar</button>
						</form>
					  </div>

				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$("#submit-btn").click(function(event) {
			event.preventDefault(); // Evitar el envío del formulario por defecto

			var formData = $("#reunion-form").serialize(); // Obtener los datos del formulario

			$.ajax({
				url: "ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
				type: "POST",
				data: formData,
				success: function(response) {
			    if (response.indexOf('ok') !== -1) {
		        // El servidor ha devuelto "ok" o alguna cadena que contenga "ok"
		        $("#reunion-form")[0].reset(); // Reiniciar el formulario
		        $("#form-result").parent().append(`
		            <div class='alert alert-success'>Se calificó la reunión con éxito</div>
		        `);
		    	}else {
		        // El servidor ha devuelto algo diferente a "ok"
		        $("#form-result").parent().append(`
		            <div class='alert alert-danger'><b>Error</b>, al calificar la reunión, intenta nuevamente</div>
		        `);
			    }
				}
			});
		});
	});
</script>