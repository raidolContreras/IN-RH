<?php $vacante = ControladorFormularios::ctrVerVacantes('idVacantes', $_GET['vacante']); ?>
<div class="container-fluid dashboard-content ">
	<div class="">
	<!-- ============================================================== -->
	<!-- pageheader  -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header">
				<h2 class="pageheader-title">Postulación (<?php echo $vacante['nameVacante'] ?>)</h2>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="Inicio" class="breadcrumb-link">IN Consulting México</a></li>
							<li class="breadcrumb-item"><a href="Vacantes" class="breadcrumb-link">Ofertas de empleo</a></li>
							<li class="breadcrumb-item active" aria-current="page">Postulación (<?php echo $vacante['nameVacante'] ?>)</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- end pageheader	-->
	<!-- ============================================================== -->
	<div class="ecommerce-widget">

		<div class="row justify-content-center">
			<div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card">
					<div class="card-body">
						<h2>Oferta laboral: </h2>
						<h3 class="hprofile"><?php echo $vacante['nameVacante'] ?></h3>
						<h2>Salario: </h2>
						<h3 class="hprofile"><?php echo $vacante['salarioVacante'] ?></h3>
						<h2>Requisitos: </h2>
						<h3 class="hprofile"><?php echo $vacante['requisitos'] ?></h3>
					</div>
				</div>
			</div>
			<div class="col-xl-7 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="card">
					<div class="card-body">
						<form id="formulario" class="mt-4" method="post" id="registro-form" enctype="multipart/form-data">
							<h2>Llena el formulario para postularte</h2>

								<?php 

								/*=============================================
								FORMA EN QUE SE INSTANCIA LA CLASE DE UN MÉTODO ESTÁTICO 
								=============================================*/
								$registro = ControladorFormularios::ctrRegistrarPostulante();

								if($registro == "ok"){

									echo '<div class="alert alert-success">¡Datos Enviados Exitosamente!</div>';

								}elseif ($registro == "Error: 1") {

									echo '<script>

									if ( window.history.replaceState ) {

										window.history.replaceState( null, null, window.location.href );

									}

									</script>';

									echo '<div class="alert alert-danger">Error, el nombre y apellidos solo pueden contener letras y espacios, intente de nuevo</div>';
								}elseif ($registro == "Error: 2") {

									echo '<script>

									if ( window.history.replaceState ) {

										window.history.replaceState( null, null, window.location.href );

									}

									</script>';

									echo '<div class="alert alert-danger">Error, el Correo utilizado es inválido, intente de nuevo</div>';
								}elseif ($registro == "Error: 3") {

									echo '<script>

									if ( window.history.replaceState ) {

										window.history.replaceState( null, null, window.location.href );

									}

									</script>';

									echo '<div class="alert alert-danger">Error, el numero telófonico es incorrecto, intente de nuevo</div>';
								}elseif ($registro == "Error: 4") {

									echo '<script>

									if ( window.history.replaceState ) {

										window.history.replaceState( null, null, window.location.href );

									}

									</script>';

									echo '<div class="alert alert-danger">Error, Hubo un error inesperado, intente de nuevo</div>';
								}

								?>
								<div class="card-body">
									<div class="form-row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="nombre">Nombre(s)</label>
												<input type="text" class="form-control" id="nombre" name="nombre" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="apellidos">Apellidos</label>
												<input type="text" class="form-control" id="apellidos" name="apellidos" required>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-6">	
											<div class="form-group">
												<label for="telefono">Teléfono</label>
												<input type="tel" class="form-control" id="telefono" name="telefono" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="email">Email</label>
												<input type="email" class="form-control" id="email" name="email" required>
											</div>
										</div>
									</div>

									<hr>
										<div class="form-group">
											<label for="curriculum">Curriculum</label>
											<input type="hidden" name="archivo" value="curriculum">
											<input type="file" accept=".pdf" class="form-control-file" id="curriculum" name="file" required>
										</div>
									<hr>

									<input type="hidden" name="Oferta" value="<?php echo $vacante['idVacantes']; ?>">
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Enviar</button>
									</div>
								</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>