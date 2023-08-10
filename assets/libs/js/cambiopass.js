$("#cambiopass-btn").click(function() {
	var formData = $("#cambiopass-form").serialize(); // Obtener los datos del formulario
	$.ajax({
		url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
		type: "POST",
		data: formData,
		success: function(response) {
			$("#form-result").val("");

			if (response === 'ok') {
				$("#form-result").html(`
				<div class='alert alert-success' role="alert" id="alerta">
				  <i class="fas fa-check-circle"></i>
				  Contraseña cambiada exitosamente.
				</div>
					`);
				deleteAlert();
			} else if (response === 'error: contraseña') {
				$("#form-result").html(`
				<div class='alert alert-danger' role="alert" id="alerta">
					<i class="fas fa-exclamation-triangle"></i>
					<b>Error:</b> Las contraseñas no coinciden.
				</div>
					`);
				deleteAlert();
			} else if (response === 'error: 1') {
				$("#form-result").html(`
				<div class='alert alert-warning' role="alert" id="alerta">
					<i class="fas fa-exclamation-triangle"></i>
					Campo de "Contraseña actual" Vacio.
				</div>
					`);
				deleteAlert();
			} else if (response === 'error: 2') {
				$("#form-result").html(`
				<div class='alert alert-warning' role="alert" id="alerta">
					<i class="fas fa-exclamation-triangle"></i>
					Campo de "Nueva contraseña" Vacio.
				</div>
					`);
				deleteAlert();
			} else if (response === 'error: 3') {
				$("#form-result").html(`
				<div class='alert alert-warning' role="alert" id="alerta">
					<i class="fas fa-exclamation-triangle"></i>
					Campo de "Confirmar Contraseña" Vacio.
				</div>
					`);
				deleteAlert();
			} else if (response === 'error: coincide') {
				$("#form-result").html(`
				<div class='alert alert-warning' role="alert" id="alerta">
					<i class="fas fa-exclamation-triangle"></i>
					La contraseña antigua no es correcta.
				</div>
					`);
				deleteAlert();
			} else if (response === 'error: data') {
				$("#form-result").html(`
				<div class='alert alert-warning' role="alert" id="alerta">
					<i class="fas fa-exclamation-triangle"></i>
					El formato de la nueva contraseña no es correcto, debe poseer al menos 8 caracteres, 1 letra mayuscula y un numero.
				</div>
					`);
				deleteAlert();
			} else if (response === 'error: iguales') {
				$("#form-result").html(`
				<div class='alert alert-warning' role="alert" id="alerta">
					<i class="fas fa-exclamation-triangle"></i>
					la nueva contraseña no puede ser igual a la contraseña antigua.
				</div>
					`);
				deleteAlert();
			}else{
				// Mensaje de error: tamaño de archivo excedido
				$("#form-result").html(`
				<div class='alert alert-danger' role="alert" id="alerta">
					<i class="fas fa-exclamation-triangle"></i>
					<b>Error:</b> No se pudo cambiar de contraseña.
				</div>
					`);
				deleteAlert();
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