<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="row" style="justify-content: center">
			<div class="col-xl-9">
				<div class="card p-3">
						<form id="tarea-form">
							<div class="row">
								<div class="col-xl-12 mt-2">
									<h3 class="titulo-tablero">Retroalimentación de la tarea</h3>
									<!---->
									<textarea class="form-control texteditor" name="opinionTarea" id="opinionTarea" rows="3" required></textarea>
										 
									<script>
										tinymce.init({
										selector: '.texteditor',
											plugins: [
											'textcolor colorpicker autoresize'
											],
											toolbar: '',
											menubar: false
										});

										document.getElementById('mce_0_ifr').contentWindow.document.getElementById('tinymce').innerHTML

									</script>
									<!---->
								</div>
							</div>
							<input type="hidden" id="resultadoTarea" name="resultadoTarea" value="<?php echo $_GET['tarea'] ?>" required>
						</form>
						<div class="col-xl-12 mt-2">
							<button class="btn btn-outline-primary btn-block rounded" id="submit-btn" type="button">Finalizar tarea</button>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>

$(document).ready(function() {

	$("#submit-btn").click(function() {
		var contenidoEditor = tinymce.get('opinionTarea').getContent();
		$("#opinionTarea").val(contenidoEditor);
		var formData = $("#tarea-form").serialize(); // Obtener los datos del formulario
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
						<b>Error</b>, no se pudo finalizar la tarea, intenta nuevamente
					</div>
						`);
					deleteAlert();
				}else{
					$("#form-result").val("");
					$("#form-result").html(`
					<div class='alert alert-success' role="alert" id="alerta">
						<i class="fas fa-check-circle"></i>
						Tarea finalizada correctamente
					</div>
						`);

					deleteAlert();
					setTimeout(function() {
						location.href = 'Tareas';
					}, 1600);
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
		}, 1500);
	}
</script>