<?php 
require_once "../../controller/formularios.controlador.php";
require_once "../../model/formularios.modelo.php"; ?>

<?php $documentos = ControladorFormularios::ctrVerDocumentos("Empleados_idEmpleados", $_GET['idEmpleados']); ?>
<?php foreach ($documentos as $key => $value): ?>
	<?php $url = "view/pdfs/".$value['Empleados_idEmpleados']."/".$value['nameDoc'].".pdf"; ?>

	<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
		<div class="card card-figure">
			<figure class="figure">
				<div class="figure-attachment">
					<span class="fa-stack fa-lg">
						<i class="fa fa-square fa-stack-2x text-primary"></i>
						<i class="fa fa-file-pdf fa-stack-1x fa-inverse"></i>
					</span>
				</div>
			<figcaption class="figure-caption">
				<ul class="list-inline d-flex text-muted mb-0">
					<li class="list-inline-item text-truncate mr-auto">
						<?php echo $value['nameDoc'] ?>.pdf
					</li>
						<button type="button" 
						class="btn btn-outline-danger rounded" 
						data-toggle="modal" 
						data-target="#Modal<?php echo $value['Empleados_idEmpleados'] ?>">
						<span>
							<i class="far fa-file-pdf"></i>
						</span>
						</button>
					</ul>
				</figcaption>
			</figure>
		</div>
	</div>
	<div class="modal fade" id="Modal<?php echo $value['Empleados_idEmpleados'] ?>">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<!-- Modal body -->
				<div class="modal-body card">
					<div class="card-body justify-content-center">
						<embed src="<?php echo $url; ?>" type="application/pdf" height="690px" width="690px"></embed>
					</div>
				</div>

			</div>
		</div>
	</div>
<?php endforeach ?>