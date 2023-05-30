<link rel="stylesheet" type="text/css" href="view/pages/Login/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="view/pages/Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="view/pages/Login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<link rel="stylesheet" type="text/css" href="view/pages/Login/vendor/animate/animate.css">
<link rel="stylesheet" type="text/css" href="view/pages/Login/vendor/css-hamburgers/hamburgers.min.css">
<link rel="stylesheet" type="text/css" href="view/pages/Login/vendor/animsition/css/animsition.min.css">
<link rel="stylesheet" type="text/css" href="view/pages/Login/vendor/select2/select2.min.css">
<link rel="stylesheet" type="text/css" href="view/pages/Login/vendor/daterangepicker/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="view/pages/Login/css/util.css">
<link rel="stylesheet" type="text/css" href="view/pages/Login/css/main.css">
<?php if (isset($_GET['enviado'])): ?>
	
<div class="limiter"> 
	<div class="container-login100" style="background-image: url('view/pages/Login/images/bg-01.jpg');"> 
		<div class="wrap-login100 p-t-30 p-b-50">
			<span class="login100-form-title p-b-41">
				Recuperar Contraseña
			</span>
			<div class="login100-form validate-form p-b-33 p-t-5">
				<div class="container-login100-form-btn m-t-32">
					<h2>Estimado usuario,</h2>

						<p>Le informamos que hemos recibido su solicitud de restablecer su contraseña. Para completar el proceso, por favor revise el correo electrónico que le hemos enviado a la dirección que nos ha facilitado.</p> <p>En el mismo encontrará un enlace para acceder a una página segura donde podrá crear una nueva contraseña.</p>

						<p>Gracias por confiar en nuestro servicio.</p>
				</div>
			</div>
			<div>
				<a class="btn btn-link" href="Login">Iniciar sesión</a>
			</div>
		</div>
	</div>
</div>
<?php else: ?>
<div class="limiter"> 
	<div class="container-login100" style="background-image: url('view/pages/Login/images/bg-01.jpg');"> 
		<div class="wrap-login100 p-t-30 p-b-50">
			<span class="login100-form-title p-b-41">
				Recuperar Contraseña
			</span>
			<form method="post" class="login100-form validate-form p-b-33 p-t-5" id="forgot-form">
				<div class="container-login100-form-btn m-t-32">
					<p>No te preocupes, te enviaremos un correo electrónico para restablecer tu contraseña.</p>
				</div>
				<div class="wrap-input100 validate-input" data-validate = "Enter username">
					<input class="input100" type="email" name="forgotEmail" placeholder="Correo">
					<span class="focus-input100" data-placeholder="&#xe82a;"></span>
				</div>
				<div class="container-login100-form-btn m-t-32">
					<button type="button" class="login100-form-btn" id="forgot-btn">
						Enviar email
					</button>
				</div>
				<div class="container-login100-form-btn m-t-32" id="form-result"></div>
			</form>
			<div>
				<a class="btn btn-link" href="Login">Iniciar sesión</a>
			</div>
		</div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="view/pages/Login/vendor/animsition/js/animsition.min.js"></script>
<script src="view/pages/Login/vendor/bootstrap/js/popper.js"></script>
<script src="view/pages/Login/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="view/pages/Login/vendor/select2/select2.min.js"></script>
<script src="view/pages/Login/vendor/daterangepicker/moment.min.js"></script>
<script src="view/pages/Login/vendor/daterangepicker/daterangepicker.js"></script>
<script src="view/pages/Login/vendor/countdowntime/countdowntime.js"></script>
<script src="view/pages/Login/js/main.js"></script>