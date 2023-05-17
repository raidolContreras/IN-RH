<?php 
$empleados = ControladorEmpleados::ctrFechaNacimiento(null, null);  
?>
<div class="row">
	<div class="ml-4 pb-0">
		<div class="">
			<p class="titulo-sup m-0">Futuros cumpleaños</p>

				<?php foreach ($empleados as $key => $empleado): ?>
					<div class="widget-container pb-3">
							<div class="col-2">
						<?php if (isset($fotoEmpleado['namePhoto'])): ?>
							<img src="view/fotos/thumbnails/<?php echo $fotoEmpleado['namePhoto'] ?>"
						<?php else: ?>
							<?php if ($empleado['genero']==1): ?>
								<img src="assets/images/Ejecutivo.webp"
							<?php else: ?>
								<img src="assets/images/Ejecutiva.webp"
							<?php endif ?>
						<?php endif ?>

						size="large" alt="User Avatar" class="rounded-circle user-avatar-md2 mt-2">
							</div>
							<div class="col-10 pt-2 ml-2">
								<p class="titulo-sup mb-0"><?php echo $empleado['name']." ".$empleado['lastname'] ?></p>
								<p class="subtitulo-sup mt-0"><?php echo date("d-M", strtotime($empleado['fNac'])) ?></p>
							</div>
					</div>

				<?php endforeach ?>
		</div>
	</div>
</div>