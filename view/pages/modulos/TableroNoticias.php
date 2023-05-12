<?php $noticias = ControladorFormularios::ctrVerNoticias(null, null); ?>
<?php if (isset($noticias)): ?>

	<div class="col-12 mt-4 mb-4">
		<div id="carouselExampleIndicators1" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<?php foreach ($noticias as $key => $noticia): ?>
				<?php if ($key == 0): ?>
				<div class="carousel-item active">
				<?php else: ?>
				<div class="carousel-item">
				<?php endif ?>
					<?php 
					$empleado = ControladorFormularios::ctrVerEmpleados("idEmpleados", $noticia['Empleados_idEmpleados']);
					$fotoEmpleado = ControladorFormularios::ctrVerFotos("Empleados_idEmpleados", $empleado['idEmpleados']);
					?>
					<div class="row">
						<div class="col-12">
							<div class="float-left m-0">
								<div class="row mt-2 ml-0">
									<div class="col-1 mr-4">
										<?php if (isset($fotoEmpleado['namePhoto'])): ?>
											<img src="view/fotos/thumbnails/<?php echo $fotoEmpleado['namePhoto'] ?>"
										<?php else: ?>
											<?php if ($empleadoMes['genero']==1): ?>
												<img src="assets/images/Ejecutivo.webp"
											<?php else: ?>
												<img src="assets/images/Ejecutiva.webp"
											<?php endif ?>
										<?php endif ?>
										size="large"  alt="User Avatar" class="rounded-circle user-avatar-lg2">
									</div>
									<div class="col">
										<p class="titulo-tablero m-0"><?php echo $empleado['name']." ".$empleado['lastname'] ?></p>
										<p class="subtitulo-tablero m-0" id="tiempo-noticia<?php echo $noticia['idNoticias'] ?>"></p>
									</div>

									<div class="float-right">
										<p class="titulo-sup m-0">
											<a href="Noticias" class="btn-outline-light boton" >
												<i class="fas fa-trash"></i>
											</a>
										</p>
									</div>
								</div>
							</div>
						</div>
						<?php if ($noticia['foto_noticia'] == 1): ?>
								<div class="col-8 pl-4 pt-2 pb-4">
									<div class="card-into-card rounded pt-5 pb-5">
										<div class="pt-5 pb-5">
											<?php echo $noticia['mensaje']; ?>
										</div>
									</div>
								</div>
								<div class="col-4 pr-4 pt-2 pb-4">
									<div class="card-into-card rounded">
										<img src="view/noticias/thumbnails/<?php echo $noticia['name_foto']; ?>" height="280">
									</div>
								</div>
						<?php else: ?>
							<div class="col-12 pl-4 pr-4 pt-2 pb-4">
								<div class="card-into-card rounded">
									<?php echo $noticia['mensaje']; ?>
								</div>
							</div>
						<?php endif ?>

					</div>
					</div>

					<?php endforeach ?>
				</div>
				<a class="carousel-control-prev" href="#carouselExampleIndicators1" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Anterior</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleIndicators1" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Siguiente</span>
				</a>
			</div>
		</div>

<?php foreach ($noticias as $key => $noticia): ?>
	<script>
		function calcularTiempo() {
			var fechaPublicacion = new Date("<?php echo $noticia['fecha_inicio'] ?>");
			var tiempoActual = new Date();

			var diferencia = Math.floor((tiempoActual - fechaPublicacion) / 1000); // Diferencia en segundos

			var minutosTranscurridos = Math.floor(diferencia / 60);
			var horasTranscurridas = Math.floor(diferencia / 3600);
			var diasTranscurridos = Math.floor(diferencia / 86400);

			var mensaje;

			if (minutosTranscurridos < 1) {
				mensaje = "Hace un momento";
			} else if (minutosTranscurridos == 1) {
				mensaje = "Hace " + minutosTranscurridos + " minuto";
			}  else if (minutosTranscurridos > 1 && minutosTranscurridos <= 59) {
				mensaje = "Hace " + minutosTranscurridos + " minutos";
			} else if (horasTranscurridas == 1) {
				mensaje = "Hace " + horasTranscurridas + " hora";
			} else if (horasTranscurridas >= 2 && horasTranscurridas <= 23) {
				mensaje = "Hace " + horasTranscurridas + " horas";
			} else {
				mensaje = "Hace " + diasTranscurridos + " días";
			}

			document.getElementById("tiempo-noticia<?php echo $noticia['idNoticias'] ?>").innerHTML = mensaje;
			}

		// Actualizar el tiempo transcurrido cada segundo (1000 ms)
		setInterval(calcularTiempo, 1000);
	</script>
<?php endforeach ?>

<?php endif ?>