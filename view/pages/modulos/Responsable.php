<?php 
$equipo_de_trabajo = ControladorEmpleados::ctrEquipoDeTrabajo(null);
$pertenece = 0;
?>
<p class="titulo-tablero titulo">MI GRUPO DE TRABAJO</p>
<hr class="titulo">
<div class="row">
	<div class="col-12 mt-2">
		<?php if ($equipo_de_trabajo[0]['jefeDepa'] == $_SESSION['idEmpleado'] && $equipo_de_trabajo[0]['idPertenencia'] != 0): $pertenece = $equipo_de_trabajo[0]['depto'] ?>
			<p class="subtitulo-tablero titulo">Jefe inmediato</p>
			<div class="row">
				<div class="col-4 pl-0">
					<a class="btn btn-link float-left">
						<?php if (isset($equipo_de_trabajo[0]['namePhoto'])): ?>
							<img src="view/fotos/thumbnails/<?php echo $equipo_de_trabajo[0]['fotoPertenencia'] ?>"
						<?php else: ?>
							<?php if ($equipo_de_trabajo[0]['genero']==1): ?>
								<img src="assets/images/Ejecutivo.webp"
							<?php else: ?>
								<img src="assets/images/Ejecutiva.webp"
							<?php endif ?>
						<?php endif ?>

						size="large"  alt="User Avatar" class="rounded-circle user-avatar-xl2">
					</a>
				</div>
				<div class="col-8 align-items-center" style="justify-content: flex-start;">
					<div class="row">
						<div class="col-12">
						<p class="subtitulo-tablero titulo"><?php echo mb_strtoupper($equipo_de_trabajo[0]['NombrePertenencia']) ?></p>
						</div>
						<div class="col-12">
						<p class="subtitulo-tablero titulo"><?php echo mb_strtoupper($equipo_de_trabajo[0]['Pertenencia']) ?></p>
						</div>
					</div>
				</div>
			</div>
		<?php endif ?>
		<?php foreach ($equipo_de_trabajo as $etrabajo): ?>
			<?php if ($etrabajo['idEmpleados'] == $etrabajo['jefeDepa']): ?>
				<p class="subtitulo-tablero titulo">Jefe del departamento</p>
				<div class="row">
					<div class="col-4 pl-0">
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
				<div class="col-8 align-items-center" style="justify-content: flex-start;">
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
		<div class="row">
			<div class="col-12 float-left"><p class="titulo-sup mb-0" style="flex-direction: row !important;">Miembros del equipo</p></div>
			
			<?php foreach ($equipo_de_trabajo as $etrabajo): ?>
				<?php if ($etrabajo['idEmpleados'] != $etrabajo['jefeDepa']): ?>
						<div class="col-3">
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
						<div class="col-9" style="display:flex; align-items: center;">
							<div class="row">
								<div class="col-12">
								<p class="titulo-sup mb-0" style="flex-direction: row !important;"><?php echo mb_strtoupper($etrabajo['Nombre']) ?></p>
								</div>
								<div class="col-12">
								<p class="titulo-sup mb-0" style="flex-direction: row !important;"><?php echo mb_strtoupper($etrabajo['Puesto']) ?></p>
								</div>
							</div>
						</div>
				<?php endif ?>
			<?php endforeach ?>
			
		</div>
		<?php if ($pertenece != 0): 
			$pertenencias = ControladorEmpleados::ctrEquipoDeTrabajo($pertenece);
			?>
			<?php if (!empty($pertenencias)): ?>
				<hr>
			<?php endif ?>
		<?php foreach ($pertenencias as $pertenencia): ?>
			<?php if ($pertenencia['idEmpleados'] == $pertenencia['jefeDepa']): ?>
				<div class="row">
					<div class="col-3">
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
					<div class="col-9" style="display:flex; align-items: center;">
						<div class="row">
							<div class="col-12">
							<p class="titulo-sup mb-0" style="flex-direction: row !important;"><?php echo mb_strtoupper($pertenencia['Nombre']) ?></p>
							</div>
							<div class="col-12">
							<p class="titulo-sup mb-0" style="flex-direction: row !important;"><?php echo mb_strtoupper($pertenencia['Puesto']) ?></p>
							</div>
						</div>
					</div>
				</div>
			<?php endif ?>
		<?php endforeach ?>
		<?php endif ?>

	</div>
</div>