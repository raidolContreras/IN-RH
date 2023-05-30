<?php if (!isset($_GET['empresa'])): ?>
<?php 
$empresas = ControladorFormularios::ctrVerEmpresas(null,null);
// Leer el archivo JSON de estados
$estadosJson = file_get_contents('view/pages/json/estados.json');

// Convertir el JSON a un array asociativo
$estadosArray = json_decode($estadosJson, true);
$regimenJson = file_get_contents('view/pages/json/regimen.json');
$regimenArray = json_decode($regimenJson, true); 
?>
<div class="container-fluid dashboard-content ">
	<!-- ============================================================== -->
	<!-- end pageheader	-->
	<!-- ============================================================== -->
	<div class="ecommerce-widget">
		<!-- ============================================================== -->
		<!-- data table	-->
		<!-- ============================================================== -->
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="card">
				<div class="card-body">
					<a href="RegistroEmpresa" class="btb btn-success p-2 rounded mb-3 float-right">
						Nueva empresa<i class="fas fa-user-plus ml-2"></i>
					</a>
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered second" style="width:100%">
							<thead>
								<tr>
									<th>Nombre o Razón social</th>
									<th>Registro patronal</th>
									<th>R.F.C.</th>
									<th>Régimen</th>
									<th>Actividad económica</th>
									<th>Dirección</th>
									<th>Entidad y Población o municipio/alcaldia</th>
									<th>Teléfono</th>
									<th>Delegación IMSS</th>
									<th>Subdelegación IMSS</th>
									<th>Clave subdelegación</th>
									<th>Fecha de inicio de operaciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($empresas as $empresa): ?>
									<tr>
										<td>
											<a class="btn btn-link" href="Empresas&empresa=<?php echo $empresa['idEmpresas'];?>">
												<?php echo $empresa['nombre_razon_social']; ?>
											</a>
										</td>
										<td><?php echo $empresa['registro_patronal']; ?></td>
										<td><?php echo $empresa['rfc']; ?></td>
										<?php foreach ($regimenArray as $value): ?>
											<?php if ($value['clave'] == $empresa['regimen']): ?>
												<td>(<?php echo $value['clave']; ?>) <?php echo $value['nombre']; ?></td>
											<?php endif ?>
										<?php endforeach ?>
										<td><?php echo $empresa['actividad_economica']; ?></td>
										<td>Calle / Avenida: <?php echo $empresa['calle']; ?>,
										N°: <?php echo $empresa['numero']; ?>, N° interior: <? echo $empresa['numero_interior']; ?>,
										Colonia: <?php echo $empresa['colonia']; ?>
										C.P.: <?php echo $empresa['cp']; ?></td>
										<td><?php echo $empresa['poblacion_municipio']; ?>, <?php echo $empresa['entidad']; ?></td>
										<td><?php echo $empresa['telefono']; ?></td>
										<?php foreach ($estadosArray as $value): ?>
											<?php if ($value['clave'] == $empresa['delegacion_imss']): ?>
												<td><?php echo $value['nombre']; ?></td>
											<?php endif ?>
										<?php endforeach ?>
										<td><?php echo $empresa['subdelegacion']; ?></td>
										<td><?php echo $empresa['clave_subdelegacion']; ?></td>
										<td><?php echo $empresa['dia_inicio_afiliacion']; ?> de <?php echo $empresa['mes_inicio_afiliacion']; ?> del <?php echo $empresa['anio_inicio_afiliacion']; ?></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php else: ?>

	<?php $consultaEmpresa = ControladorFormularios::ctrVerEmpresas("idEmpresas",$_GET['empresa']);
	if (isset($consultaEmpresa[0])): ?>
		<?php 
		// Leer el archivo JSON de estados
		$estadosJson = file_get_contents('view/pages/json/estados.json');

		// Leer el archivo JSON de ciudades
		$ciudadesJson = file_get_contents('view/pages/json/ciudades.json');

		// Convertir el JSON a un array asociativo
		$estadosArray = json_decode($estadosJson, true);
		$ciudadesArray = json_decode($ciudadesJson, true); 


		$regimenJson = file_get_contents('view/pages/json/regimen.json');
		$regimenArray = json_decode($regimenJson, true); 
		$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"); 
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
												<input type="text" 
												class="form-control" 
												id="registro_patronal" 
												name="registro_patronal" 
												value="<?php echo $consultaEmpresa['registro_patronal']; ?>" 
												maxlength="14" placeholder="000-00000-00-0" 
												onkeyup="javascript:this.value=this.value.toUpperCase();" 
												required>

											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">

												<label for="rfc">R.F.C.</label>
												<input type="text"
												class="form-control"
												id="rfc"
												name="rfc"
												value="<?php echo $consultaEmpresa['rfc']; ?>" 
												onkeyup="javascript:this.value=this.value.toUpperCase();"
												maxlength="13"
												required>

											</div>
										</div>
										<div class="col-md-7">
											<div class="form-group">
												<label for="nombre_razon_social">Nombre o Razón social</label>
												<input type="text"
												class="form-control"
												id="nombre_razon_social"
												name="nombre_razon_social"
												value="<?php echo $consultaEmpresa['nombre_razon_social']; ?>" 
												required>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="regimen">Régimen</label>
												<select class="form-control" name="regimen" id="regimen" required>
													<?php foreach ($regimenArray as $regimen): ?>
														<?php if ($regimen['clave'] == $consultaEmpresa['regimen']): ?>
															<option value="<?php echo $regimen['clave'] ?>" selected>
																(<?php echo $regimen['clave'] ?>) <?php echo $regimen['nombre'] ?>
																</option>
															<?php else: ?>
															<option value="<?php echo $regimen['clave'] ?>">
																(<?php echo $regimen['clave'] ?>) <?php echo $regimen['nombre'] ?>
															</option>
														<?php endif ?>
													<?php endforeach ?>
												</select>
											</div>
										</div>
									</div>
										<hr>
									<div class="form-row">
										<div class="col-md-5">
											<div class="form-group">
												<label for="actividad_economica">Actividad económica</label>
												<input type="text"
												class="form-control"
												id="actividad_economica"
												name="actividad_economica"
												value="<?php echo $consultaEmpresa['actividad_economica']; ?>" 
												required>
											</div>
										</div>
										<div class="col-md-5">
											<div class="form-group">
												<label for="calle">Calle / Avenida</label>
												<input type="text"
												class="form-control"
												id="calle"
												name="calle"
												value="<?php echo $consultaEmpresa['calle']; ?>" 
												required>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<label for="numero">Numero</label>
												<input type="text"
												class="form-control"
												id="numero"
												name="numero"
												value="<?php echo $consultaEmpresa['numero']; ?>" 
												maxlength="5"
												required>
											</div>
										</div>
										<div class="col-md-1">
											<div class="form-group">
												<label for="numero_interior">N° Interior</label>
												<input type="text"
												class="form-control"
												id="numero_interior"
												name="numero_interior"
												value="<?php echo $consultaEmpresa['numero_interior']; ?>" 
												maxlength="5">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="colonia">Colonia</label>
												<input type="text"
												class="form-control"
												id="colonia"
												name="colonia"
												value="<?php echo $consultaEmpresa['colonia']; ?>" 
												required>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="cp">C.P.</label>
												<input type="number"
												class="form-control"
												id="cp"
												name="cp"
												value="<?php echo $consultaEmpresa['cp']; ?>" 
												max="99999"
												min="01000"
												minlength="5"
												required>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="entidad">Entidad</label>
												<select class="form-control" id="entidad" name="entidad" required>
													<option>Selecciona un estado</option>
													<?php foreach ($estadosArray as $estado): ?>
														<?php if ($estado['clave'] == $consultaEmpresa['entidad']): ?>
															<option value="<?php echo $estado['clave'] ?>" selected><?php echo $estado['nombre'] ?></option>
														<?php else: ?>
															<option value="<?php echo $estado['clave'] ?>"><?php echo $estado['nombre'] ?></option>
														<?php endif ?>
													<?php endforeach ?>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="poblacion_municipio">Población y municipio / alcaldia</label>
												<select class="form-control" id="poblacion_municipio" name="poblacion_municipio" required>
													<option value="<?php echo $consultaEmpresa['poblacion_municipio']; ?>" selected>
														<?php echo $consultaEmpresa['poblacion_municipio']; ?>
													</option>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="telefono">Teléfono</label>
												<input type="number"
												class="form-control"
												id="telefono"
												name="telefono"
												value="<?php echo $consultaEmpresa['telefono']; ?>"
												required>
											</div>
										</div>
									</div>
										<hr>
									<div class="form-row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="delegacion_imss">Delegación IMSS</label>
												<select class="form-control" id="delegacion_imss" name="delegacion_imss" required>
													<option>Selecciona un estado</option>
													<?php foreach ($estadosArray as $estado): ?>
														<?php if ($estado['clave'] == $consultaEmpresa['delegacion_imss']): ?>
														<option value="<?php echo $estado['clave'] ?>" selected><?php echo $estado['nombre'] ?></option>
														<?php else: ?>
														<option value="<?php echo $estado['clave'] ?>"><?php echo $estado['nombre'] ?></option>
														<?php endif ?>
													<?php endforeach ?>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="subdelegacion">Subdelegación IMSS</label>
												<select class="form-control" id="subdelegacion" name="subdelegacion" required>
													<option value="<?php echo $consultaEmpresa['subdelegacion']; ?>"><?php echo $consultaEmpresa['subdelegacion']; ?></option>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="clave_subdelegacion">Clave subdelegación</label>
												<input type="text"
												class="form-control"
												id="clave_subdelegacion"
												name="clave_subdelegacion"
												value="<?php echo $consultaEmpresa['clave_subdelegacion']; ?>"
												required>
											</div>
									</div>
										</div>
											<div class="form-group row">
												<div class="col-md-3">
													<label for="mes_inicio_afiliacion">Fecha de inicio de operaciones</label>
												</div>
											<div class="col-md-3">
												<div class="form-group">
													<select class="form-control" id="dia_inicio_afiliacion" name="dia_inicio_afiliacion" required>
														<option value="">Día</option>
														<?php for ($i=01; $i <= 31; $i++) { 
															if ($consultaEmpresa['dia_inicio_afiliacion'] == $i) {
																echo "<option value='".$i."' selected>".$i."</option>";
															}else{
																echo "<option value='".$i."'>".$i."</option>";
															}
														} ?>
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<select class="form-control" id="mes_inicio_afiliacion" name="mes_inicio_afiliacion" required>
														<option>Mes</option>
														<?php foreach ($meses as $mes): ?>
															<?php if ($mes = $consultaEmpresa['mes_inicio_afiliacion']): ?>
															<option value="<?php echo $mes ?>" selected><?php echo $mes ?></option>
															<?php else: ?>
															<option value="<?php echo $mes ?>"><?php echo $mes ?></option>
															<?php endif ?>
														<?php endforeach ?>
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<select class="form-control" id="anio_inicio_afiliacion" name="anio_inicio_afiliacion" required>
														<option value="">Año</option>
														<?php for ($i=2023; $i >= 1990; $i--) { 
															if ($consultaEmpresa['anio_inicio_afiliacion'] == $i) {
																echo "<option value='".$i."' selected>".$i."</option>";
															}else{
																echo "<option value='".$i."'>".$i."</option>";
															}
														} ?>
													</select>
												</div>
											</div>
										</div>
									<div class="form-group">
										<input type="hidden" name="actualizarEmpresa" value="<?php echo $_GET['empresa'] ?>">
										<button type="button" class="btn btn-primary rounded btn-block" id="empresa-btn">Actualizar datos</button>
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
						url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
						type: "POST",
						data: formData,
						success: function(response) {

							if (response === '"ok"') {
								$("#form-result").val("");
								$("#form-result").parent().after(`
									<div class='alert alert-success'>¡Datos actualizados con exito!</div>
									`);
								setTimeout(function() {
									location.href="Empresas";
								}, 500);
							}else{
								$("#form-result").val("");
								$("#form-result").parent().after(`
									<div class='alert alert-danger'><b>Error</b>, No se puedo actualizar, intenta nuevamente</div>
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
	<?php else: ?>
		<script>
			window.location.href="Empresas";
		</script>
	<?php endif ?>

<?php endif ?>
</div>