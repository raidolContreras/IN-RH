<?php 
$postulantes = ControladorFormularios::ctrVerPostulantes("Vacantes_idVacantes", $_POST['Postulantes']); 
$vacante = ControladorFormularios::ctrVerVacantes("idVacantes", $_POST['Postulantes']);
$calendary = ControladorFormularios::generarCalendario(); ?>
<style>	
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container-fluid dashboard-content ">
	<!-- ============================================================== -->
	<!-- pageheader	-->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header">
				<h2 class="pageheader-title">Postulantes (<?php echo $vacante['nameVacante'] ?>)</h2>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="Inicio" class="breadcrumb-link">IN Consulting México</a></li>
							<li class="breadcrumb-item" aria-current="page"><a href="Vacantes" class="breadcrumb-link">Ofertas de empleo</a></li>
							<li class="breadcrumb-item active" aria-current="page">Postulantes (<?php echo $vacante['nameVacante'] ?>)</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>

	<!-- ============================================================== -->
	<!-- end pageheader	-->
	<!-- ============================================================== -->
	<div class="ecommerce-widget row">
		<!-- ============================================================== -->
		<!-- data table	-->
		<!-- ============================================================== -->
		<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive" id="form-result">
						<table id="example" class="table table-striped table-bordered second" style="width:100%">
							<thead>
								<tr>
									<th data-class-name="priority">Nombre Completo</th>
									<th>Teléfono</th>
									<th>Email</th>
									<td width="15%">Acciones</td>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($postulantes as $key => $postulante): ?>
								<?php $reuniones = ControladorFormularios::ctrVerReuniones("Postulantes_idPostulantes", $postulante['idPostulantes']); ?>
								<?php $nReuniones = ControladorFormularios::ctrContarReuniones("Postulantes_idPostulantes", $postulante['idPostulantes']); ?>

									<script>
										$(document).ready(function() {
											$("#submit-btn<?php echo $postulante['idPostulantes'] ?>").click(function() {
												var formData = $("#cita-form<?php echo $postulante['idPostulantes'] ?>").serialize(); // Obtener los datos del formulario

												$.ajax({
													url: "ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
													type: "POST",
													data: formData,
													success: function(response) {
														if (response !== 'error') {
															$("#form-result").val("");
															$("#form-result").parent().after(`
																<div class='alert alert-success'>Cita agendada exitosamente, revisa tu correo y confirma la fecha (<b>`+response+`</b>)
																`);
														}else{
															$("#form-result").val("");
															$("#form-result").parent().after(`
																<div class='alert alert-danger'><b>Error</b>, No se pudo agendar la cita, intenta nuevamente
																`);
														}

													}
												});
											});
										});
									</script>

									<tr>
										<td>
											<?php if ($postulante['colorPostulante']==1): ?>
												<i class="fas fa-dot-circle" style="color: #06b729;"></i>
											<?php elseif ($postulante['colorPostulante']==2): ?>
												<i class="fas fa-dot-circle" style="color: #c0bb11;"></i>
											<?php elseif ($postulante['colorPostulante']==3): ?>
												<i class="fas fa-dot-circle" style="color: #d00b0b;"></i>
											<?php else: ?>
												<span class="badge badge-secondary ml-1">Nuevo</span>
											<?php endif ?> 
											<?php echo $postulante['namePostulante']." ".$postulante['lastnamePostulante'] ?>
										</td>
										<td><?php echo $postulante['phonePostulante']?></td>
										<td><?php echo $postulante['emailPostulante']?></td>
										<td>  <!-- Button to Open the Modal -->
											<table>
												<tr>
													<td>
														<button type="button" 
														class="btn btn-outline-danger rounded" 
														data-toggle="modal" 
														data-target="#Modal<?php echo $postulante['idPostulantes'] ?>">
														<i class="far fa-file-pdf"></i>
													</button>
													</td>
													<td>
														<button type="button" 
														class="btn btn-outline-secondary rounded" 
														data-toggle="modal" 
														data-target="#Date<?php echo $postulante['idPostulantes'] ?>">
														<i class="fas fa-calendar-plus"></i>
														</button>
													</td>
													<td>
														<button type="button" 
														class="btn btn-outline-primary rounded button" 
														data-toggle="modal" 
														data-target="#Comments<?php echo $postulante['idPostulantes'] ?>">
														<i class="fas fa-diagnoses"></i><span class="indicador"><?php echo $nReuniones[0] ?></span>
														</button>

													</td>
												</tr>
											</table>
										</td>
									</tr>

						<div class="modal fade" id="Date<?php echo $postulante['idPostulantes'] ?>">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">

									<form method="POST" class="container mt-4" id="cita-form<?php echo $postulante['idPostulantes'] ?>">

										<div class="modal-header">
											Agendar reunión (<?php echo $postulante['namePostulante']." ".$postulante['lastnamePostulante'] ?>)
										</div>
										<!-- Modal body -->
										<div class="modal-body card">
											<div class="card-body">

												<div class="form-row">

													<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12 form-group">
														<label for="dia">Día:</label>
														<select class="form-control" id="dia<?php echo $postulante['idPostulantes'] ?>" name="dia">
															<option value="1">1</option>
															<script>
																for (let i = 2; i <= 31; i++) {
																	document.write(`<option value="${i}">${i}</option>`);
																}
															</script>
														</select>
													</div>
													<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 form-group">
														<label for="mes">Mes:</label>
														<select class="form-control" id="mes" name="mes">
															<option value="1">Enero</option>
															<option value="2">Febrero</option>
															<option value="3">Marzo</option>
															<option value="4">Abril</option>
															<option value="5">Mayo</option>
															<option value="6">Junio</option>
															<option value="7">Julio</option>
															<option value="8">Agosto</option>
															<option value="9">Septiembre</option>
															<option value="10">Octubre</option>
															<option value="11">Noviembre</option>
															<option value="12">Diciembre</option>
														</select>
													</div>
													<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 form-group">

														<label for="año">Año:</label>
														<select class="form-control" id="año" name="anio">
															<option value="2023">2023</option>
															<option value="2024">2024</option>
															<option value="2025">2025</option>
															<option value="2026">2026</option>
															<option value="2027">2027</option>
															<option value="2028">2028</option>
															<option value="2029">2029</option>
															<option value="2030">2030</option>
														</select>
													</div>
													<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12 form-group">

														<label for="hora">Hora:</label>
														<select class="form-control" id="hora" name="hora">
															<option value="0">0</option>
															<script>
																for (let i = 1; i <= 23; i++) {
																	document.write(`<option value="${i}">${i}</option>`);
																}
															</script>
														</select>
													</div>
													<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12 form-group">

														<label for="minutos">Min:</label>
														<select class="form-control" id="minutos" name="minutos">
															<option value="0">0</option>
															<script>
																for (let i = 1; i <= 59; i++) {
																	document.write(`<option value="${i}">${i}</option>`);
																}
															</script>
														</select>
													</div>
												</div>
											</div>
										</div>

										<div class="modal-footer">
											<input type="hidden" name="validate" value="<?php echo $postulante['idPostulantes'] ?>">
											<button type="button" class="btn btn-outline-success rounded" id="submit-btn<?php echo $postulante['idPostulantes'] ?>" data-dismiss="modal">
												Agendar cita
											</button>
											<button class="btn btn-outline-danger rounded" data-dismiss="modal">
												Cancelar
											</button>
										</div>
									</form>

								</div>
							</div>
						</div>

						<div class="modal fade" id="Modal<?php echo $postulante['idPostulantes'] ?>">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">

									<!-- Modal body -->
									<div class="modal-body card">
										<div class="card-body">

											<!--API de Adobe gratuita para ver pdf online-->
											<div id="adobe-dc-view" style="height: 680px;"></div>
											<script src="https://documentservices.adobe.com/view-sdk/viewer.js"></script>
											<script type="text/javascript">
												document.addEventListener("adobe_dc_view_sdk.ready", function(){ 
													var adobeDCView = new AdobeDC.View({clientId: "a043d7dd0d7b45e1bbefa391730a4243", divId: "adobe-dc-view"});
													adobeDCView.previewFile({
														content:{location: {url: "view/pdfs/postulantes/<?php echo $postulante['idPostulantes'] ?>/curriculum.pdf"}},
														metaData:{fileName: "curriculum.pdf"}
													}, {defaultViewMode: "FIT_WIDTH", showAnnotationTools: false});
												});
											</script>
											<!--Fin de la API-->

										</div>
									</div>

								</div>
							</div>
						</div>

						<div class="modal fade" id="Comments<?php echo $postulante['idPostulantes'] ?>">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">

									<!-- Modal body -->
									<div class="modal-body card">
										<div class="card-body">
											<div class="modal-header">
												<h1>Reuniones</h1>
											</div>
											<div class="modal-content">
												<div class="row ml-3 mb-3">
												<?php foreach ($reuniones as $key => $reunion): ?>
													<?php if ($reunion['status'] == 0): ?>
														<div class="m-0 mt-3 mr-1 col-3 card-hover justify-content-center">
															<form class="container mt-4">
																<input type="hidden" name="reunion" value="<?php echo $reunion['idReuniones'] ?>">
																<label>Calificar reunión<br><?php echo date("d-m-Y h:i a", strtotime($reunion['fechaReunion'])); ?></label>
																<a href="Reuniones&reunion=<?php echo $reunion['idReuniones'] ?>" class="btn btn-outline-success rounded mx-5 mb-2"><i class="mdi mdi-account-edit"></i></a>
															</form>
														</div>
													<?php elseif ($reunion['status'] == 1): ?>
														<div class="m-0 mt-3 mr-1 col-3 card-hover justify-content-center">
															<form class="container mt-4" >
																<label>Calificar reunión<br><?php echo date("d-m-Y h:i a", strtotime($reunion['fechaReunion'])); ?></label>
																<button type="submit" class="btn btn-outline-success rounded mx-5 mb-2 disabled" disabled><i class="mdi mdi-account-edit"></i></button>
															</form>
														</div>
													<?php endif ?>
												<?php endforeach ?>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
	<div class="card">
		<div class="card-body">
			<div class="box">
				<?php include "view/pages/Calendario.php"; ?>
			</div>
		</div>
	</div>
</div>

</div>
</div>
</div>