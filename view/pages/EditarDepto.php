<?php 
$datos = ControladorFormularios::ctrVerDepartamentos("idDepartamentos",$_GET['Edicion']);
if ($datos['Empleados_idEmpleados']!=0) {
	$empleadoDpto = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $datos['Empleados_idEmpleados']); 
}
$empleadosDpto = ControladorEmpleados::ctrVerEmpleadosDisponibles("departamentos"); 
$registro = ControladorFormularios::ctrActualizarDepto();
$empresas = ControladorFormularios::ctrVerEmpresas(null,null);
?>
<div class="container-fluid dashboard-content ">

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
						<?php foreach ($empleadosDpto as $key => $empleado): ?>
							<option value="<?php echo $empleado['idEmpleados']; ?>">
								<?php echo ucwords(strtolower($empleado['name']." ".$empleado['lastname'])); ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="empresa" class="col-form-label font-weight-bold">Empresa:</label>
					<select class="form-control" id="empresa" name="empresa">
							<option>
								Seleccionar empresa
							</option>
						<?php foreach ($empresas as $key => $empresa): ?>
							<option value="<?php echo $empresa['idEmpresas']; ?>">
								<?php echo ucwords(strtolower($empresa['nombre_razon_social']." (".$empresa['rfc'].")")); ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="row mt-5 rounded float-right">
					<div class="text-center">
						<input type="hidden" name="idDepto" value="<?php echo $_GET['Edicion']; ?>">
						<button type="submit" name="accion" class="btn btn-primary mr-1" value="<?php echo $_GET['Edicion'] ?>">Enviar</button>
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