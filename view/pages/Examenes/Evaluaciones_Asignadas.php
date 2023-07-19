<?php
$EvaluacionesAsignadas = ControladorFormularios::ctrVerEvaluacionesEmpleados('idEmpleado', $_SESSION['idEmpleado']);

date_default_timezone_set("America/Mexico_City");
$fecha_actual = date("Y-m-d H:i:s");
?>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="row">
			<?php 
			foreach ($EvaluacionesAsignadas as $EvaluacionAsignada):
				$Evaluaciones = ControladorFormularios::ctrVerEvaluaciones('idExamen', $EvaluacionAsignada['idExamen']);

				$fechaI = ControladorFormularios::ctrFormatearMes($Evaluaciones['fecha_inicio']);
				if ($Evaluaciones['fecha_fin'] != null) {
					$fechaF = ControladorFormularios::ctrFormatearMes($Evaluaciones['fecha_fin']);
				}else{

					$inicio = new DateTime(date('Y-m-d H:i:s'));

				    $inicio->add(new DateInterval('PT' . 50000 . 'M'));
				    // Obtener la nueva fecha de fin en formato Y-m-d H:i:s
				    $Evaluaciones['fecha_fin'] = $inicio->format('Y-m-d H:i:s');
				    $fechaF = ControladorFormularios::ctrFormatearMes($inicio->format('Y-m-d H:i:s'));
				}
			?>
			<div class="col-xl-4">
				<div class="card">
					<div class="card-header">
						<?php echo mb_strtoupper($Evaluaciones['titulo']) ?>
					</div>
					<div class="card-body">
						<?php if ($Evaluaciones['fecha_inicio'] > $fecha_actual): ?>
							<span>Esta evaluación estara disponible hasta: <strong><?php echo $fechaF ?></strong></span>
						<?php elseif ($Evaluaciones['fecha_fin'] < $fecha_actual): ?>
							<span>Esta evaluación cerro el día: <strong><?php echo date('d/m/Y', strtotime($Evaluaciones['fecha_inicio'])) ?></strong></span>
						<?php else: ?>
							<?php if ($EvaluacionAsignada['fecha_inicio'] == null): ?>
								<a href="Examen&evaluacion=<?php echo $Evaluaciones['idExamen'] ?>" class="float-right">
									Iniciar examen <i class="fas fa-arrow-right"></i>
								</a>
							<?php elseif ($EvaluacionAsignada['fecha_fin'] == null): ?>
								<a href="Examen&evaluacion=<?php echo $Evaluaciones['idExamen'] ?>&inicio=<?php echo $_SESSION['idEmpleado'] ?>" class="float-right">
									Continuar examen <i class="fas fa-arrow-right"></i>
								</a>
							<?php else: ?>
								<a href="Examen&verExamen=<?php echo $Evaluaciones['idExamen'] ?>" class="float-right">
									revisar examen <i class="fas fa-arrow-right"></i>
								</a>
							<?php endif ?>
						<?php endif ?>
					</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</div>