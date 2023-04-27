<?php 
$empleados = ControladorFormularios::ctrVerEmpleadosDisponibles(); 

$datos = ControladorFormularios::ctrVerDepartamentos("idDepartamentos",$_POST['Edicion']);
if ($datos['Empleados_idEmpleados']!=0) {
	$empleadoDpto = ControladorFormularios::ctrVerEmpleados("idEmpleados", $datos['Empleados_idEmpleados']); 
}
$registro = ControladorFormularios::ctrActualizarDepto();
?>
<div class="container-fluid dashboard-content ">
	<!-- ============================================================== -->
	<!-- pageheader	-->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header">
				<h2 class="pageheader-title">Departamento (<?php echo $datos['nameDepto']; ?>)</h2>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="Inicio" class="breadcrumb-link">IN Consulting México</a></li>
							<li class="breadcrumb-item" aria-current="page"><a href="Departamento" class="breadcrumb-link">Departamentos</a></li>
							<li class="breadcrumb-item active" aria-current="page">Departamento (<?php echo $datos['nameDepto']; ?>)</li>
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

			echo '<div class="alert alert-success">¡Departamento Actualizado con exito!</div>';

		}
		if ($registro == "error") {

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
					<label for="name" class="col-form-label font-weight-bold">Nombre:</label>
					<input type="text" class="form-control" id="name" name="name" value="<?php echo $datos['nameDepto']; ?>" required>
				</div>
				<div class="form-group">
					<label for="jefe" class="col-form-label font-weight-bold">Jefe del departamento:</label>
					<select class="form-control" id="jefe" name="jefe">
							<option>
								Selecciona un empleado
							</option>
							<?php if ($datos['Empleados_idEmpleados'] != 0): ?>
							<option value="<?php echo $datos['Empleados_idEmpleados']; ?>" selected>
								<?php echo ucwords(strtolower($empleadoDpto['name']." ".$empleadoDpto['lastname'])); ?>
							</option>
							<?php endif ?>
						<?php foreach ($empleados as $key => $empleado): ?>
							<option value="<?php echo $empleado['idEmpleados']; ?>">
								<?php echo ucwords(strtolower($empleado['name']." ".$empleado['lastname'])); ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="description" class="col-form-label font-weight-bold">Descripción:</label>
					<textarea class="form-control" id="description" name="description" rows="5"><?php echo $datos['description']; ?></textarea>
				</div>
				<div class="row mt-5 rounded float-right">
					<div class="text-center">
						<input type="hidden" name="idDepto" value="<?php echo $_POST['Edicion']; ?>">
						<button type="submit" name="accion" class="btn btn-primary mr-1" value="<?php echo $_POST['Edicion'] ?>">Enviar</button>
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