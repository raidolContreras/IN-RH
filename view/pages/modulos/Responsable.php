<?php 
$equipo_de_trabajo = ControladorEmpleados::ctrEquipoDeTrabajo(null);
$pertenece = 0;
?>
<p class="titulo-tablero titulo">Mi grupo de trabajo</p>
<hr class="titulo">
<div class="row">
	<div class="col-12 mt-2">
		<?php foreach ($equipo_de_trabajo as $etrabajo): ?>
			<?php if ($etrabajo['jefeDepa'] == $_SESSION['idEmpleado']): $pertenece = $etrabajo['depto'] ?>
				<p class="subtitulo-tablero titulo">Jefe inmediato</p>
				<div class="row">
					<div class="col-4">
						<a class="btn btn-link float-left">
							<?php if (isset($etrabajo['namePhoto'])): ?>
								<img src="view/fotos/thumbnails/<?php echo $etrabajo['fotoPertenencia'] ?>"
							<?php else: ?>
								<?php if ($etrabajo['genero']==1): ?>
									<img src="assets/images/Ejecutivo.webp"
								<?php else: ?>
									<img src="assets/images/Ejecutiva.webp"
								<?php endif ?>
							<?php endif ?>

							size="large"  alt="User Avatar" class="rounded-circle user-avatar-xl2">
						</a>
					</div>
					<div class="col-8 align-items-center">
						<div class="row">
							<div class="col-12">
							<p class="subtitulo-tablero titulo"><?php echo mb_strtoupper($etrabajo['NombrePertenencia']) ?></p>
							</div>
							<div class="col-12">
							<p class="subtitulo-tablero titulo"><?php echo mb_strtoupper($etrabajo['Pertenencia']) ?></p>
							</div>
						</div>
					</div>
				</div>
			<?php endif ?>
			<?php if ($etrabajo['idEmpleados'] == $etrabajo['jefeDepa']): ?>
				<p class="subtitulo-tablero titulo">Jefe del departamento</p>
				<div class="row">
					<div class="col-4">
						<a class="btn btn-link float-left">
							<?php if (isset($etrabajo['namePhoto'])): ?>
								<img src="view/fotos/thumbnails/<?php echo $etrabajo['namePhoto'] ?>"
							<?php else: ?>
								<?php if ($etrabajo['genero']==1): ?>
									<img src="assets/images/Ejecutivo.webp"
								<?php else: ?>
									<img src="assets/images/Ejecutiva.webp"
								<?php endif ?>
							<?php endif ?>

							size="large"  alt="User Avatar" class="rounded-circle user-avatar-xl2">
						</a>
					</div>
					<div class="col-8 align-items-center">
						<div class="row">
							<div class="col-12">
							<p class="subtitulo-tablero titulo"><?php echo mb_strtoupper($etrabajo['Nombre']) ?></p>
							</div>
							<div class="col-12">
							<p class="subtitulo-tablero titulo"><?php echo mb_strtoupper($etrabajo['Puesto']) ?></p>
							</div>
						</div>
					</div>
				</div>
			<?php endif ?>
		<?php endforeach ?>
		<p class="titulo-sup mb-0">Miembros del equipo</p>
		<?php foreach ($equipo_de_trabajo as $etrabajo): ?>
			<?php if ($etrabajo['idEmpleados'] != $etrabajo['jefeDepa']): ?>
				<div class="row">
					<div class="col-3 ml-2">
						<a class="btn btn-link float-left">
							<?php if (isset($etrabajo['namePhoto'])): ?>
								<img src="view/fotos/thumbnails/<?php echo $etrabajo['namePhoto'] ?>"
							<?php else: ?>
								<?php if ($etrabajo['genero']==1): ?>
									<img src="assets/images/Ejecutivo.webp"
								<?php else: ?>
									<img src="assets/images/Ejecutiva.webp"
								<?php endif ?>
							<?php endif ?>

							size="large"  alt="User Avatar" class="rounded-circle user-avatar-lg2">
						</a>
					</div>
					<div class="col-8 align-items-center">
						<div class="row">
							<div class="col-12">
							<p class="titulo-sup mb-0"><?php echo mb_strtoupper($etrabajo['Nombre']) ?></p>
							</div>
							<div class="col-12">
							<p class="titulo-sup mb-0"><?php echo mb_strtoupper($etrabajo['Puesto']) ?></p>
							</div>
						</div>
					</div>
				</div>
			<?php endif ?>
		<?php endforeach ?>
		<?php if ($pertenece != 0): 
			$pertenencias = ControladorEmpleados::ctrEquipoDeTrabajo($pertenece);
			?>
			
		<?php foreach ($pertenencias as $pertenencia): ?>
			<?php if ($pertenencia['idEmpleados'] == $pertenencia['jefeDepa']): ?>
				<div class="row">
					<div class="col-3 ml-2">
						<a class="btn btn-link float-left">
							<?php if (isset($pertenencia['namePhoto'])): ?>
								<img src="view/fotos/thumbnails/<?php echo $pertenencia['namePhoto'] ?>"
							<?php else: ?>
								<?php if ($pertenencia['genero']==1): ?>
									<img src="assets/images/Ejecutivo.webp"
								<?php else: ?>
									<img src="assets/images/Ejecutiva.webp"
								<?php endif ?>
							<?php endif ?>

							size="large"  alt="User Avatar" class="rounded-circle user-avatar-lg2">
						</a>
					</div>
					<div class="col-8 align-items-center">
						<div class="row">
							<div class="col-12">
							<p class="titulo-sup mb-0"><?php echo mb_strtoupper($pertenencia['Nombre']) ?></p>
							</div>
							<div class="col-12">
							<p class="titulo-sup mb-0"><?php echo mb_strtoupper($pertenencia['Puesto']) ?></p>
							</div>
						</div>
					</div>
				</div>
			<?php endif ?>
		<?php endforeach ?>
		<?php endif ?>

	</div>
</div>