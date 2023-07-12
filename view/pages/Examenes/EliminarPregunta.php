<?php 
if (isset($_GET['pregunta'])) {
	$Evaluaciones = ControladorFormularios::ctrVerPreguntas('idPregunta', $_GET['pregunta']);
	if (empty($Evaluaciones)) {
		echo "    <script>
                    setTimeout(function() {
                        location.href = 'Evaluaciones';
                    }, 900);
                </script>";
	}
}
?>

<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="container">
			<div class="card">
				<div class="card-body">
					<form>
						<div class="form-group">
							<p style="font-size: 20px;">Antes de continuar, por favor confirme que desea eliminar la pregunta seleccionada. Esta acción es irreversible y eliminará permanentemente la pregunta junto con todas las respuestas recibidas. Esta acción puede afectar el funcionamiento de la organización. Si está seguro, haga clic en el botón 'Eliminar'. De lo contrario, haga clic en 'Cancelar'.</p>
						</div>
						<div class="row mt-3 rounded float-right">
							<div class="text-center">
								<input type="hidden" id="delPregunta" value="<?php echo $_GET['pregunta']; ?>">
								<button type="button" class="btn btn-primary mr-1 rounded" id="examen-btn">Eliminar</button>
							</div>
							<div class="text-center">
								<a href="Preguntas&evaluacion=<?php echo $_GET['examen']; ?>" class="btn btn-danger mr-3 rounded">Cancelar</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	
$(document).ready(function() {
    $("#examen-btn").click(function() {
        var Pregunta = $('#delPregunta').val();
        var mensaje = `<div class='alert alert-success' role="alert" id="alerta">
                            <i class="fas fa-check-circle"></i>
                            ¡Se eliminó la pregunta con éxito!
                        </div>`;
        var error = `<div class='alert alert-danger' role="alert" id="alerta">
                        <i class="fas fa-exclamation-triangle"></i>
                        <b>Error</b>, no se eliminó la pregunta, intenta nuevamente.
                    </div>`;
        $.ajax({
            url: "ajax/ajax.formularios.php",
            type: "POST",
            data: { delPregunta: Pregunta },
            success: function(response) {
                if (response === 'ok') {
                    $("#form-result").val("");
                    $("#form-result").html(mensaje);
                    deleteAlert();
                    setTimeout(function() {
                        location.href = 'Preguntas&evaluacion='+<?php echo $_GET['examen']; ?>;
                    }, 900);
                } else {
                    $("#form-result").val("");
                    $("#form-result").html(error);
                    deleteAlert();
                }
            }
        });
    });
});

function deleteAlert() {
    var alert = $('#alerta');
    setTimeout(function() {
        alert.fadeOut('slow', function() {
            alert.remove();
        });
    }, 800);
}

</script>