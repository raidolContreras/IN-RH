<?php $postulante = ControladorFormularios::ctrVerPostulantes("idPostulantes", $_GET['postulante']) ?>

<div class="container-fluid dashboard-content ">
	<div class="card">
		<div class="row">
			<div class='col p-3 ml-3'>
				
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
			<div class="col p-3 ml-3">
				<h2 class="hprofile">Postulante</h2>
				<hr>
				<div class="row">
					<div class="col">
						<label for="name">
							Nombre:
						</label>
						<p id="name"><?php echo $postulante['namePostulante']." ".$postulante['lastnamePostulante'] ?></p>
					</div>
					<div class="col">
						<label for="phone">
							Teléfono:
						</label>
						<p id="phone"><?php echo $postulante['phonePostulante'] ?></p>
					</div>
					<div class="col">
						<label for="email">
							Correo electronico:
						</label>
						<p id="email"><?php echo $postulante['emailPostulante'] ?></p>
					</div>
				</div>
				
			</div>
				<div class="float-right p-3 mr-4"><a class="btn btn-outline-primary rounded" href="Vacantes-Postulantes&Postulantes=<?php echo $postulante['Vacantes_idVacantes'] ?>">Regresar</a></div>
		</div>
	</div>
</div>