<?php
$colaborador = ControladorFormularios::ctrVerEmpleados( 'idEmpleados',$_POST['Editar']); 

$Numbero = ControladorFormularios::ctrNumeroTelefonico($colaborador['phone']);
$emergencia = ControladorFormularios::ctrNumeroTelefonico($colaborador['phoneEmer']);
$foto = ControladorFormularios::ctrVerFotos("Empleados_idEmpleados", $colaborador['idEmpleados']);
?>
<div class="container-fluid dashboard-content ">
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header">
				<h3 class="mb-2">Perfil del colaborador</h3>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="Inicio" class="breadcrumb-link">IN Consulting México</a></li>
							<li class="breadcrumb-item active" aria-current="page">Perfil (<?php echo ucwords($colaborador["name"]." ".$colaborador["lastname"]); ?>)</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
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
						<p>ID: <?php echo $colaborador['identificacion'] ?></p>
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
						<li class="header-li"><i class="mdi mdi-calendar-blank"></i> Disponibilidad</li>

						<li><?php echo $colaborador["fecha_contratado"] ?></li>

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
					<h3 class="font-16 hprofile">Acciones</h3>

						<form method="POST" action="Documento" class="container pb-2">
							<button class="btn btn-primary rounded btn-block " name="empleado" value="<?php echo $colaborador['idEmpleados'];?>">
								<i class="ti-upload"></i> Subir Documentos
							</button>
						</form>

					<div>
						<div class="container">
							<button type="button" class="btn btn-danger rounded btn-block" data-toggle="modal" data-target="#eliminar">
								Dar de baja
							</button>

							<div class="modal fade" id="eliminar">
								<div class="modal-dialog">
									<div class="modal-content">

										<div class="modal-header">
											<h4 class="modal-title">Baja (<?php echo strtoupper($colaborador['name']." ".$colaborador['lastname']); ?>)</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>

										<div class="modal-body">
											<p>Seguro que deseas dar de baja a <?php echo strtoupper($colaborador['name']." ".$colaborador['lastname']); ?>, esta acción <strong>si </strong>puede deshacerse</p>

										</div>

										<div class="modal-footer">
											<form method="POST">
												<?php if (isset($_POST['Eliminar']) && $_POST['Eliminar'] == 'si'): ?>
													<?php $baja = ControladorFormularios::ctrEliminarEmpleado(); ?>
													<?php if ($baja == 'ok'): ?>
														<div class="alert alert-success">¡Colaborador dado de baja!</div>
														<script>

															window.location = "Empleados";

														</script>
													<?php elseif($baja == 'error'): ?>
														<script>

															if ( window.history.replaceState ) {

																window.history.replaceState( null, null, window.location.href );

															}

														</script>
														<div class="alert alert-danger">Error, no se pudo dar de baja alcolaborador, Intentelo de nuevo</div>
													<?php endif ?>
												<?php endif ?>
												<input type="hidden" name="Editar" value="<?php echo $colaborador['idEmpleados'];?>">
												<input type="hidden" name="Eliminar" value="si">
												<button class="btn btn-danger rounded float-right" >
													<i class="fas fa-eraser"></i> Dar de baja
												</button>
											</form>

											<button class="btn btn-success rounded float-right" data-dismiss="modal">
												Cancelar
											</button>

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
						<button class="btn btn-dark rounded btn-block" onClick="cargarContenido('Nominas.php')">
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