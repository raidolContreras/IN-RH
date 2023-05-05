<?php 
$departamento = ControladorFormularios::ctrVerDepartamentos(null, null);
$registro = ControladorFormularios::ctrRegistrarVacantes();
?>
<link rel="stylesheet" href="assets/vendor/datepicker/tempusdominus-bootstrap-4.css" />
<div class="container-fluid dashboard-content ">
	<!-- ============================================================== -->
	<!-- pageheader	-->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header">
				<h2 class="pageheader-title">Crear oferta</h2>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="Inicio" class="breadcrumb-link">IN Consulting México</a></li>
							<li class="breadcrumb-item" aria-current="page"><a href="Vacantes" class="breadcrumb-link">Ofertas de empleo</a></li>
							<li class="breadcrumb-item active" aria-current="page">Crear oferta</li>
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
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
<script src="assets/libs/js/main-js.js"></script>
<script src="assets/vendor/datepicker/moment.js"></script>
<script src="assets/vendor/datepicker/tempusdominus-bootstrap-4.js"></script>
<script src="assets/vendor/datepicker/datepicker.js"></script>