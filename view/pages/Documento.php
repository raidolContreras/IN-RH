<?php
$empleado = ControladorFormularios::ctrVerEmpleados("idEmpleados", $_POST["empleado"]); 
?>
<link rel="stylesheet" href="assets/libs/css/archivo.css">
<div class="container-fluid dashboard-content ">
	<!-- ============================================================== -->
	<!-- pageheader -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header">
				<h2 class="pageheader-title">Subir Documentos</h2>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="Inicio" class="breadcrumb-link">IN Consulting México</a></li>
							<li class="breadcrumb-item active" aria-current="page"><a href="Empleados" class="breadcrumb-link">Colaboradores</a></li>
							<li class="breadcrumb-item active" aria-current="page">Subir documentos</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="card shadow mb-5">
			<div class="card-body">
				<form method="POST" enctype="multipart/form-data">
					<?php
					$registro = ControladorFormularios::ctrSubirPDF();
					if ($registro == "ok") {
						echo '<script>
						if ( window.history.replaceState ) {
							window.history.replaceState( null, null, window.location.href );
						}
						</script>';
						echo '<div class="alert alert-success">¡Archivo PDF subido exitosamente!</div>';
					}
					if ($registro == "error") {
						echo '<script>
						if ( window.history.replaceState ) {
							window.history.replaceState( null, null, window.location.href );
						}
						</script>';
						echo '<div class="alert alert-danger">Error, no se pudo subir el archivo PDF, intente de nuevo</div>';
					}
					?>
					<div class="row">
						<div class="form-group p-2">
							<label for="curriculum">Curriculum</label>
							<input type="file" accept=".pdf" class="form-control-file" id="curriculum" name="curriculum"required>
						</div>
						<div class="form-group p-2">
							<label for="acta-nacimiento">Acta de Nacimiento</label>
							<input type="file" accept=".pdf" class="form-control-file" id="acta-nacimiento" name="acta-nacimiento" required>
						</div>
						<div class="form-group p-2">
							<label for="comprobante-domicilio">Comprobante de domicilio</label>
							<input type="file" accept=".pdf" class="form-control-file" id="comprobante-domicilio" name="comprobante-domicilio"required>
						</div>
					</div>
					<div class="row">
						<div class="form-group p-2">
							<label for="identificacion-anverso">Identificación Anverso</label>
							<input type="file" accept=".pdf" class="form-control-file" id="identificacion-anverso" name="identificacion-anverso" required>
						</div>
						<div class="form-group p-2">
							<label for="identificacion-reverso">Identificación Reverso</label>
							<input type="file" accept=".pdf" class="form-control-file" id="identificacion-reverso" name="identificacion-reverso" required>
						</div>
						<div class="form-group p-2">
							<label for="rfc">RFC (Constancia de situación fiscal)</label>
							<input type="file" accept=".pdf" class="form-control-file" id="rfc" name="rfc" required>
						</div>

					</div>
					<div class="row">
						<div class="form-group p-2">
							<label for="curp">CURP</label>
							<input type="file" accept=".pdf" class="form-control-file" id="curp" name="curp" required>
						</div>
						<div class="form-group p-2">
							<label for="nss">NSS</label>
							<input type="file" accept=".pdf" class="form-control-file" id="nss" name="nss" required>
						</div>
						<div class="form-group p-2">
							<label for="comprobante-estudios">Comprobante último grado de estudios</label>
							<input type="file" accept=".pdf" class="form-control-file" id="comprobante-estudios" name="comprobante-estudios" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group p-2">
							<label for="recomendacion-laboral">Carta de recomendación (Laboral)</label>
							<input type="file" accept=".pdf" class="form-control-file" id="recomendacion-laboral" name="recomendacion-laboral" required>
						</div>
						<div class="form-group p-2">
							<label for="recomendacion-personal">Carta de recomendación (Personal)</label>
							<input type="file" accept=".pdf" class="form-control-file" id="recomendacion-personal" name="recomendacion-personal" required>
						</div>
					</div>
					<input type="hidden" name="name" value="<?php echo $empleado['name'] ?>">
					<input type="hidden" name="lastname" value="<?php echo $empleado['lastname'] ?>">
					<input type="hidden" name="empleado" value="<?php echo $empleado['idEmpleados'] ?>">
					<center>
						<button type="submit" class="btn btn-primary rounded col-6">Subir Documentos</button>
					</center>
				</form>
			</div>
		</div>
	</div> 
</div>