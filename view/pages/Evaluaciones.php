<?php
$Evaluaciones = ControladorFormularios::ctrVerEvaluaciones(null, null);
?>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="card mx-5 menu-ajustes">
			<div class="row card-header" style="align-items: center;">
				<div class="encabezado">
					Evaluaciones
				</div>
				<div class="float-right">
					<a href="crearEvaluacion" class="btb btn-success p-2 rounded float-right">
						Crear evaluación
					</a>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table examenes">
						<thead>
							<tr>
								<th>#</th>
								<th>Nombre del examen</th>
								<th>Rango de fechas</th>
								<th>Tiempo límite</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1; foreach ($Evaluaciones as $Evaluacion):
								$tiempo = ControladorFormularios::ctrFormatearTiempo($Evaluacion['tiempo_limite']);
							?>
								<tr>
									<td>
										<?php if (strlen($i)==1) {
											echo '0'.$i;
										}else{
											echo $i;
										}$i++;?>
									</td>
									<td><?php echo $Evaluacion['titulo']; ?></td>
									<td>
										<?php
										if ($Evaluacion['fecha_inicio'] == null) {
											if ($Evaluacion['fecha_fin'] == null) {
												echo 'Siempre Abierto';
											}else{
												$fecha_fin = ControladorFormularios::ctrFormatearMes($Evaluacion['fecha_fin']);
												echo 'Hasta el '.$fecha_fin;
											}
										}else{

											$fecha_inicio = ControladorFormularios::ctrFormatearMes($Evaluacion['fecha_inicio']);

											echo $fecha_inicio;

											if ($Evaluacion['fecha_fin'] != null) {
												$fecha_fin = ControladorFormularios::ctrFormatearMes($Evaluacion['fecha_fin']);
												echo ' al '.$fecha_fin;
											}
										}
										?>
									</td>
									<td><?php echo $tiempo; ?></td>
									<td></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>