<?php 
if (isset($_POST['button-login'])) {
	$ingreso = ControladorFormularios::ctrLogin();
} ?>
<link rel="stylesheet" href="assets/libs/css/login.css">
<div class="wrapper">
	<div class="logo">
		<img src="assets/images/logoinconsulting.png" alt="">
	</div>
	<div class="text-center mt-4 name">
		Inicio de sesión
	</div>
	<form class="p-3 mt-3" method="post">
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
		<div class="form-field d-flex align-items-center">
			<span class="far fa-user"></span>
			<input type="text" name="loginEmail" id="loginEmail" placeholder="Correo">
		</div>
		<div class="form-field d-flex align-items-center">
			<span class="fas fa-key"></span>
			<input type="password" name="loginPass" id="loginPass" placeholder="Contraseña">
		</div>
		<button class="btn mt-3" name="button-login">Iniciar Sesión</button>
	</form>
	<div class="text-center fs-6">
		<a href="Forgot-Password">¿Has olvidado tu contraseña?</a>
	</div>
</div>