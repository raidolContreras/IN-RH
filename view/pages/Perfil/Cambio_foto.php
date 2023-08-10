
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />
<style>
	.dropzone {
		border: 2px dashed #ccc;
		padding: 60px;
	}

	.dropzone .dz-message {
		text-align: center;
		font-size: 1.5em;
		color: #999;
	}

</style>

<div class="col-xl-6 col-md-12 my-4">
	<div class="card-into-card rounded-card px-4">
		<h5 class="card-title mb-1 mt-3">Cambiar foto de perfil</h5>
		<p class="card-subtitle mb-4">Cambia tu foto de perfil desde aquí</p>
		<div class="text-center">
		<?php if (!empty($foto)): ?>
			<img src="view/fotos/thumbnails/<?php echo $foto['namePhoto'] ?>" alt="" class="user-avatar-xxl2 rounded-circle">
		<?php else: ?>
			<?php if ($_SESSION['genero'] == 1): ?>
				<span style="background-color: #29CEE8; border-radius: 50%; width: 128px; height: 128px; display: inline-flex; justify-content: center; align-items: center;">
				<?php else: ?>
					<span style="background-color: #F56CC1; border-radius: 50%; width: 128px; height: 128px; display: inline-flex; justify-content: center; align-items: center;">
					<?php endif ?>
					<p class="mt-1" style="color: white; font-size:30px"><?php echo $perfil; ?></p>
				</span>
			<?php endif ?>
			<div class="align-items-center justify-content-center my-4 gap-3">
				<button class="btn btn-primary rounded" data-toggle="modal" data-target="#exampleModal">Actualizar</button>
			</div>
			<p class="mb-0">Permitido JPG o PNG. Tamaño máximo de 2 MB</p>
		</div>
	</div>
</div>


<div
	class="modal fade"
	id="exampleModal"
	tabindex="-1"
	role="dialog"
	aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row" style="flex-direction: column;">
					<p class="titulo-tablero mb-0" id="exampleModalLabel">Cambiar foto de perfil</p>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="row" style="align-items: center;" id="subirGasto-form" enctype="multipart/form-data">
					<div class="col-xl-12">
						<div class="dropzone my-3" id="documentos-dropzone">
							<div class="dz-message">
								Arrastra y suelta tu foto aquí o haz clic para seleccionar archivos para cargar.
								<p class="subtitulo-sup">
									Tipos de archivo permitidos .jpg, .jpeg, .png (Tamaño máximo 2 MB)
								</p>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary rounded" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script>

Dropzone.autoDiscover = false;

$(document).ready(function() {
	var myDropzone = new Dropzone("#documentos-dropzone", {
		url: "ajax/ajax.formularios.php",
		type: "POST",
		paramName: "file",
		maxFilesize: 2,
		acceptedFiles: ".jpg, .jpeg, .png",
		addRemoveLinks: true,
		dictRemoveFile: "Eliminar archivo",
		parallelUploads: 100,
		maxFiles: 1,
		uploadMultiple: false,
	});
});

</script>