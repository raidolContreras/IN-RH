<?php
$colaborador = ControladorFormularios::ctrVerEmpleados( 'idEmpleados',$_POST['Editar']); 

$Numbero = ControladorFormularios::ctrNumeroTelefonico($colaborador['phone']);
$emergencia = ControladorFormularios::ctrNumeroTelefonico($colaborador['phoneEmer']);
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
						<img src="assets/images/avatar-1.jpg" alt="User Avatar" class="rounded-circle user-avatar-xxl">
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
			<div class="row">
				<div class="col-4 pb-3">
					<form method="POST" action="Edicion">
						<button class="btn btn-primary rounded btn-block" name="Editar" value="<?php echo $colaborador['idEmpleados'];?>">
							<i class="fa fa-edit"></i> Editar
						</button>
					</form>
				</div>
				<div class="col-4 pb-3">
					<form method="POST" action="Formacion">
						<button class="btn btn-warning rounded btn-block" name="Formacion" value="<?php echo $colaborador['idEmpleados'];?>">
							<i class="ti-bookmark-alt"></i> Agregar formación
						</button>
					</form>
				</div>
				<div class="col-4 pb-3">
					<form method="POST" action="HistorialLaboral">
						<button class="btn btn-info rounded btn-block" name="Historial" value="<?php echo $colaborador['idEmpleados'];?>">
							<i class="fas fa-history"></i> Agregar historial
						</button>
					</form>
				</div>

				<div class="card">
					<?php 
					$history = ControladorFormularios::ctrSeleccionarHisrory($colaborador["idEmpleados"]);
					$i = 0;
					?>

					<link rel="stylesheet" href="assets/libs/css/timeline.css">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="card-body">
									<h3 class="card-title hprofile"></h3>
									<div id="content">
										<ul class="timeline">
											<li class="">
												<h2 class="hprofile"><i class="icon-briefcase"></i> Experiencia laboral</h2>
											</li>
											<?php 

											foreach ($history as $key => $laboral): 

												?>
												<?php if ($laboral['fecha_fin'] == null): ?>
													<li class="event" data-date="<?php echo ControladorFormularios::ctrFecha($laboral['fecha_inicio']); ?> - Actualidad">
													<?php else: ?>
														<li class="event" data-date="<?php echo ControladorFormularios::ctrFecha($laboral['fecha_inicio']); ?> - <?php echo ControladorFormularios::ctrFecha($laboral['fecha_fin']); ?>">
														<?php endif ?>
														<h3 class="hprofile"><?php echo $laboral['empresa']; ?></h3>
														<p><?php echo $laboral['puesto']; ?>

														<?php if ($laboral['salario'] != null): ?>
															- <?php
															$amount = $laboral['salario'];
															$formatted_amount = '$' . number_format($amount, 0) . ' MXN';
															echo $formatted_amount; 
															?>

														<?php endif ?>

													</p>
												</li>
												<?php $i++; ?>
											<?php endforeach ?>
											<!-- si no tiene empleos previos se activa un botón para agregarlos -->
											<?php if ($i==0): ?>
												<li class="event">
													<form action="HistorialLaboral" method="post">
														<h3 class="hprofile">Agregar Historial</h3>
														<button class="btn btn-success rounded-circle" name="Historial" value="<?php echo $colaborador["idEmpleados"]; ?>"><i class="ti-plus"></i></button>
													</form>
												</li>
											<?php endif ?>
											<li class="">
												<h2 class="hprofile"><i class="ti ti-bookmark-alt"></i> Formación</h2>
											</li>
											<li class="event" data-date="Nov' 19 - Actualidad">
												<h3 class="hprofile">Opening Ceremony</h3>
												<p>Get ready for an exciting event, this will kick off in amazing fashion with MOP &amp; Busta Rhymes as an opening show.</p>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>