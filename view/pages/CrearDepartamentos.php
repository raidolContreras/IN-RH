<?php 
$empleados = ControladorEmpleados::ctrVerEmpleadosDisponibles("departamentos"); 
$registro = ControladorFormularios::ctrRegistrarDeptos();
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