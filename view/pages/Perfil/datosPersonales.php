<div class="col-xl-12 col-md-12 my-4">
	<div class="card-into-card rounded-card px-4">
		<h5 class="card-title mb-1 mt-3">Detalles personales</h5>
		<p class="card-subtitle mb-4">Para cambiar sus datos personales, edite y guarde desde aquí</p>
		<form id="DatosPersonales-form">
		<div class="row">
			<div class="col-lg-6">
			<div class="mb-4">
				<label for="nombre">Nombre(s)</label>
				<input type="text" class="form-control" id="nombre" name="nombrePerfil" value="<?php echo $empleado['name'] ?>" required>
			</div>
			<div class="mb-4">
				<label for="genero">Género</label>
				<select class="form-control" id="genero" name="generoPerfil" required>
					<?php if ($empleado['genero'] == 1): ?>
						<option value="1" selected>Masculino</option>
						<option value="0">Femenino</option>
					<?php else: ?>
						<option value="1">Masculino</option>
						<option value="0" selected>Femenino</option>
					<?php endif ?>
				</select>
			</div>
			</div>
			<div class="col-lg-6">
			<div class="mb-4">
				<label for="apellidos">Apellidos</label>
				<input type="text" class="form-control" id="apellidos" name="apellidosPerfil" value="<?php echo $empleado['lastname'] ?>" required>
			</div>
			<div class="mb-4">
				<label for="fecha_nacimiento">Fecha de nacimiento</label>
				<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimientoPerfil" value="<?php echo $empleado['fNac'] ?>" required>
			</div>
			</div>
			
			<div class="form-group card p-3 col-12">
				<label for="direccion">Dirección</label>
				<div class="row">
					<div class="col-md-9">
						<input type="text" class="form-control" id="calle" name="callePerfil" placeholder="Calle" value="<?php echo $empleado['street'] ?>" required>
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control" id="num_exterior" name="num_exteriorPerfil" placeholder="Núm. Ext." value="<?php echo $empleado['numE'] ?>" required>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-md-3">
						<?php if ($empleado['numI'] != ''): ?>
							<input type="text" class="form-control" id="num_interior" name="num_interiorPerfil" placeholder="Núm. Int." value="<?php echo $empleado['numI'] ?>">
						<?php else: ?>
							<input type="text" class="form-control" id="num_interior" name="num_interiorPerfil" placeholder="Núm. Int.">
						<?php endif ?>
					</div>
					<div class="col-md-6">
						<input type="text" class="form-control" id="colonia" name="coloniaPerfil" placeholder="Colonia" value="<?php echo $empleado['col'] ?>" required>
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control" id="cp" name="cpPerfil" placeholder="C.P." value="<?php echo $empleado['CP'] ?>" required>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-md-6">
						<select class="form-control" id="estado" name="estadoPerfil" required>
							<option>Selecciona un estado</option>
							<?php foreach ($estadosArray as $key => $estado): ?>
								<?php if ($empleado['estado'] == $estado['clave']): ?>
									<option value="<?php echo $estado['clave'] ?>" selected><?php echo $estado['nombre'] ?></option>
								<?php else: ?>
									<option value="<?php echo $estado['clave'] ?>"><?php echo $estado['nombre'] ?></option>
								<?php endif ?>
							<?php endforeach ?>
						</select>
					</div>
					<div class="col-md-6">
						<select class="form-control" id="municipio" name="municipioPerfil" required>
							<option value="<?php echo $empleado['municipio'] ?>"><?php echo $empleado['municipio'] ?></option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-12">
			<div class="d-flex align-items-center justify-content-end mt-4 gap-3">
				<button type="button" class="btn btn-primary rounded" id="DatosPersonales-btn">Actualizar</button>
				<button class="btn btn-light-danger text-danger rounded">Cancelar</button>
			</div>
			</div>
		</div>
		</form>
	</div>
</div>
<script src="assets/libs/js/datosPersonales.js"></script>
<script>
	
// Obtener referencia a los elementos select
var estadoSelect = document.getElementById('estado');
var poblacionMunicipioSelect = document.getElementById('municipio');

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
</script>