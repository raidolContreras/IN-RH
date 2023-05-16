<?php 
// Leer el archivo JSON de estados
$estadosJson = file_get_contents('view/pages/json/estados.json');

// Leer el archivo JSON de ciudades
$ciudadesJson = file_get_contents('view/pages/json/ciudades.json');

// Convertir el JSON a un array asociativo
$estadosArray = json_decode($estadosJson, true);
$ciudadesArray = json_decode($ciudadesJson, true); 
?>
<div class="container-fluid dashboard-content ">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<div id="form-result"></div>
						<form id="empresa-form" class="container mt-4">
							<div class="form-row">
								<div class="col-md-2">
									<div class="form-group">
										<label for="registro_patronal">Registro patronal</label>
										<input type="text" class="form-control" id="registro_patronal" name="registro_patronal" maxlength="14" placeholder="000-00000-00-0" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="rfc">R.F.C.</label>
										<input type="text" class="form-control" id="rfc" name="rfc" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="13" required>
									</div>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<label for="nombre_razon_social">Nombre o Razón social</label>
										<input type="text" class="form-control" id="nombre_razon_social" name="nombre_razon_social" required>
									</div>
								</div>
							</div>
								<hr>
							<div class="form-row">
								<div class="col-md-5">
									<div class="form-group">
										<label for="actividad_economica">Actividad económica</label>
										<input type="text" class="form-control" id="actividad_economica" name="actividad_economica" required>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<label for="calle">Calle</label>
										<input type="text" class="form-control" id="calle" name="calle" required>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="numero">Numero</label>
										<input type="text" class="form-control" id="numero" name="numero" maxlength="5" required>
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<label for="numero_interior">N° Interior</label>
										<input type="text" class="form-control" id="numero_interior" name="numero_interior" maxlength="5">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="colonia">Colonia</label>
										<input type="text" class="form-control" id="colonia" name="colonia" required>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="cp">C.P.</label>
										<input type="number" class="form-control" id="cp" name="cp" max="99999" min="01000" minlength="5" required>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="entidad">Entidad</label>
										<select class="form-control" id="entidad" name="entidad" required>
											<option>Selecciona un estado</option>
											<?php foreach ($estadosArray as $key => $estado): ?>
												<option value="<?php echo $estado['clave'] ?>"><?php echo $estado['nombre'] ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="poblacion_municipio">Población y municipio / alcaldia</label>
										<select class="form-control" id="poblacion_municipio" name="poblacion_municipio" required>
											<option>Selecciona un estado primero</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="telefono">Teléfono</label>
										<input type="number" class="form-control" id="telefono" name="telefono" required>
									</div>
								</div>
							</div>
								<hr>
							<div class="form-row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="convenio_reembolso">Convenio de reembolso de suministros</label>
										<input type="checkbox" class="form-control" id="convenio_reembolso" name="convenio_reembolso">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="delegacion_imss">Delegación IMSS</label>
										<select class="form-control" id="delegacion_imss" name="delegacion_imss" required>
											<option>Selecciona un estado</option>
											<?php foreach ($estadosArray as $key => $estado): ?>
												<option value="<?php echo $estado['clave'] ?>"><?php echo $estado['nombre'] ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="subdelegacion">Subdelegación IMSS</label>
										<select class="form-control" id="subdelegacion" name="subdelegacion" required>
											<option>Selecciona una delegación primero</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="clave_subdelegacion">Clave subdelegación</label>
										<input type="text" class="form-control" id="clave_subdelegacion" name="clave_subdelegacion" required>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="mes_inicio_afiliacion">Mes del inicio del modulo de afiliación</label>
										<select class="form-control" id="mes_inicio_afiliacion" name="mes_inicio_afiliacion" required>
											<option>Selecciona un mes</option>
											<option value="Enero">Enero</option>
											<option value="Febrero">Febrero</option>
											<option value="Marzo">Marzo</option>
											<option value="Abril">Abril</option>
											<option value="Mayo">Mayo</option>
											<option value="Junio">Junio</option>
											<option value="Julio">Julio</option>
											<option value="Agosto">Agosto</option>
											<option value="Septiembre">Septiembre</option>
											<option value="Octubre">Octubre</option>
											<option value="Noviembre">Noviembre</option>
											<option value="Diciembre">Diciembre</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="anio_inicio_afiliacion">Año del inicio del modulo de afiliación</label>
										<select class="form-control" id="anio_inicio_afiliacion" name="anio_inicio_afiliacion" required>
											<option value="">Selecciona el año</option>
											<?php for ($i=2023; $i >= 1990; $i--) { 
												echo "<option value='".$i."'>".$i."</option>";
											} ?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="hidden" name="empresa" value="1">
								<button type="button" class="btn btn-primary rounded btn-block" id="empresa-btn">Registrar empresa</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	
	$(document).ready(function() {
		$("#empresa-btn").click(function() {
		var formData = $("#empresa-form").serialize(); // Obtener los datos del formulario

			$.ajax({
				url: "ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
				type: "POST",
				data: formData,
				success: function(response) {

					if (response === '"ok"') {
						$("#form-result").val("");
						$("#form-result").parent().after(`
							<div class='alert alert-success'>¡Nuevo empresa registrada!</div>
							`);
						setTimeout(function() {
							location.reload();
						}, 500);
					}else{
						$("#form-result").val("");
						$("#form-result").parent().after(`
							<div class='alert alert-danger'><b>Error</b>, empresa no registrada, intenta nuevamente</div>
							`);
					}

				}
			});
		});
	});

