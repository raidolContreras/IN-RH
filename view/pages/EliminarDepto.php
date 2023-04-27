<?php 
$eliminar = ControladorFormularios::ctrEliminarDepto(); 
$datos = ControladorFormularios::ctrVerDepartamentos("idDepartamentos",$_POST['Eliminar']);
?>
<div class="container-fluid dashboard-content ">
	<!-- ============================================================== -->
	<!-- pageheader	-->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header">
				<h2 class="pageheader-title">Eliminar Departamento (<?php echo $datos['nameDepto']; ?>)</h2>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="Inicio" class="breadcrumb-link">IN Consulting México</a></li>
							<li class="breadcrumb-item" aria-current="page"><a href="Departamento" class="breadcrumb-link">Departamentos</a></li>
							<li class="breadcrumb-item active" aria-current="page">Eliminar Departamento (<?php echo $datos['nameDepto']; ?>)</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>

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
						<input type="hidden" name="idDepto" value="<?php echo $_POST['Eliminar']; ?>">
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
