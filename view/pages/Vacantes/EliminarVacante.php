<?php 
$eliminar = ControladorFormularios::ctrEliminarVacante(); 
$datos = ControladorFormularios::ctrVerVacantes("idVacantes",$_GET['Eliminar']);
?>
<div class="container-fluid dashboard-content ">
		<?php 

		/*=============================================
		FORMA EN QUE SE INSTANCIA LA CLASE DE UN MÉTODO ESTÁTICO 
		=============================================*/

		if($eliminar == "ok"){
			echo '<script>
			location.href="Vacantes";
			</script>';

			echo '<div class="alert alert-success">¡Vacante Eliminada con exito!</div>';
		}
		if ($eliminar == "error") {

			echo '<script>

			if ( window.history.replaceState ) {

				window.history.replaceState( null, null, window.location.href );

			}

			</script>';

			echo '<div class="alert alert-danger">¡<b>Error</b>, no se pudo eliminar la vacante!, intentalo de nuevo</div>';
		}
		?>
<div class="container">
	<div class="card">
		<div class="card-body">
				<div class="form-group">
					<p style="font-size: 26px;">Antes de continuar, por favor confirme que desea eliminar la vacante seleccionada. Esta acción es reversible, pero puede afectar el funcionamiento de la organización. Si está seguro, haga clic en el botón "Eliminar". De lo contrario, haga clic en "Cancelar".</p>
				</div>
		</div>
		<div class="card-footer p-0 text-center d-flex justify-content-center ">
			<div class="card-footer-item card-footer-item-bordered">
			    <a href="Vacantes" class="card-link btn btn-outline-primary">Cancelar</a>
			</div>
			<div class="card-footer-item card-footer-item-bordered">
				<form method="POST">
					<input type="hidden" name="vacante" value="<?php echo $_GET['Eliminar']; ?>">
				    <button type="submit" name="accion" class="card-link btn btn-outline-secondary">Eliminar</button>
				</form>
			</div>
		</div>
	</div>
</div>

	</div>
</div>
