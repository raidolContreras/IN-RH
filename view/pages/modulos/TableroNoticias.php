<div class="row">
	<div class="col-12">
		<div class="float-left m-0">
			<div class="row mt-2 ml-0">
				<div class="col-1 mr-4">
					<img src="view/fotos/thumbnails/Oscar Contrerah.png" size="large"  alt="User Avatar" class="rounded-circle user-avatar-lg2">
				</div>
				<div class="col">
					<p class="titulo-tablero m-0">Oscar contreras</p>
					<p class="subtitulo-tablero m-0">hace 1 día</p>
				</div>
			</div>
		</div>
		<div class="float-right m-0">
			<p class="titulo-sup m-0">
				<a href="Noticias" class="btn-outline-light boton" >
					<i class="fas fa-edit"></i>
				</a>
			</p>
		</div>
	</div>
	<div class="col-12 pl-4 pr-4 pt-2 pb-4">
		<div class="card-into-card rounded">
			
		</div>
	</div>
</div>


<script>
	function calcularTiempoTranscurrido() {
		var fechaPublicacion = new Date("2023-05-11 15:25:00");
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

		document.getElementById("tiempo-noticia").innerHTML = mensaje;
	}

	// Actualizar el tiempo transcurrido cada segundo (1000 ms)
	setInterval(calcularTiempoTranscurrido, 1000);
</script>