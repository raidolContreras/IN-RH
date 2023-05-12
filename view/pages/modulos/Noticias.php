<div class="container-fluid dashboard-content">
	<form method="POST" enctype="multipart/form-data">
		<?php 
		$noticia = ControladorFormularios::ctrCrearNoticia();

		if ($noticia == 'ok') {
			echo '<script>
			setTimeout(function() {
				location.href="Inicio";
				}, 1000);
				</script>';

				echo '<div class="alert alert-success">¡Noticia creada exitosamente!</div>';
			} elseif ($noticia == 'error') {
				echo '<script>
				if (window.history.replaceState) {
					window.history.replaceState(null, null, window.location.href);
				}
				</script>';

				echo '<div class="alert alert-danger">¡<b>Error</b>, no se pudo crear la noticia! Inténtalo de nuevo.</div>';
			}
			?>
			<div class="row">
				<div class="col">
					<label class="col-form-label font-weight-bold" for="requiere_foto">Requiere Foto:</label>
					<input class="form-control" type="checkbox" name="requiere_foto" id="requiere_foto">
				</div>
				<div class="col" id="image_upload">
					<div class="form-container col-12">
						<label class="image_label pr-2 pl-5" for="image_upload" id="image_upload-label">Selecciona una imagen:</label>
						<input class="pr-2 mr-5 form-control" type="file" name="image_upload" accept=".jpg,.jpeg,.png">
					</div>
				</div>
				<div class="col">
					<label class="col-form-label font-weight-bold" for="fecha_fin">Publicar hasta:</label>
					<input class="form-control" type="date" name="fecha_fin" id="fecha_fin" required>
				</div>
			</div>
			<!---->
			<textarea class="form-control noticia_text" name="mensaje_noticia" id="mensaje_noticia" rows="3"></textarea>

			<script>
				tinymce.init({
					selector: '.noticia_text',
					plugins: [
						'textcolor colorpicker autoresize'
						],
					toolbar: 'undo redo | styleselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link'
				});

				document.getElementById('mce_0_ifr').contentWindow.document.getElementById('tinymce').innerHTML

			</script>

			<input type="hidden" name="publicado" value="<?php echo $_SESSION['idEmpleado'] ?>">
			<input type="hidden" id="foto_noticia" name="foto_noticia" value="0">
			<!---->
			<div class="card">
				<div class="card-footer p-0 text-center d-flex justify-content-center ">
					<div class="card-footer-item card-footer-item-bordered">
						<button class="card-link btn btn-outline-secondary">Cancelar</button>
					</div>
					<div class="card-footer-item card-footer-item-bordered">
						<button type="submit" name="noticia_btn" class="card-link btn btn-outline-primary">Enviar</button>
					</div>
				</div>
			</div>

		</form>
	</div>

	<script>
		tinymce.init({
			selector: '.noticia_text',
			plugins: [
				'textcolor colorpicker autoresize'
				],
			toolbar: 'undo redo | styleselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link'
		});

		document.getElementById('mce_0_ifr').contentWindow.document.getElementById('tinymce').innerHTML

		var contenidoEditor = tinymce.get('mensaje').getContent();
		$("#mensaje").val(contenidoEditor);
	</script>
	<script>

		$(document).ready(function() {
// Por defecto, ocultar el campo de imagen
			$("#image_upload").hide();

// Establecer el valor inicial del campo oculto "foto_noticia" como 0
			$("#foto_noticia").val(0);

// Evento de cambio en el checkbox "Requiere Foto"
			$("#requiere_foto").change(function() {
				if ($(this).is(":checked")) {
// Mostrar el campo de imagen si el checkbox está marcado
					$("#image_upload").show();
// Establecer el valor del campo oculto "foto_noticia" como 1
					$("#foto_noticia").val(1);
				} else {
// Ocultar el campo de imagen si el checkbox no está marcado
					$("#image_upload").hide();
// Establecer el valor del campo oculto "foto_noticia" como 0
					$("#foto_noticia").val(0);
				}
			});
		});
	</script>
