<?php 
$empleados = ControladorFormularios::ctrVerEmpleadosDisponibles("departamentos"); 
$registro = ControladorFormularios::ctrRegistrarDeptos();
?>
<div class="container-fluid dashboard-content ">
	<!-- ============================================================== -->
	<!-- pageheader	-->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header">
				<h2 class="pageheader-title">Crear Departamento</h2>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="Inicio" class="breadcrumb-link">IN Consulting México</a></li>
							<li class="breadcrumb-item" aria-current="page"><a href="Departamento" class="breadcrumb-link">Departamentos</a></li>
							<li class="breadcrumb-item active" aria-current="page">Crear Departamento</li>
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

		if($registro == "ok"){

			echo '<script>
			location.href="Departamento";
			</script>';

			echo '<div class="alert alert-success">¡Departamento creado Exitosamente!</div>';

		}
		if ($registro == "error") {

			echo '<script>

			if ( window.history.replaceState ) {

				window.history.replaceState( null, null, window.location.href );

			}

			</script>';

			echo '<div class="alert alert-danger">¡<b>Error</b>, no se pudo crear departamento!, intentalo de nuevo</div>';
		}

		?>
<div class="container">
	<div class="card">
		<div class="card-body">
			<form method="POST">
				<div class="form-group">
					<label for="name" class="col-form-label font-weight-bold">Nombre:</label>
					<input type="text" class="form-control" id="name" name="name" required>
				</div>
				<div class="form-group">
					<label for="jefe" class="col-form-label font-weight-bold">Jefe del departamento:</label>
					<select class="form-control" id="jefe" name="jefe">
							<option>
								Selecciona un empleado
							</option>
						<?php foreach ($empleados as $key => $empleado): ?>
							<option value="<?php echo $empleado['idEmpleados']; ?>">
								<?php echo ucwords(strtolower($empleado['name']." ".$empleado['lastname'])); ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="row mt-5 rounded float-right">
					<div class="text-center">
						<button type="submit" name="accion" class="btn btn-primary mr-1" value="otro">Enviar</button>
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