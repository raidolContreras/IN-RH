<?php 
$postulantes = ControladorFormularios::ctrVerPostulantes("Vacantes_idVacantes", $_POST['Postulantes']); 
$vacante = ControladorFormularios::ctrVerVacantes("idVacantes", $_POST['Postulantes']); 
?><div class="container-fluid dashboard-content ">
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
							<li class="breadcrumb-item" aria-current="page"><a href="Vacantes" class="breadcrumb-link">Ofertas de trabajo</a></li>
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
	<div class="ecommerce-widget">
		<!-- ============================================================== -->
		<!-- data table	-->
		<!-- ============================================================== -->
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered second" style="width:100%">
							<thead>
								<tr>
									<th>Nombre Completo</th>
									<th>Teléfono</th>
									<th>Email</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($postulantes as $key => $postulante): ?>
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
												<td></td>
												<td></td>
											</tr>
										</table>
									</td>
								</tr>

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
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
