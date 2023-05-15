<?php 
$empleados = ControladorEmpleados::ctrVerEmpleadosDisponibles("puesto"); 
$departamento = ControladorFormularios::ctrVerDepartamentos(null, null);
$registro = ControladorFormularios::ctrRegistrarPuestos();
?>
<link rel="stylesheet" href="assets/vendor/datepicker/tempusdominus-bootstrap-4.css" />
<div class="container-fluid dashboard-content ">

	<?php 

/*=============================================
FORMA EN QUE SE INSTANCIA LA CLASE DE UN MÉTODO ESTÁTICO 
=============================================*/

if($registro == "ok"){

	echo '<div class="alert alert-success">¡Puesto Asignado Exitosamente!</div>';

}
if ($registro == "error") {

	echo '<script>

	if ( window.history.replaceState ) {

		window.history.replaceState( null, null, window.location.href );

	}

	</script>';

	echo '<div class="alert alert-danger">¡<b>Error</b>, no se pudo asignar el puesto!, intentalo de nuevo</div>';
}
if ($registro == '2') {
	echo "<div class=\"alert alert-danger\">¡<b>Error</b>, el nombre del puesto solo debe contener letras y espacios, intentalo de nuevo</div>";
}

?>
	<div class="container">
		<div class="card">
			<div class="card-body">
				<form method="POST">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="name" class="col-form-label font-weight-bold">Nombre del puesto:</label>
								<input type="text" class="form-control" id="name" name="name" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="salario" class="col-form-label font-weight-bold">Salario:</label>
								<input type="text"  maxlength="10" class="form-control" id="salario" name="salario" pattern="[0-9]+(\.[0-9]{1,2})?" title="Ingrese un número con hasta dos decimales" required onkeypress="return (event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47)" min="1">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="salario_integrado" class="col-form-label font-weight-bold">Salario Diario Integrado:</label>
								<input type="text"  maxlength="10" class="form-control" id="salario_integrado" name="salario_integrado" pattern="[0-9]+(\.[0-9]{1,2})?" title="Ingrese un número con hasta dos decimales" required onkeypress="return (event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47)" min="1">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="empleado" class="col-form-label font-weight-bold">Empleado:</label>
								<select class="form-control" id="empleado" name="empleado">
									<option>Selecciona un empleado</option>
									<?php foreach ($empleados as $key => $empleado): ?>
										<option value="<?php echo $empleado['idEmpleados']; ?>">
											<?php echo ucwords(strtolower($empleado['name']." ".$empleado['lastname'])); ?>
										</option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="departamento" class="col-form-label font-weight-bold">Departamento:</label>
								<select class="form-control" id="departamento" name="departamento">
									<option>Selecciona un departamento</option>
									<?php foreach ($departamento as $key => $depto): ?>
										<option value="<?php echo $depto['idDepartamentos']; ?>">
											<?php echo ucwords(strtolower($depto['nameDepto'])); ?>
										</option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="horario_entrada" class="col-form-label font-weight-bold">Horario de entrada:</label>
								<input type="time" class="form-control" id="horario_entrada" name="horario_entrada" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="horario_salida" class="col-form-label font-weight-bold">Horario de salida:</label>
								<input type="time" class="form-control" id="horario_salida" name="horario_salida" required>
							</div>
						</div>
					</div>
					<div class="form-group float-right">
						<button type="submit" class="btn btn-primary rounded">Registrar</button>
						<a href="Puestos" class="btn btn-danger rounded">Cancelar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
<script src="assets/libs/js/main-js.js"></script>
<script src="assets/vendor/datepicker/moment.js"></script>
<script src="assets/vendor/datepicker/tempusdominus-bootstrap-4.js"></script>
<script src="assets/vendor/datepicker/datepicker.js"></script>