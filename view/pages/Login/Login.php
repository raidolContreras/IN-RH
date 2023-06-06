<?php 
if (isset($_POST['button-login'])) {
	$ingreso = ControladorFormularios::ctrLogin();
} ?>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="view/pages/Login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="view/pages/Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="view/pages/Login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="view/pages/Login/vendor/animate/animate.css">
<!--===============================================================================================-->  
<link rel="stylesheet" type="text/css" href="view/pages/Login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="view/pages/Login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="view/pages/Login/vendor/select2/select2.min.css">
<!--===============================================================================================-->  
<link rel="stylesheet" type="text/css" href="view/pages/Login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="view/pages/Login/css/util.css">
<link rel="stylesheet" type="text/css" href="view/pages/Login/css/main.css">
<!--===============================================================================================-->

<div class="limiter"> 
	<div class="container-login100" style="background-image: url('view/pages/Login/images/bg-01.jpg');"> 
		<div class="wrap-login100 p-t-30 p-b-50">
			<span class="login100-form-title p-b-41">
				Inicio de sesión
			</span>
			<form method="post" class="login100-form validate-form p-b-33 p-t-5" id="login-form">
				<?php if (isset($_POST['button-login'])): ?>
					<div id="form-result">
						<?php if ($ingreso == 'ok'): ?>
							<script>
								setTimeout(function() {
									location.href='Inicio';
								}, 500);
							</script>

						<?php elseif($ingreso == 'Cambio'): ?>

							<div class='alert alert-success'>Bienvenido</div>
							<?php $idEmpleado = md5($_SESSION['idEmpleado']); ?>
							<script>
								location.href='Password&cambio=<?php echo $idEmpleado; ?>';
							</script>
						<?php elseif($ingreso == 'Error: status'): ?>

							<div class='alert alert-warning'><b>Cuenta suspendida</b>, si es un error contacta con el equipo de sistemas</div>

						<?php elseif($ingreso == 'Error: datos'): ?>

							<div class='alert alert-danger'><b>Error</b>, Correo o contraseña incorrectos, vuelve a intentarlo</div>

						<?php endif ?>
					</div> 
				<?php endif ?>
				<div class="wrap-input100 validate-input" data-validate = "Enter username">
					<input class="input100" type="email" name="loginEmail" placeholder="Correo">
					<span class="focus-input100" data-placeholder="&#xe82a;"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="Enter password">
					<input class="input100" type="password" name="loginPass" placeholder="Contraseña">
					<span class="focus-input100" data-placeholder="&#xe80f;"></span>
				</div>

				<div class="container-login100-form-btn m-t-32">
					<button type="submit" class="login100-form-btn" name="button-login">
						Ingresar
					</button>
				</div>

			</form>
			<div>
				<a class="btn btn-link" href="Forgot-Password">¿Has olvidado tu contraseña?</a>
			</div>
		</div>
	</div>
</div>

<!--===============================================================================================-->
<script src="view/pages/Login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="view/pages/Login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="view/pages/Login/vendor/bootstrap/js/popper.js"></script>
<script src="view/pages/Login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="view/pages/Login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="view/pages/Login/vendor/daterangepicker/moment.min.js"></script>
<script src="view/pages/Login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="view/pages/Login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="view/pages/Login/js/main.js"></script>
