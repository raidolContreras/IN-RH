<link rel="stylesheet" href="assets/libs/css/login.css">
<?php if (isset($_GET['enviado'])): ?>

<div class="wrapper">
	<div class="logo">
		<img src="assets/images/logoinconsulting.png" alt="">
	</div>
	<div class="text-center mt-4 name">
		Estimado usuario
	</div>
	<div class="text-center mt-4">
			<p>Le informamos que hemos recibido su solicitud de restablecer su contraseña. Para completar el proceso, por favor revise el correo electrónico que le hemos enviado a la dirección que nos ha facilitado.</p> <p>En el mismo encontrará un enlace para acceder a una página segura donde podrá crear una nueva contraseña.</p>

			<p>Gracias por confiar en nuestro servicio.</p>
	</div>
	<div class="text-center fs-6">
		<a href="Login">Iniciar sesión</a>
	</div>
</div>
<?php else: ?>

<div class="wrapper">
	<div class="logo">
		<img src="assets/images/logoinconsulting.png" alt="">
	</div>
	<div class="text-center mt-4 name">
		Recuperar Contraseña
	</div>
	<div class="text-center mt-4">
		<p>No te preocupes, te enviaremos un correo electrónico para restablecer tu contraseña.</p>
	</div>
	<form class="p-3 mt-3"  id="forgot-form">
		<div class="form-field d-flex align-items-center">
			<span class="far fa-user"></span>
			<input type="email" name="forgotEmail" id="forgotEmail" placeholder="Correo">
		</div>
		<button type="submit" class="btn mt-3" id="forgot-btn">Enviar email</button>
	</form>
	<div class="text-center fs-6">
		<a href="Login">Iniciar sesión</a>
	</div>
</div>

<script>
	
	$(document).ready(function() {
		$("#forgot-btn").click(function() {
		var formData = $("#forgot-form").serialize(); // Obtener los datos del formulario
            $("#forgot-btn").prop("disabled", true);

			$.ajax({
				url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
				type: "POST",
				data: formData,
				success: function(response) {

					if (response === '"ok"') {
						$("#form-result").val("");
						$("#form-result").parent().after(`
							<div class='alert alert-success'>Se envió un correo para restablecer su contraseña. Revíselo y si no lo ve, mire el spam.</div>
							`);
						setTimeout(function() {
							location.href = "Forgot-Password&enviado=true";
						}, 500);
					}else if (response === '"existente"') {
						$("#form-result").val("");
						$("#form-result").parent().after(`
							<div class='alert alert-warning'>Ya hay un proceso de verificación, revisa tu correo, de no encontrarlo, busca en el campo de spam.</div>
							`);
						setTimeout(function() {
							location.href = "Forgot-Password&enviado=true";
						}, 500);
					}else{
						$("#form-result").val("");
						$("#form-result").parent().after(`
							<div class='alert alert-danger'><b>Error</b>, correo inexistente, verifique el correo</div>
							`);
					}
				}
			});
		});
	});

</script>

<?php endif ?>