<?php
if (isset($_GET['evaluacion'])) :
	$Evaluaciones = ControladorFormularios::ctrVerEvaluaciones('idExamen', $_GET['evaluacion']);
	$empleados = ControladorFormularios::ctrExamenesEmpleados($_GET['evaluacion']);
	$preguntas = ControladorFormularios::ctrExamenesPreguntas($_GET['evaluacion']);
	$i = 0;
	foreach ($preguntas as $pregunta) {
		$i++;
	}

$escalaFile = file_get_contents('view/pages/json/escalas.json');
$escala = json_decode($escalaFile, true);
?>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="card mx-5 menu-ajustes">
			<div class="row card-header" style="align-items: center;">
				<div class="encabezado">
					<?php echo $Evaluaciones['titulo'] ?>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered examenes_empleados" style="width:100%; height:100%">
						<thead>
							<tr>
								<th rowspan="2">#</th>
								<th rowspan="2">Empleado</th>
								<th colspan="<?php echo $i; ?>" style="text-align:center">Preguntas</th>
							</tr>
							<tr>
								<?php foreach ($preguntas as $pregunta): ?>
								<th style="text-align: center !important;">
									<div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"></div>
									<?php echo $pregunta['pregunta'] ?>
								</th>
								<?php endforeach ?>
							</tr>
						</thead>
						<tbody>
							<?php 
								$i=1; 
								foreach ($empleados as $empleado){

									echo "<tr>
											<td>";

									if (strlen($i)==1) {
										$num = '0'.$i;
									}else{
										$num = $i;
									}$i++;

									echo "$num</td>
										<td>".mb_strtoupper($empleado['nombre'])."</td>";

									foreach ($preguntas as $pregunta){
										$respuesta = ModeloFormularios::mdlEmpleadoPreguntas($pregunta['idPregunta'], $empleado['idEmpleados']);
										$respuestasExamen = ControladorFormularios::ctrVerRespuestasExamen('idPregunta', $pregunta['idPregunta']);

										if (!empty($respuesta)) {
											$resultado = $respuesta['respuesta'];
											if ($pregunta['tipo_pregunta'] == 'escala') {

												foreach ($respuestasExamen as $respuestaExamen){
													if ($respuestaExamen['respuesta'] == 'escala') {
														$opciones = $escala[$respuestaExamen['valor']];
														foreach ($opciones as $key => $opcion) {
															if ($key == $resultado) {
																$resultado = $opcion;
																echo "<td style='text-align: center !important;'>$resultado</td>";
															}
														}
													}else{
														$opciones = $escala[$respuestaExamen['valor']];
														foreach ($opciones as $key => $opcion) {
															if ($key == $resultado) {
																if ($respuestaExamen['valor'] == $key) {
																	$resultado = $opcion;
																	echo "<td style='background-color: #3CC7B6; color: #FEFEFE; text-align: center !important;'>$resultado</td>";
																}else{
																	$resultado = $opcion;
																	echo "<td style='background-color: #EC3927; color: #FEFEFE; text-align: center !important;'>$resultado</td>";
																}
															}
														}
													}
												}

											}elseif ($pregunta['tipo_pregunta'] == 'abierta') {
												echo "<td style='text-align: center !important;'>$resultado</td>";
											}else{
												foreach ($respuestasExamen as $respuestaExamen){
													if ($respuestaExamen['valor'] == 1 && $respuestaExamen['respuesta'] == $resultado) {
														echo "<td style='background-color: #3CC7B6; color: #FEFEFE; text-align: center !important;'>$resultado</td>";
													}elseif ($respuestaExamen['valor'] == 0 && $respuestaExamen['respuesta'] == $resultado) {
														echo "<td style='background-color: #EC3927; color: #FEFEFE; text-align: center !important;'>$resultado</td>";
													}
												}
											}
										}else{
											echo "<td style='background-color: #BABABA; color: #020202; text-align: center !important;'>NA</td>";
										}
									}

									echo "</tr>";
								} 
							?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif ?>