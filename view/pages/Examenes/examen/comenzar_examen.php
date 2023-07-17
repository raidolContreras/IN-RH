
				<div class="col mx-5">
					<div class="card">
						<div class="card-header">
							<p class="titulo-tablero"><?php echo mb_strtoupper($Evaluaciones['titulo']) ?></p>
						</div>
						<div class="card-body mx-5">
							<?php echo $Evaluaciones['Descripcion'] ?>
							<center class="mt-5">
								<p><?php echo $intentos_maximos; ?></p>

								<p>Este examen no estará disponible hasta el <?php echo $fecha_inicio ?></p>

								<p><?php echo $fecha_fin ?></p>

								<p>Límite de tiempo: <?php echo $tiempo; ?></p>
							</center>
						</div>
						<div class="card-footer">
						<?php if ($Evaluaciones['tiempo_limite'] != null): ?>
							<p class="my-3">Su examen tendrá un límite de tiempo de <?php echo $tiempo; ?>. Cuando Usted empieza su intento, el contador comenzará a contar y no puede ser pausado. Usted debe terminar su intento antes de que expire. ¿Está Usted seguro de querer comenzar ahora?</p>
						<?php endif ?>
							<div class="row" style="justify-content: flex-end">
								<div class="col-3">
									<button id="iniciar-Examen-btn" class="btn btn-outline-primary rounded btn-block">
										Iniciar intento
									</button>
								</div>
								<div class="col-3">
									<a href="Evaluaciones_Asignadas" class="btn btn-outline-danger rounded btn-block">
										Cancelar
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<script>
					$(document).ready(function() {
					$("#iniciar-Examen-btn").click(function() {
						const examen = <?php echo $examen ?>;
						$.ajax({
							url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
							type: "POST",
							data: {iniciar_examen: examen},
							success: function(response) {
								if (response === 'ok') {
									window.location.href='Examen&evaluacion='+examen+'&inicio='+<?php echo $_SESSION['idEmpleado'] ?>;
								}else{
									console.log('Error');
								}
							}
						});
					});
				});
			</script>