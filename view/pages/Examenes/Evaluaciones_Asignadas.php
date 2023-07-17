<?php
$EvaluacionesAsignadas = ControladorFormularios::ctrVerEvaluacionesEmpleados('idEmpleado', $_SESSION['idEmpleado']);
?>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="row">
			<?php 
			foreach ($EvaluacionesAsignadas as $EvaluacionAsignada):
				$Evaluaciones = ControladorFormularios::ctrVerEvaluaciones('idExamen', $EvaluacionAsignada['idExamen']);
			?>
			<div class="col-xl-4">
				<div class="card">
					<div class="card-header">
						<?php echo mb_strtoupper($Evaluaciones['titulo']) ?>
					</div>
					<div class="card-body">
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
					</div>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</div>