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
					<div class="card-header"><?php echo $Evaluaciones['pregunta'] ?></div>
					<div class="card-header">
						<div class="container mt-4">
							<div class="form-row" style="align-items: center; justify-content: center;">
								<div class="col-md-6 p-0 ml-3">
									<form class="row"
												id="respuesta-form">
										<select name="escalaRespuestas"
														id="escalaRespuestas"
														class="form-control"
														onchange="showbutton()">
											<option>Selecciona una escala</option>
											<option value="2">Verdadero y falso</option>
											<option value="0">Escala de Likert</option>
											<option value="1">Escala de clasificación</option>
											<option value="3">Escala de frecuencia</option>
										</select>

										<select name="binario" id="binario" class="form-control mt-3">
											<option>Selecciona la respuesta correcta</option>
											<option value="4">Verdadero</option>
											<option value="5">Falso</option>
										</select>

										<input type="hidden" 
													name="idPreguntaEscala" 
													value="<?php echo $_GET['pregunta']; ?>">
									<div class="col-12">
										<button class="btn btn-primary rounded btn-block mt-3 btn-registrar-respuestas"
														type="button"
														id="respuesta-btn"
														name="respuesta-btn">
											Registrar respuesta
										</button>
									</div>
									</form>
								</div>
							</div>
						</div>
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
	$("#binario").hide();
	$("#respuesta-btn").click(function() {
		$("#form-result").val("");
		var formData = $("#respuesta-form").serialize(); // Obtener los datos del formulario
		$.ajax({
			url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
			type: "POST",
			data: formData,
			success: function(response) {

				if (response === 'ok') {
					$("#form-result").html(`<div class='alert alert-success' role="alert" id="alerta">
					<i class="fas fa-check-circle"></i>
					Respuesta Creada"
				</div>`);
					deleteAlert();
					setTimeout(function() {
						location.href = 'Preguntas&evaluacion='+<?php echo $Evaluaciones['idExamen'] ?>;
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

function showbutton() {
	var select = document.getElementById('escalaRespuestas');
	if (select.value == 0 || select.value == 1 || select.value == 2 || select.value == 3) {
		if (select.value == 2) {
			$("#binario").show();
		}else{
			$("#binario").hide();
		}
		$(".btn-registrar-respuestas").show();
	} else {
		$(".btn-registrar-respuestas").hide();
	}
}

function deleteAlert() {
	setTimeout(function() {
		var alert = $('#alerta');
		alert.fadeOut('slow', function() {
			alert.remove();
		});
	}, 800);
}
</script>