<?php
$mensaje = "";
$fecha_fin = "";
$foto_noticia = 0;
$name_foto = "";
$idNoticia = 0;

if (isset($_GET['noticia'])) {
	$noticias = ControladorFormularios::ctrVerNoticias('idNoticias', $_GET['noticia']);
	
	if (!empty($noticias)) {
		$mensaje = $noticias['mensaje'];
		$fecha_fin = $noticias['fecha_fin'];
		$foto_noticia = $noticias['foto_noticia']; // 1 si hay foto, 0 no existe foto
		$name_foto = $noticias['name_foto'];
		$idNoticia = $noticias['idNoticias'];
	}
}

?>
<div class="container-fluid dashboard-content">
	<form method="POST" enctype="multipart/form-data">
		<?php 
		$accion = isset($_GET['noticia']) ? 'ctrActualizarNoticia' : 'ctrCrearNoticia';
		$noticia = ControladorFormularios::$accion();

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
		} elseif ($noticia == 'Error al mover la imagen') {
			echo '<script>
			if (window.history.replaceState) {
				window.history.replaceState(null, null, window.location.href);
			}
			</script>';

			echo '<div class="alert alert-danger">¡<b>Error</b>, Error al mover la imagen! Inténtalo de nuevo.</div>';
		}
		?>
		<div class="row">
			<div class="col">
				<label class="col-form-label font-weight-bold" for="requiere_foto">Requiere Foto:</label>
				<input class="form-control" type="checkbox" name="requiere_foto" id="requiere_foto" <?php echo $foto_noticia == 1 ? 'checked' : '' ?>>
			</div>
			<div class="col" id="image_upload" <?php echo $foto_noticia == 1 ? '' : 'style="display: none;"' ?>>
				<div class="form-container col-12">
					<label class="image_label pr-2 pl-5" for="image_upload" id="image_upload-label">Selecciona una imagen:</label>
					<input class="pr-2 mr-5 form-control" type="file" name="image_upload" accept=".jpg,.jpeg,.png">
				</div>
			</div>
			<div class="col">
				<label class="col-form-label font-weight-bold" for="fecha_fin">Publicar hasta:</label>
				<input class="form-control" type="date" name="fecha_fin" id="fecha_fin" value="<?php echo $fecha_fin ?>" required>
			</div>
		</div>
		<!---->
		<textarea class="form-control noticia_text" name="mensaje_noticia" id="mensaje_noticia" rows="3"><?php echo $mensaje ?></textarea>

		<script>
			tinymce.init({
				selector: '.noticia_text',
				plugins: [
					'textcolor colorpicker autoresize'
				],
				toolbar: 'undo redo | styleselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link'
			});
		</script>

		<input type="hidden" name="noticia" value="<?php echo $idNoticia ?>">
		<input type="hidden" name="publicado" value="<?php echo $_SESSION['idEmpleado'] ?>">
		<input type="hidden" id="foto_noticia" name="foto_noticia" value="<?php echo $foto_noticia ?>">
		<!---->
		<div class="card">
			<div class="card-footer p-0 text-center d-flex justify-content-center ">
				<div class="card-footer-item card-footer-item-bordered">
					<a href="Inicio" class="card-link btn btn-outline-secondary">Cancelar</a>
				</div>
				<div class="card-footer-item card-footer-item-bordered">
					<button type="submit" name="noticia_btn" class="card-link btn btn-outline-primary">Enviar</button>
				</div>
			</div>
		</div>

	</form>
</div>

<script>
	$(document).ready(function() {
		// Por defecto, ocultar el campo de imagen si foto_noticia es igual a 0
		if ($("#foto_noticia").val() == 0) {
			$("#image_upload").hide();
		}

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
