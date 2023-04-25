<?php 
require_once "../../controller/formularios.controlador.php";
require_once "../../model/formularios.modelo.php"; ?>

<?php $documentos = ControladorFormularios::ctrVerDocumentos("Empleados_idEmpleados", $_GET['idEmpleados']); ?>
<?php foreach ($documentos as $key => $value): ?>
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
						<span><i class="fas fa-file-pdf"></i></span> <?php echo $value['nameDoc'] ?>.pdf </li>
						<li class="list-inline-item">
							<a download href="view/pdfs/<?php echo $value['Empleados_idEmpleados']."/".$value['nameDoc']; ?>.pdf"><i class="fas fa-download "></i></a>
						</li>
					</ul>
				</figcaption>
			</figure>
		</div>
	</div>
<?php endforeach ?>