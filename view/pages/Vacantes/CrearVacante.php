<?php 
$departamento = ControladorFormularios::ctrVerDepartamentos(null, null);
?>
<link rel="stylesheet" href="assets/vendor/datepicker/tempusdominus-bootstrap-4.css" />
<div class="container-fluid dashboard-content ">
<?php if (!isset($_GET['Editar'])): ?>
	<?php 

$registro = ControladorFormularios::ctrRegistrarVacantes();
/*=============================================
FORMA EN QUE SE INSTANCIA LA CLASE DE UN MÉTODO ESTÁTICO 
=============================================*/

if($registro == "ok"){

	echo '<div class="alert alert-success">¡Vacante Creada Exitosamente!</div>';

}
if ($registro == "error") {

	echo '<script>

	if ( window.history.replaceState ) {

		window.history.replaceState( null, null, window.location.href );

	}
	setTimeout(function() {
		  window.location.href = "Vacantes";
		}, 500);

	</script>';

	echo '<div class="alert alert-danger">¡<b>Error</b>, no se pudo crear la vacante!, intentalo de nuevo</div>';
}
if ($registro == '2') {
	echo "<div class=\"alert alert-danger\">¡<b>Error</b>, el nombre de la vacante solo debe contener letras y espacios, intentalo de nuevo</div>";
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
						<div class="col-md-12">
							<div class="form-group">
								<label for="requisitos" class="col-form-label font-weight-bold">Requisitos:</label>
								<textarea name="requisitos" id="requisitos" class="form-control"  cols="30" rows="10"></textarea>
							</div>
						</div>

					</div>
					<div class="form-group float-right">
						<button type="submit" class="btn btn-primary rounded">Registrar</button>
						<a href="Vacantes" class="btn btn-danger rounded">Cancelar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php else: ?>
<?php 

$registro = ControladorFormularios::ctrActualizarVacantes($_GET['Editar']);
$Vacante = ControladorFormularios::ctrVerVacantes("idVacantes", $_GET['Editar']);
$departamentoSeleccionado = ControladorFormularios::ctrVerDepartamentos('idDepartamentos', $Vacante['Departamentos_idDepartamentos']);
/*=============================================
FORMA EN QUE SE INSTANCIA LA CLASE DE UN MÉTODO ESTÁTICO 
=============================================*/

if($registro == "ok"){

	echo '<div class="alert alert-success">¡Vacante Actualizada Exitosamente!</div>
	<script>

	if ( window.history.replaceState ) {

		window.history.replaceState( null, null, window.location.href );

	}
	setTimeout(function() {
		  window.location.href = "Vacantes";
		}, 500);

	</script>';

}
if ($registro == "error") {

	echo '<script>

	if ( window.history.replaceState ) {

		window.history.replaceState( null, null, window.location.href );

	}

	</script>';

	echo '<div class="alert alert-danger">¡<b>Error</b>, no se pudo actualizar la vacante!, intentalo de nuevo</div>';
}
if ($registro == '2') {
	echo "<div class=\"alert alert-danger\">¡<b>Error</b>, el nombre de la vacante solo debe contener letras y espacios, intentalo de nuevo</div>";
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
								<input type="text" class="form-control" id="name" value="<?php echo $Vacante['nameVacante']; ?>" name="name" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="salario" class="col-form-label font-weight-bold">Salario:</label>
								<input type="text"  maxlength="10" class="form-control" id="salario" value="<?php echo $Vacante['salarioVacante']; ?>" name="salario" pattern="[0-9]+(\.[0-9]{1,2})?" title="Ingrese un número con hasta dos decimales" required onkeypress="return (event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47)" min="1">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="departamento" class="col-form-label font-weight-bold">Departamento:</label>
								<select class="form-control" id="departamento" value="<?php echo $Vacante['Departamentos_idDepartamentos']; ?>" name="departamento">

									<option value="<?php echo $departamentoSeleccionado['idDepartamentos']; ?>" selected>
										<?php echo $departamentoSeleccionado['nameDepto']; ?>
									</option>

									<?php foreach ($departamento as $key => $depto): ?>
										<?php if ($depto['idDepartamentos'] != $departamentoSeleccionado['idDepartamentos']): ?>
											<option value="<?php echo $depto['idDepartamentos']; ?>">
												<?php echo ucwords(strtolower($depto['nameDepto'])); ?>
											</option>
										<?php endif ?>
									<?php endforeach ?>

								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="requisitos" class="col-form-label font-weight-bold">Requisitos:</label>
								<textarea name="requisitos" id="requisitos" class="form-control"  cols="30" rows="10"><?php echo $Vacante['requisitos']; ?></textarea>
							</div>
						</div>

					</div>
					<div class="form-group float-right">
						<button type="submit" class="btn btn-primary rounded">Registrar</button>
						<a href="Vacantes" class="btn btn-danger rounded">Cancelar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php endif ?>