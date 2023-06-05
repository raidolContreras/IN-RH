<?php 

$eliminar = ControladorFormularios::ctrEliminarNoticia(); 
$noticias = ControladorFormularios::ctrVerNoticias("idNoticias", $_GET['noticia']); ?>

<div class="container-fluid dashboard-content ">
		<?php 

		/*=============================================
		FORMA EN QUE SE INSTANCIA LA CLASE DE UN MÉTODO ESTÁTICO 
		=============================================*/

		if($eliminar == "ok"){
			echo '<script>
			location.href="Inicio";
			</script>';

			echo '<div class="alert alert-success">¡Noticia Eliminada con exito!</div>';
		}
		if ($eliminar == "error") {

			echo '<script>

			if ( window.history.replaceState ) {

				window.history.replaceState( null, null, window.location.href );

			}

			</script>';

			echo '<div class="alert alert-danger">¡<b>Error</b>, no se pudo eliminar la noticia!, intentalo de nuevo</div>';
		}
		?>
<div class="container">
	<div class="card">
		<div class="card-body">
			<form method="POST">
				<div class="form-group">
					<p style="font-size: 26px;">Antes de continuar, por favor confirme que desea eliminar la noticia seleccionada. Esta acción es ireversible. Si está seguro, haga clic en el botón "Eliminar". De lo contrario, haga clic en "Cancelar".</p>
				</div>
				<div class="row mt-5 rounded float-right">
					<div class="text-center">
						<input type="hidden" name="idNoticia" value="<?php echo $_GET['noticia']; ?>">
						<button type="submit" name="accion" class="btn btn-primary mr-1" value="eliminar">Eliminar</button>
					</div>
					<div class="text-center">
						<a href="Inicio" class="btn btn-danger mr-3">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

	</div>
</div>