</script>

<script>

document.getElementById("registro_patronal").addEventListener("input", function() {
  var value = this.value.toUpperCase(); // Convertir a mayúsculas
  var formattedValue = '';

  if (value.length > 0) {
    formattedValue = value.replace(/[^A-Z0-9]/g, ''); // Eliminar caracteres no alfanuméricos
    formattedValue = formattedValue.replace(/^(\w{0,3})(\w{0,5})(\w{0,2})(\w{0,1})$/, function(match, p1, p2, p3, p4) {
      var parts = [p1, p2, p3, p4].filter(Boolean); // Filtrar solo las partes definidas

      return parts.join('-'); // Unir las partes con guiones
    });
  }

  this.value = formattedValue;
});

// Obtener referencia a los elementos select
var estadoSelect = document.getElementById('entidad');
var poblacionMunicipioSelect = document.getElementById('poblacion_municipio');

// Manejar el evento de cambio en el select de estado
estadoSelect.addEventListener('change', function() {
	// Obtener el valor seleccionado del estado
	var estadoSeleccionado = estadoSelect.value;

	// Obtener las ciudades correspondientes al estado seleccionado
	var ciudades = <?php echo json_encode($ciudadesArray); ?>;
	var ciudadesEstado = ciudades[estadoSeleccionado];

	// Limpiar las opciones actuales del select de ciudades
	poblacionMunicipioSelect.innerHTML = '';

	// Agregar una opción predeterminada
	var opcionPredeterminada = document.createElement('option');
	opcionPredeterminada.text = 'Selecciona una ciudad';
	poblacionMunicipioSelect.add(opcionPredeterminada);

	// Agregar las opciones de ciudades correspondientes al estado seleccionado
	if (ciudadesEstado) {
		ciudadesEstado.forEach(function(ciudad) {
			var opcionCiudad = document.createElement('option');
			opcionCiudad.text = ciudad;
			opcionCiudad.value = ciudad;
			poblacionMunicipioSelect.add(opcionCiudad);
		});
	}
});

// Obtener referencia a los elementos select
var delegacionSelect = document.getElementById('delegacion_imss');
var subDelegacionSelect = document.getElementById('subdelegacion');

// Manejar el evento de cambio en el select de estado
delegacionSelect.addEventListener('change', function() {
	// Obtener el valor seleccionado del estado
	var delegacionSeleccionado = delegacionSelect.value;

	// Obtener las ciudades correspondientes al estado seleccionado
	var subdelegaciones = <?php echo json_encode($ciudadesArray); ?>;
	var subdelegacionDelegacion = subdelegaciones[delegacionSeleccionado];

	// Limpiar las opciones actuales del select de ciudades
	subDelegacionSelect.innerHTML = '';

	// Agregar una opción predeterminada
	var opcionPredeterminada = document.createElement('option');
	opcionPredeterminada.text = 'Selecciona una subdelegación';
	subDelegacionSelect.add(opcionPredeterminada);

	// Agregar las opciones de ciudades correspondientes al estado seleccionado
	if (subdelegacionDelegacion) {
		subdelegacionDelegacion.forEach(function(ciudad) {
			var opcionSubdelegacion = document.createElement('option');
			opcionSubdelegacion.text = ciudad;
			opcionSubdelegacion.value = ciudad;
			subDelegacionSelect.add(opcionSubdelegacion);
		});
	}
});
</script>
