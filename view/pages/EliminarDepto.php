<?php if (!empty($rol) && $rol['Del_Departamentos'] == 1): ?>
<?php 
$eliminar = ControladorFormularios::ctrEliminarDepto(); 
$datos = ControladorFormularios::ctrVerDepartamentos("idDepartamentos",$_GET['Eliminar']);
?>
<div class="container-fluid dashboard-content ">
		<?php 

		/*=============================================
		FORMA EN QUE SE INSTANCIA LA CLASE DE UN MÉTODO ESTÁTICO 
		=============================================*/

		if($eliminar == "ok"){
			echo '<script>
			location.href="Departamento";
			</script>';

			echo '<div class="alert alert-success">¡Departamento Eliminado con exito!</div>';
		}
		if ($eliminar == "error") {

			echo '<script>

			if ( window.history.replaceState ) {

				window.history.replaceState( null, null, window.location.href );

			}

			</script>';

			echo '<div class="alert alert-danger">¡<b>Error</b>, no se pudo actualizar el departamento!, intentalo de nuevo</div>';
		}
		?>
<div class="container">
	<div class="card">
		<div class="card-body">
			<form method="POST">
				<div class="form-group">
					<p style="font-size: 26px;">Antes de continuar, por favor confirme que desea eliminar el departamento seleccionado. Esta acción es reversible, pero puede afectar el funcionamiento de la organización. Si está seguro, haga clic en el botón "Eliminar". De lo contrario, haga clic en "Cancelar".</p>
				</div>
				<div class="row mt-5 rounded float-right">
					<div class="text-center">
						<input type="hidden" name="idDepto" value="<?php echo $_GET['Eliminar']; ?>">
						<button type="submit" name="accion" class="btn btn-primary mr-1" value="eliminar">Eliminar</button>
					</div>
					<div class="text-center">
						<a href="Departamento" class="btn btn-danger mr-3">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

	</div>
</div>
<?php else: ?>
	<script>
		window.location.href = 'Inicio';
	</script>
<?php endif ?>
