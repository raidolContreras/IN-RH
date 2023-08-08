<?php $gastos = ControladorFormularios::ctrVerGastos(null, null); 
	$divisas = ControladorFormularios::ctrVerDivisa(null, null);
	$categorias = ControladorFormularios::ctrVerCategoria(null, null);
	$folios = ControladorFormularios::ctrVerFolioGastos(null, null);
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />
<script src="assets/vendor/jsPDF/node_modules/jspdf/dist/jspdf.umd.min.js"></script>

<style>
	.dropzone {
		border: 2px dashed #ccc;
		padding: 60px;
	}

	.dropzone .dz-message {
		text-align: center;
		font-size: 1.5em;
		color: #999;
	}

	/* CSS */
/* Estilo para el campo de texto de la nueva opción */
#otraOpcion {
  display: block;
}

</style>
<div class="container-fluid dashboard-content">
	<div class="row">
		<div class="container col-xl-9 col-md-12 order-xl-1 order-md-2">
			<div class="card">
				<div class="card-header">
					Resumen de gastos
					<button type="button" class="btn btn-outline-primary rounded float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Agregar gastos</button>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="example" class="table gastos">
							<thead>
								<tr>
									<th width="20">Motivo</th>
									<th width="150">Fecha del documento</th>
									<th>Proveedor</th>
									<th>Importe</th>
									<th>Categoría</th>
									<th>Cantidad</th>
									<th>Moneda</th>
									<th width="50">Estado</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($gastos as $gasto):
									$divisa = ControladorFormularios::ctrVerDivisa('idDivisa', $gasto['divisa']);
									$categoria = ControladorFormularios::ctrVerCategoria('idCategoria', $gasto['categoria']);
									$folio = ControladorFormularios::ctrVerFolioGastos('idFolio_Gasto', $gasto['folio']);
								?>
								<tr>
									<td><button class="btn btn-in-consulting" data-toggle="modal" data-target="#gasto<?php echo $gasto['idGastos'] ?>"><span><?php echo $folio['nameFolio'] ?></span></button></td>
									<td><?php echo date('d/m/Y', strtotime($gasto['fechaDocumento'])) ?></td>
									<td><?php echo $gasto['nameVendedor'] ?></td>
									<td><?php echo ControladorFormularios::formatearNumero($gasto['importeTotal'], $divisa['divisa']) ?></td>
									<td><?php echo $categoria['nameCategoria'] ?></td>
									<td><?php echo $gasto['importeTotal'] ?></td>
									<td><?php echo $divisa['divisa'] ?></td>
									<?php 
										switch ($gasto['status']) {
											case 0:
												echo '<td><span class="badge badge-warning-dot"><span class="badge-dot badge-warning"></span>Pendiente</span></td>';
												break;
											
											case 1:
												echo '<td><span class="badge badge-success-dot"><span class="badge-dot badge-success"></span>Aprobado</span></td>';
												break;
											
											case 2:
												echo '<td><span class="badge badge-danger-dot"><span class="badge-dot badge-danger"></span>Rechazado</span></td>';
												break;
											
											case 3:
												echo '<td><span class="badge badge-info-dot"><span class="badge-dot badge-info"></span>Pagado</span></td>';
												break;
											
											default:
												echo '<td><span class="badge badge-danger">Error</span></td>';
												break;
										}
									?>
									<td>
										<?php if ($gasto['status'] == 0 && $gasto['Empleados_idEmpleados'] == $_SESSION['idEmpleado']): ?>
											<div class="btn-group dropright">
												<button class="btn btn-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i class="fas fa-ellipsis-v"></i>
												</button>
												<div class="dropdown-menu mr-0" aria-labelledby="dropdownMenuButton">
													<button
														class="dropdown-item btn btn-link float-left"
														data-toggle="modal"
														data-target="#delGasto"
														data-del="<?php echo $gasto['idGastos'] ?>"
														style="font-size: 13px;">
														<i class="fas fa-trash"></i> Eliminar
													</button>
												</div>
											</div>
										<?php endif ?>
									</td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class=" col-xl-3 col-md-12 order-xl-2 order-md-1">
			<div class="card">
				<div class="card-header">Motivos</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<td>Motivo</td>
									<td></td>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($folios as $folio): ?>
							<?php if ($folio['Empleados_idEmpleados'] == $_SESSION['idEmpleado']): ?>
								<tr>
									<td><?php echo $folio['nameFolio']; ?></td>
									<?php if ($folio['status'] == 1): ?>
									<td><button class="btn btn-warning rounded gastos" onclick="motivo(<?php echo $folio['idFolio_Gasto']; ?>)">Finalizar motivo</button></td>
									<?php else: ?>
									<td><button class="btn btn-link" disabled>Finalizado</button></td>
									<?php endif ?>
								</tr>
								<?php endif ?>
							<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once "view/pages/Gastos/ActualizarGastos.php"; ?>
<?php require_once "view/pages/Gastos/AddGastos.php"; ?>
<?php require_once "view/pages/Gastos/DelGastos.php"; ?>

<!-- Modal de confirmación de eliminación -->
<div class="modal fade" id="modalEliminarDocumento" tabindex="-1" role="dialog" aria-labelledby="modalEliminarDocumentoLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalEliminarDocumentoLabel">Eliminar documento</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>¿Estás seguro de que deseas eliminar este documento?</p>
			</div>
			<form id="eliminarDocumento-form">
				<input type="hidden" id="eliminarDocumento" name="eliminarDocumento">
				<input type="hidden" id="eliminarDocumentoGasto" name="eliminarDocumentoGasto">
				<input type="hidden" id="eliminarNameDocumento" name="eliminarNameDocumento">
			</form>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-danger" id="eliminarDocumento-btn">Eliminar</button>
			</div>
		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script src="assets/libs/js/expPDF.js"></script>
<script src="assets/libs/js/gastos.js"></script>