<?php 
if (isset($_GET['evaluacion'])) {
	$Evaluaciones = ControladorFormularios::ctrVerEvaluaciones('idExamen', $_GET['evaluacion']);
	if (!empty($Evaluaciones)) {
		$titulo = $Evaluaciones['titulo'];
	}
}
?>

<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="container">
			<div class="card">
				<div class="card-body">
					<form method="POST">
						<div class="form-group">
							<p style="font-size: 20px;">Antes de continuar, por favor confirme que desea eliminar la evaluación <strong>"<?php echo $titulo; ?>"</strong>. Esta acción es irreversible y se perderán los registros de las calificaciones. Si está seguro, haga clic en el botón "Eliminar". De lo contrario, de clic en "Cancelar".</p>
						</div>
						<div class="row mt-5 rounded float-right">
							<div class="text-center">
								<input type="hidden" name="eliminarExamen" value="<?php echo $_GET['evaluacion']; ?>">
								<button type="button" name="accion" class="btn btn-primary rounded mr-2">Eliminar</button>
							</div>
							<div class="text-center">
								<a href="Evaluaciones" class="btn btn-danger rounded">Cancelar</a>
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
			var eliminarExamen = document.getElementById('eliminarExamen');
			var mensaje = `<div class='alert alert-success' role="alert" id="alerta">
								<i class="fas fa-check-circle"></i>
								Se elimino el examen <p class='Titulo'>"`;
			var error = `<div class='alert alert-danger' role="alert" id="alerta">
							<i class="fas fa-exclamation-triangle"></i>
							<b>Error</b>, no se elimino el examen, intenta nuevamente.
						</div>`;
			$.ajax({
				url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
				type: "POST",
				data: {eliminarExamen: eliminarExamen},
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

	function deleteAlert() {
		setTimeout(function() {
			var alert = $('#alerta');
			alert.fadeOut('slow', function() {
				alert.remove();
			});
		}, 800);
	}
</script>