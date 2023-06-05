<?php 
$empleados = ControladorEmpleados::ctrVerEmpleados(null, null); 
$empleadoMes = ControladorFormularios::ctrSeleccionarEmpleadoMes();
$fotoEmpleado = ControladorFormularios::ctrVerFotos("Empleados_idEmpleados", $empleadoMes['idEmpleados']); 
?>
<?php if (isset($empleadoMes['name'])): ?>
	<?php $datosPublicante = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $empleadoMes['Publicado_idEmpleados']);  ?>
<div class="row">
	<div id="form-result"></div>
	<div class="col-12">
		<div class="float-left m-0">
			<p class="titulo-sup m-0"><?php echo $datosPublicante['name']." ".$datosPublicante['lastname'] ?></p>
			<p class="subtitulo-sup m-0" id="tiempo-transcurrido"></p>
		</div>
		<div class="float-right m-0">
			<p class="titulo-sup m-0">
				<button type="button" 
					class="btn-outline-light boton" 
					data-toggle="modal" 
					data-target="#Empleado">
					<i class="fas fa-edit"></i>
				</button>
			</p>
		</div>
	</div>
	<div class="col-12 mb-0 pb-0">
		<div class="center-all cursor-pointer">
			<div class="widget-container widget-mb-10px pb-3">

				<?php if (isset($fotoEmpleado['namePhoto'])): ?>
					<img src="view/fotos/thumbnails/<?php echo $fotoEmpleado['namePhoto'] ?>"
				<?php else: ?>
					<?php if ($empleadoMes['genero']==1): ?>
						<img src="assets/images/Ejecutivo.webp"
					<?php else: ?>
						<img src="assets/images/Ejecutiva.webp"
					<?php endif ?>
				<?php endif ?>

				size="large" alt="User Avatar" class="rounded-circle user-avatar-xl2 arriba mt-2">

				<img src="assets/images/appreciation.svg" alt="Winner" class="abajo">
			</div>
			<h3 class="in-text"><?php echo $empleadoMes['lastname']." ".$empleadoMes['name'] ?></h3>
		</div>
		<div class="card-into-card rounded">
			<?php echo $empleadoMes['mensaje']; ?>
		</div>
	</div>
</div>
<?php else: ?>
<div class="row">
	<div id="form-result"></div>
	<div class="col-12">
		<div class="float-left m-0">
		</div>
		<div class="float-right m-0">
			<p class="titulo-sup m-0">
			</p>
		</div>
	</div>
	<div class="col-12 mb-0 pb-0">
		<div class="center-all cursor-pointer">
			<div class="widget-container widget-mb-10px p-5">
				<button class="btn-outline-light boton"
					data-toggle="modal" 
					data-target="#Empleado">
					Agregar empleado del mes.
				</button>
			</div>
		</div>
	</div>
</div>

<?php endif ?>
<!-- Modal Eliminar postulante -->

	<div class="modal fade" id="Empleado">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<div class="modal-header">
					<h3>Empleado del mes</h3>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<form id="empleado-form">

						<div class="mb-2">
							<label class="col-form-label font-weight-bold" for="empleadoMes">Empleado</label>
							<select name="empleadoMes" id="empleadoMes" class="form-control" required>
								<option>Selecciona un empleado</option>
								<?php foreach ($empleados as $key => $empleado): ?>	
									<option value="<?php echo $empleado['idEmpleados']; ?>"><?php echo $empleado['name']." ".$empleado['lastname']; ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<!---->
						<textarea class="form-control texteditor" name="mensaje" id="mensaje" rows="3" required></textarea>
							 
						<script>
						tinymce.init({
						selector: '.texteditor',
							plugins: [
							'textcolor colorpicker autoresize'
							],
							toolbar: 'undo redo | styleselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link'
						});

						document.getElementById('mce_0_ifr').contentWindow.document.getElementById('tinymce').innerHTML

					</script>
						<input type="hidden" name="publicado" value="<?php echo $_SESSION['idEmpleado'] ?>">
						<!---->
						<div class="card">
							<div class="card-footer p-0 text-center d-flex justify-content-center ">
								<div class="card-footer-item card-footer-item-bordered">
									<button data-dismiss="modal" class="card-link btn btn-outline-secondary">Cancelar</button>
								</div>
								<div class="card-footer-item card-footer-item-bordered">
									<button type="button" id="empleado-btn" data-dismiss="modal" class="card-link btn btn-outline-primary">Enviar</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<script>
	
	$(document).ready(function() {
		$("#empleado-btn").click(function() {
		var contenidoEditor = tinymce.get('mensaje').getContent();
		$("#mensaje").val(contenidoEditor);
		var formData = $("#empleado-form").serialize(); // Obtener los datos del formulario

			$.ajax({
				url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
				type: "POST",
				data: formData,
				success: function(response) {

					if (response === '"ok"') {
						$("#form-result").val("");
						$("#form-result").parent().after(`
							<div class='alert alert-success'>Nuevo empleado del mes</div>
							`);
						setTimeout(function() {
							location.reload();
						}, 500);
					}else{
						$("#form-result").val("");
						$("#form-result").parent().after(`
							<div class='alert alert-danger'><b>Error</b>, no se elegir al empleado del mes, intenta nuevamente</div>
							`);
					}

				}
			});
		});
	});

</script>

<script>
 		function calcularTiempoTranscurrido() {
	    var fechaPublicacion = new Date("<?php echo $empleadoMes['fecha_publicacion'] ?>");
	    var tiempoActual = new Date();

	    var diferencia = Math.floor((tiempoActual - fechaPublicacion) / 1000); // Diferencia en segundos

	    var minutosTranscurridos = Math.floor(diferencia / 60);
	    var horasTranscurridas = Math.floor(diferencia / 3600);
	    var diasTranscurridos = Math.floor(diferencia / 86400);

	    var mensaje;

	    if (minutosTranscurridos < 1) {
	      mensaje = "Hace un momento";
	    } else if (minutosTranscurridos == 1) {
	      mensaje = "Hace " + minutosTranscurridos + " minuto";
	    }  else if (minutosTranscurridos > 1 && minutosTranscurridos <= 59) {
	      mensaje = "Hace " + minutosTranscurridos + " minutos";
	    } else if (horasTranscurridas == 1) {
	      mensaje = "Hace " + horasTranscurridas + " hora";
	    } else if (horasTranscurridas >= 2 && horasTranscurridas <= 23) {
	      mensaje = "Hace " + horasTranscurridas + " horas";
	    } else {
	      mensaje = "Hace " + diasTranscurridos + " días";
	    }

	    document.getElementById("tiempo-transcurrido").innerHTML = mensaje;
	  }

	  // Actualizar el tiempo transcurrido cada segundo (1000 ms)
	  setInterval(calcularTiempoTranscurrido, 1000);

</script>