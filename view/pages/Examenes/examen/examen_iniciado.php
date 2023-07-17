<div class="col-12">
	<div class="row">
		<div class="col-xl-9 col-md-8 col-12">
			<div class="card">
			</div>
		</div>
		<div class="col-xl-3 col-md-4 col-12">
			<div class="card">
			<div class="card-header mx-1" id="timer" style="font-size:12px"></div>
			</div>
		</div>
	</div>
</div>
<?php if ($tiempo == 'Sin limite de tiempo'): ?>
	<script>
		document.getElementById("timer").innerHTML = "Sin limite de tiempo";
	</script>
<?php else: ?>
	<script>
		// Establecer las fechas de inicio y fin
		var fechaInicio = new Date("<?php echo $fecha_inicio_examen ?>");
		var fechaFin = new Date(fechaInicio.getTime() + <?php echo $Evaluaciones['tiempo_limite']; ?> * 60000); // Tiempo límite en minutos en milisegundos

		// Función para mostrar el contador
		function mostrarContador() {
		  // Obtener la fecha y hora actual
		  var fechaActual = new Date();
		  
		  // Calcular el tiempo restante en milisegundos
		  var tiempoRestante = fechaFin - fechaActual;
		  
		  // Verificar si se ha alcanzado la fecha de fin
		  if (tiempoRestante <= 0) {
		    // Se ha alcanzado la fecha de fin, realizar la petición AJAX
		    realizarPeticionAJAX();
		  } else {
		    // Convertir el tiempo restante a minutos y segundos
		    var minutos = Math.floor(tiempoRestante / 60000);
		    var segundos = Math.floor((tiempoRestante % 60000) / 1000);
		    
		    // Mostrar el contador en el elemento HTML
		    document.getElementById("timer").innerHTML = "Tiempo restante: " + minutos + " min " + segundos + " seg";
		    
		    // Actualizar el contador cada segundo
		    setTimeout(mostrarContador, 1000);
		  }
		}

		// Función para realizar la petición AJAX
		function realizarPeticionAJAX() {
		  // Aquí puedes realizar la petición AJAX utilizando la librería de tu elección
		  // Por ejemplo, con jQuery:
		  $.ajax({
		    url: "tupeticion.php",
		    type: "POST",
		    data: { tiempoTerminado: true },
		    success: function(response) {
		      // Manejar la respuesta de la petición AJAX
		    },
		    error: function(xhr, status, error) {
		      // Manejar los errores de la petición AJAX
		    }
		  });
		}

		// Iniciar el contador
		mostrarContador();
	</script>
<?php endif ?>
