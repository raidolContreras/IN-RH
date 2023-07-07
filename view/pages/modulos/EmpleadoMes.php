<?php 
$empresas = ControladorFormularios::ctrVerEmpresas(null, null); 
$empleadoMes = ControladorFormularios::ctrSeleccionarEmpleadoMes();
$fotoEmpleado = ControladorFormularios::ctrVerFotos("Empleados_idEmpleados", $empleadoMes['idEmpleados']); 
?>
<?php if (isset($empleadoMes['name'])): ?>
	<?php $datosPublicante = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $empleadoMes['Publicado_idEmpleados']);  ?>
<div class="row">
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
		<div class="card-into-card h-75 rounded">
			<?php echo $empleadoMes['mensaje']; ?>
		</div>
	</div>
</div>
<?php else: ?>
<div class="row">
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
							<label class="col-form-label font-weight-bold" for="empresas">Empresa</label>
							<select name="empresas" id="empresas" class="form-control" required>
								<option>Selecciona un empresa</option>
								<?php foreach ($empresas as $empresa): ?>
									<option value="<?php echo $empresa['idEmpresas'] ?>"><?php echo $empresa['nombre_razon_social'] ?></option>
								<?php endforeach ?>
							</select>
						</div>

						<div class="mb-2">
							<label class="col-form-label font-weight-bold" for="empleadoMes">Empleado</label>
							<select name="empleadoMes" id="empleadoMes" class="form-control" required>
								<option>Selecciona un empleado</option>
							</select>
						</div>
						<!---->
						<textarea class="form-control texteditor" name="mensaje" id="mensaje" rows="3" required></textarea>
							 
						<script>
							tinymce.init({
							selector: '.texteditor',
							plugins: 'advlist lists',
							menubar: '',
							toolbar: 'bold italic underline | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat'

							});

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
						$("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
						  <i class="fas fa-check-circle"></i>
						  Nuevo empleado del mes
						</div>
							`);
						deleteAlert();
						setTimeout(function() {
							location.reload();
						}, 1600);
					}else{
						$("#form-result").val("");
						$("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
						  <i class="fas fa-exclamation-triangle"></i>
						  <b>Error</b>, no se elegir al empleado del mes, intenta nuevamente
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
	});
	
	$(document).ready(function() {
	  // Manejar el evento de cambio del select de empresas
	  $("#empresas").change(function() {
	    // Obtener el ID de la empresa seleccionada
	    var idEmpresa = $(this).val();

	    // Realizar la solicitud AJAX
	    $.ajax({
	      url: "ajax/obtenerEmpleadoEmpresa.php",
	      type: "POST",
	      data: { idEmpresa: idEmpresa },
	      dataType: "json",
	      success: function(response) {
	        // Limpiar el select de empleados
	        $("#empleadoMes").empty();

	        // Agregar las opciones de empleados al select
	        $.each(response, function(index, empleado) {
	          $("#empleadoMes").append("<option value='" + empleado.idEmpleados + "'>" + empleado.Nombre + "</option>");
	        });
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