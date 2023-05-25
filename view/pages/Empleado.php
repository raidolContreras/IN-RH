<?php
$colaborador = ControladorEmpleados::ctrVerEmpleados( 'idEmpleados',$_GET['perfil']); 

$Numbero = ControladorFormularios::ctrNumeroTelefonico($colaborador['phone']);
$emergencia = ControladorFormularios::ctrNumeroTelefonico($colaborador['phoneEmer']);
$foto = ControladorFormularios::ctrVerFotos("Empleados_idEmpleados", $colaborador['idEmpleados']);
$puesto = ControladorFormularios::ctrVerPuestos("Empleados_idEmpleados", $_GET['perfil']);
?>
<div class="container-fluid dashboard-content ">
	<div class="row">
		<div class="col-xl-3 col-lg-3 col-md-5 col-sm-12 col-12">
			<div class="card">
				<div class="card-body">
					<div class="user-avatar text-center d-block">
						<?php if (!empty($foto)): ?>
							<img src="view/fotos/thumbnails/<?php echo $foto['namePhoto'] ?>" alt="User Avatar" class="rounded-circle user-avatar-xxl2">
						<?php else: ?>
							<form method="POST" action="Foto">
								<button type="submit" class="btn btn-info rounded" name="empleado" value="<?php echo $colaborador['idEmpleados']; ?>">
									Subir foto
								</button>
							</form>
						<?php endif ?>
					</div>
					<div class="text-center">
						<h2 class="font-24 mb-0 hprofile"><?php echo ucwords($colaborador["name"]." ".$colaborador["lastname"]) ?></h2>
						<p>Puesto: <?php echo $puesto['namePuesto'] ?> <br>
							Salario: <?php echo $puesto['salario'] ?></p>
					</div>
				</div>
				<div class="card-body border-top">
					<h3 class="font-16 hprofile">Datos de Contacto</h3>
					<ul class="mb-0 list-unstyled">
						<li class="header-li"><i class="far fa-envelope"></i> Correo</li>

						<li><?php echo $colaborador["email"] ?></li>

						<li class="header-li"><i class="icon-phone"></i> Teléfono</li>

						<li><?php echo $Numbero ?></li>

						<li class="header-li"><i class="mdi mdi-home-outline"></i> Dirección</li>

						<?php if ($colaborador['numI'] == null || $colaborador['numI'] == ""): ?>
							<li><?php echo $colaborador["street"].", #".$colaborador["numE"].", ".$colaborador["colonia"].", ".$colaborador["municipio"].", ".$colaborador["estado"]?></li>

						<?php else: ?>
							<li><?php echo $colaborador["street"].", #".$colaborador["numE"].", #".$colaborador["numI"].", ".$colaborador["colonia"].", ".$colaborador["municipio"].", ".$colaborador["estado"]?></li>

						<?php endif ?>
						<li class="header-li"><i class="mdi mdi-cake"></i> Fecha de nacimiento</li>

						<li><?php echo $colaborador["fNac"] ?></li>
						<li class="header-li"><i class="mdi mdi-calendar-blank"></i> Fecha de ingreso</li>

						<li><?php echo $colaborador["fecha_contratado"] ?></li>

						<?php if ($colaborador["fecha_baja"] != null): ?>

						<li class="header-li"><i class="mdi mdi-calendar-blank"></i> Fecha de baja</li>

						<li><?php echo $colaborador["fecha_baja"] ?></li>
							
						<?php endif ?>

					</ul>
				</div>
				<div class="card-body border-top">
					<h3 class="font-16 hprofile">Datos de emergencia</h3>
					<div>
						<ul class="mb-0 list-unstyled">
							<li class="header-li"><i class="mdi mdi-account-alert"></i> Nombre</li>
							<li><?php echo $colaborador["nameEmer"]." (".$colaborador["parentesco"].")" ?></li>
							<li class="header-li"><i class="icon-phone"></i> Teléfono</li>
							<li><?php echo $emergencia ?></li>
						</ul>
					</div>
				</div>
				<div class="card-body border-top">
							<?php if ($colaborador['status'] == 1): ?>
					<h3 class="font-16 hprofile">Acciones</h3>

						<form method="POST" action="Documento" class="container pb-2">
							<button class="btn btn-primary rounded btn-block " name="empleado" value="<?php echo $colaborador['idEmpleados'];?>">
								<i class="ti-upload"></i> Subir Documentos
							</button>
						</form>
							<?php endif ?>

					<div>
						<div class="container">
							<?php if ($colaborador['status'] == 1): ?>
								
							<button type="button" class="btn btn-danger rounded btn-block" data-toggle="modal" data-target="#eliminar">
								Dar de baja
							</button>
							<?php endif ?>

							<div class="modal fade" id="eliminar">
								<div class="modal-dialog">
									<div class="modal-content">

										<div class="modal-header">
											<h4 class="modal-title">Baja (<?php echo strtoupper($colaborador['name']." ".$colaborador['lastname']); ?>)</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>

											<form method="POST" id="baja-form">
										<div class="modal-body">
											<p>Seguro que deseas dar de baja a <?php echo strtoupper($colaborador['name']." ".$colaborador['lastname']); ?>, esta acción <strong>si </strong>puede deshacerse</p>

												<input type="date" class="form-control" name="fecha_baja" required>
										</div>

										<div class="modal-footer">
											<div class="col-12" id="form-result"></div>
												<input type="hidden" name="empleado" value="<?php echo $colaborador['idEmpleados'];?>">
												<input type="hidden" name="EliminarEmpleado" value="1">
												<button class="btn btn-danger rounded float-right" id="baja-btn" type="button">
													<i class="fas fa-eraser"></i> Dar de baja
												</button>
											</form>

											<button class="btn btn-success rounded float-right">
												Cancelar
											</button>

											<script>
												
												$(document).ready(function() {
													$("#baja-btn").click(function() {
													var formData = $("#baja-form").serialize(); // Obtener los datos del formulario

														$.ajax({
															url: "ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
															type: "POST",
															data: formData,
															success: function(response) {

																if (response === '"ok"') {
																	$("#form-result").val("");
																	$("#form-result").parent().after(`
																		<div class='alert alert-success'>Empleado eliminado</div>
																		`);
																	setTimeout(function() {
																		location.href="Empleados";
																	}, 500);
																}else if (response === '"Error: usuario"') {
																	$("#form-result").val("");
																	$("#form-result").parent().after(`
																		<div class='alert alert-warning'>Empleado no encontrado</div>
																		`);
																	setTimeout(function() {
																		location.href="Empleados";
																	}, 500);
																}else{
																	$("#form-result").val("");
																	$("#form-result").parent().after(`
																		<div class='alert alert-danger'><b>Error</b>, no se elimino al empleado, intenta nuevamente</div>
																		`);
																}

															}
														});
													});
												});

											</script>

										</div>

									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-9 col-lg-9 col-md-7 col-sm-12 col-12">
			<div class="card p-3">
				<div class="row pb-2">
					<div class="col-4">
						<button class="btn btn-primary rounded btn-block" onClick="cargarContenido('Expedientes.php')">
							<i class="icon-folder-alt"></i> Expedientes
						</button>
					</div>
					<div class="col-4">
						<button class="btn btn-secondary rounded btn-block" onClick="cargarContenido('Incapacidades.php')">
								<i class="icon-shield"></i> Incapacidades
							</button>
					</div>
					<div class="col-4">
						<button class="btn btn-warning rounded btn-block" onClick="cargarContenido('ActaAdministrativa.php')">
								<span class="indicator"></span><i class="icon-book-open"></i> Actas administrativas (2)
							</button>
					</div>
				</div>
				<div class="row">
					<div class="col-4">
						<button class="btn btn-dark rounded btn-block" onClick="cargarContenido('NominasEmpleado.php')">
								<i class="icon-wallet"></i> Nominas
							</button>
					</div>
					<div class="col-4">
						<button class="btn btn-brand rounded btn-block" onClick="cargarContenido('Vacaciones.php')">
								<i class="icon-social-dribbble"></i> Formatos vacacionales
							</button>
					</div>
				</div>
			</div>
			<div>
				<div class="row" id="show">
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
function cargarContenido(pagina) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("show").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("POST", "view/pages/"+pagina+"?idEmpleados=" + "<?php echo $colaborador['idEmpleados']; ?>", true);
  xmlhttp.send();
}
</script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
