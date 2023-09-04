<?php if (!empty($rol) && $rol['Del_Evaluaciones'] == 1): ?>
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
						<div class="row mt-3 rounded float-right">
							<div class="text-center">
								<input type="hidden" id="eliminarExamen" value="<?php echo $_GET['evaluacion']; ?>">
								<button type="button"id="examen-btn" class="btn btn-primary rounded mr-2">Eliminar</button>
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
        var Examen = $('#eliminarExamen').val();
        var mensaje = `<div class='alert alert-success' role="alert" id="alerta">
                            <i class="fas fa-check-circle"></i>
                            ¡Se eliminó el examen con éxito!
                        </div>`;
        var error = `<div class='alert alert-danger' role="alert" id="alerta">
                        <i class="fas fa-exclamation-triangle"></i>
                        <b>Error</b>, no se eliminó el examen, intenta nuevamente.
                    </div>`;
        $.ajax({
            url: "ajax/ajax.formularios.php",
            type: "POST",
            data: { eliminarExamen: Examen },
            success: function(response) {
                if (response === 'ok') {
                    $("#form-result").val("");
                    $("#form-result").html(mensaje);
                    deleteAlert();
                    setTimeout(function() {
                        location.href = 'Evaluaciones';
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

<?php else: ?>
    <script>
        window.location.href = 'Evaluaciones';
    </script>
<?php endif ?>