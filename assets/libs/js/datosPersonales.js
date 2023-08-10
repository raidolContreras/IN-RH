$("#DatosPersonales-btn").click(function() {
	var dataPersonal = $("#DatosPersonales-form").serialize(); // Obtener los datos del formulario
	$.ajax({
		url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
		type: "POST",
		data: dataPersonal,
		success: function(response) {
			$("#form-result").val("");

			if (response === 'ok') {
				$("#form-result").html(`
				<div class='alert alert-success' role="alert" id="alerta">
				  <i class="fas fa-check-circle"></i>
				  Datos actualizados.
				</div>
					`);
				deleteAlert();
			}else{
				// Mensaje de error: tamaño de archivo excedido
				$("#form-result").html(`
				<div class='alert alert-danger' role="alert" id="alerta">
					<i class="fas fa-exclamation-triangle"></i>
					<b>Error:</b> No se pudo actualizar los datos.
				</div>
					`);
				deleteAlert();
			}

		}
	});
});