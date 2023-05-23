<?php if (isset($_GET['cambio'])): ?>
	<div class="container mt-5">
		<div class="alert alert-info alert-dismissible fade show" role="alert">
	        <p>Para proceder, es imprescindible que modifiques tu contraseña actual por una de mayor seguridad.</p>
	        <hr>
	        <p class="mb-0">La nueva contraseña deberá constar de un mínimo de 8 caracteres, incluyendo al menos una letra mayúscula, una letra minúscula y un número.</p>
	        <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </a>
	    </div>
	    <div id="message"></div>
	</div>
<?php endif ?>
<div class="container-fluid dashboard-content ">
    <form class="splash-container" id="cambioPassword-form">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-1">Cambio de contraseña</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input class="form-control form-control-lg" type="password" name="pass1" placeholder="Nueva Contraseña" required>
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="password" name="pass2" placeholder="Repetir contraseña" required>
                </div>
                <input type="hidden" name="cambioPassword" value="<?php echo $_GET['cambio']; ?>">
                <div class="form-group pt-2">
                    <button class="btn btn-block btn-primary" id="cambioPassword-btn" type="button">Cambiar contraseña</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
	
	$(document).ready(function() {
		$("#cambioPassword-btn").click(function() {
		var formData = $("#cambioPassword-form").serialize(); // Obtener los datos del formulario

			$.ajax({
				url: "ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
				type: "POST",
				data: formData,
				success: function(response) {

					if (response === '"ok"') {
							location.href='Inicio';
					}else if (response === '"Error: password"') {
						$("#message").val("");
						$("#message").parent().after(`
							<div class='alert alert-danger'><b>Error</b>, Las contraseñas no son iguales, intenta nuevamente</div>
							`);
					}else if (response === '"Error: data"') {
						$("#message").val("");
						$("#message").parent().after(`
							<div class='alert alert-danger'><b>Error</b>, La contraseña debe tener al menos una mayúscula, una minúscula, un número y 8 caracteres, intenta nuevamente</div>
							`);
					}else if (response === '"Error: user"') {
						$("#message").val("");
						$("#message").parent().after(`
							<div class='alert alert-danger'><b>Error</b>, el usuario esta incorrecto, intenta nuevamente</div>
							`);
					}else if (response === '"Error"') {
						$("#message").val("");
						$("#message").parent().after(`
							<div class='alert alert-danger'><b>Error</b>, No se pudo cambiar la contraseña, intenta nuevamente</div>
							`);
					}else{
						$("#message").val("");
						$("#message").append(response)
					}

				}
			});
		});
	});

</script>
