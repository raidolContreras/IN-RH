<?php
$Evaluaciones = ControladorFormularios::ctrVerPreguntas('idPregunta', $_GET['pregunta']);
?>
<style>
	.round-button {
	width: 30px;
	height: 30px;
	border-radius: 50%;
	border: none;
	background-color: #007bff;
	color: #fff;
	font-size: 15px;
	display: flex;
	align-items: center;
	justify-content: center;
	cursor: pointer;
}
.round-button:hover{
	background-color: #0651A2;
}
</style>
<div class="container-fluid dashboard-content">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-12">
				<div class="card rounded">
					<div class="card-header"><?php echo mb_strtoupper($Evaluaciones['pregunta']) ?></div>
					<div class="card-header">
						<div class="container mt-4">
							<div class="form-row" style="align-items: center; justify-content: center;">
								<div class="col-md-4 p-0">
									<div class="form-group">
										<label for="nRespuestas">Añadir opciones</label>
										<input type="text" class="form-control" id="nRespuestas" oninput="this.value=this.value.replace(/[^0-9]/g,'');" onchange="generarInputs()">
									</div>
								</div>
								<div class="col-md-1 p-0 ml-3">
									<button class="round-button">
										+
									</button>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body" id="respuestasContainer">
						<form class="row" id="respuesta-form"></form>
					</div>
					<div class="col-12 mt-3">
						<button class="btn btn-primary rounded float-right btn-registrar-respuestas"
										type="button"
										id="respuesta-btn"
										name="respuesta-btn">
							Registrar respuestas
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
var nRespuestas;
$(document).ready(function() {
	$(".btn-registrar-respuestas").hide();
	$("#respuesta-btn").click(function() {
		$("#form-result").val("");
		var formData = $("#respuesta-form").serialize(); // Obtener los datos del formulario
		const idPregunta = <?php echo $_GET['pregunta']; ?>;
		$.ajax({
			url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
			type: "POST",
			data: {formData:formData, numRespuestas:nRespuestas, idPregunta: idPregunta},
			success: function(response) {

				if (response === 'ok') {
					$("#form-result").html(`<div class='alert alert-success' role="alert" id="alerta">
					<i class="fas fa-check-circle"></i>
					Respuestas Creadas"
				</div>`);
					deleteAlert();
					setTimeout(function() {
						location.href = 'Evaluaciones';
					}, 900);
				}else{
					$("#form-result").html(`<div class='alert alert-danger' role="alert" id="alerta">
					<i class="fas fa-exclamation-triangle"></i>
					<b>Error</b>, No se crearon las respuestas, intenta nuevamente.
				</div>`);

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

<script src="assets/libs/js/opcion-multiple.js"></script>