<?php if (isset($_GET['postulante'])){
	$postulante = ControladorFormularios::ctrVerPostulantes("idPostulantes", $_GET['postulante']);
	$nombre = $postulante['namePostulante'];
	$apellidos = $postulante['lastnamePostulante'];
	$telefono = $postulante['phonePostulante'];
	$email = $postulante['emailPostulante'];
	$idPostulante = $postulante['idPostulantes'];
	$Vacante = ControladorFormularios::ctrVerVacantes("idVacantes", $postulante['Vacantes_idVacantes']);
	$nombreVacante = $Vacante['nameVacante'];
	$salarioVacante = $Vacante['salarioVacante'];
}else{
	$nombre = '';
	$apellidos = '';
	$telefono = '';
	$email = '';
	$idPostulante = 0;
	$nombreVacante = "";
	$salarioVacante = 0;
}

$empresas = ControladorFormularios::ctrVerEmpresas(null,null);
$horarios = ControladorFormularios::ctrSeleccionarHorarios(null, null);

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
						<form id="formulario" class="container mt-4" method="post" id="formulario">


							<?php 

							/*=============================================
							FORMA EN QUE SE INSTANCIA LA CLASE DE UN MÉTODO ESTÁTICO 
							=============================================*/

							$registro = ControladorEmpleados::ctrRegistrarEmpleados();

							if($registro == "ok"){

								echo '<script>

								window.location = "Empleados";

								</script>';

								echo '<div class="alert alert-success">¡Nuevo Colaborador Registrado Exitosamente!</div>';

							}
							if ($registro == "1") {

								echo '<script>

								if ( window.history.replaceState ) {

									window.history.replaceState( null, null, window.location.href );

								}

								</script>';

								echo '<div class="alert alert-danger">Error, no se pudo registrar al colaborador, Error en los datos</div>';
							}

							?>

							<div class="card">
								<div class="card-body">
									<h3 class="hprofile">Datos Generales</h3>
									<hr>
									<div class="form-row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="nombre">Nombre(s)</label>
												<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre ?>" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="apellidos">Apellidos</label>
												<input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $apellidos ?>" required>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="genero">Género</label>
												<select class="form-control" id="genero" name="genero" required>
													<option value="">Seleccione una opción</option>
													<option value="1">Masculino</option>
													<option value="0">Femenino</option>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="fecha_nacimiento">Fecha de nacimiento</label>
												<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="num_identificacion">Número de identificación
													<a data-toggle="identificacion" title="Número de identificación" 
													data-content="Ejemplos: N° de INE, Pasaporte, etc."><i class="fas fa-info-circle"></i></a>
												</label>
												<input type="text" class="form-control" id="num_identificacion" name="num_identificacion" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="curp">CURP</label>
												<input type="text" class="form-control" id="curp" name="curp" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="num_seguro_social">Número de Seguro Social</label>
												<input type="number" class="form-control" id="num_seguro_social" name="num_seguro_social" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="rfc">RFC</label>
												<input type="text" class="form-control" id="rfc" name="rfc" required>
											</div>
										</div>
									</div>
									<div class="form-group card p-3">
										<label for="direccion">Dirección</label>
										<div class="row">
											<div class="col-md-9">
												<input type="text" class="form-control" id="calle" name="calle" placeholder="Calle" required>
											</div>
											<div class="col-md-3">
												<input type="text" class="form-control" id="num_exterior" name="num_exterior" placeholder="Núm. Ext." required>
											</div>
										</div>
										<div class="row mt-2">
											<div class="col-md-3">
												<input type="text" class="form-control" id="num_interior" name="num_interior" placeholder="Núm. Int.">
											</div>
											<div class="col-md-6">
												<input type="text" class="form-control" id="colonia" name="colonia" placeholder="Colonia" required>
											</div>
											<div class="col-md-3">
												<input type="text" class="form-control" id="cp" name="cp" placeholder="C.P." required>
											</div>
										</div>
										<div class="row mt-2">
											<div class="col-md-6">
												<select class="form-control" id="estado" name="estado" required>
													<option>Selecciona un estado</option>
													<?php foreach ($estadosArray as $key => $estado): ?>
														<option value="<?php echo $estado['clave'] ?>"><?php echo $estado['nombre'] ?></option>
													<?php endforeach ?>
												</select>
											</div>
											<div class="col-md-6">
												<select class="form-control" id="municipio" name="municipio" required>
													<option>Selecciona un estado primero</option>
												</select>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col-md-6">  
											<div class="form-group">
												<label for="telefono">Teléfono</label>
												<input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono ?>" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="email">Email</label>
												<input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>" required>
											</div>
										</div>
									</div>
									<hr>
									<h3 class="hprofile">Contacto de emergencia</h3>
									<hr>
									<div class="form-row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="emergencia">Contacto de emergencia</label>
												<input type="text" class="form-control" id="emergencia" name="emergencia" placeholder="Nombre" required>
											</div>
										</div>
										<div class="col-md-6">  
											<div class="form-group">
												<label for="telefono">Teléfono de emergengia</label>
												<input type="tel" class="form-control" id="telefono" name="telefonoE" required>
											</div>
										</div>
										<div class="form-group col-md-6">
											<label for="parentesco" class="col-form-label text-center font-weight-bold">Parentesco:</label>
											<select class="form-control form-control-lg" id="parentesco" name="parentesco">
												<option value="">Selecciona una opción</option>
												<option value="padre">Padre</option>
												<option value="madre">Madre</option>
												<option value="hermano">Hermano</option>
												<option value="amigo">Amigo</option>
												<option value="pareja">Pareja</option>
											</select>
										</div>
									</div>
									<hr>
									<h3 class="hprofile">Contrato</h3>
									<hr>
									<div class="row">
										<div class="form-group col-md-4">
											<label for="contrato" class="col-form-label text-center font-weight-bold">¿Cuenta con contrato?:</label>
											<div class="input-group-text" style="justify-content: center;">
												<input type="checkbox" name="contrato" id="contrato">
											</div>
										</div>
										<div class="form-group col-md-4">
											<label for="tipo_contrato" class="col-form-label text-center font-weight-bold">Tipo de contrato:</label>
											<select class="form-control" id="tipo_contrato" name="tipo_contrato" disabled>
												<option value="">Selecciona una opción</option>
												<option value="Contrato por Obra o Tiempo Determinado">Contrato por Obra o Tiempo Determinado</option>
												<option value="Contrato por Tiempo Indeterminado">Contrato por Tiempo Indeterminado</option>
												<option value="Contrato en Practicas">Contrato en Practicas</option>
												<option value="Contrato para la Capacitación">Contrato para la Capacitación</option>
											</select>
										</div>
										<div class="form-group col-md-4">
											<label for="fecha_contrato" class="col-form-label text-center font-weight-bold">fecha de inicio del contrato</label>
											<input type="date" class="form-control" id="fecha_contrato" name="fecha_contrato" disabled>
										</div>
									</div>
									<hr>
									<h3 class="hprofile">Crédito Infonavit</h3>
									<hr>
									<div class="row">
										<div class="form-group col-md-4">
											<label for="cuenta_infonavit" class="col-form-label text-center font-weight-bold">¿Cuenta con Crédito Infonavit?:</label>
											<div class="input-group-text" style="justify-content: center;">
												<input type="checkbox" name="cuenta_infonavit" id="cuenta_infonavit">
											</div>
										</div>
										<div class="form-group col-md-4">
											<label for="tipo_credito" class="col-form-label text-center font-weight-bold">Tipo de crédito</label>
											<select class="form-control" id="tipo_credito" name="tipo_credito" disabled>
												<option value="">Selecciona una opción</option>
												<option value="Porcentaje">Porcentaje</option>
												<option value="Cuota fija">Cuota fija</option>
												<option value="Factor de descuento">Factor de descuento</option>
											</select>
										</div>
										<div class="form-group col-md-4">
											<label for="numero_credito" class="col-form-label text-center font-weight-bold">Numero de crédito</label>
											<input type="text" class="form-control" id="numero_credito" name="numero_credito" disabled>
										</div>
									</div>
									<hr>
									<h3 class="hprofile">Datos del puesto</h3>
									<hr>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="namePuesto" class="col-form-label font-weight-bold">Nombre del puesto:</label>
												<input type="text" class="form-control" id="namePuesto" name="namePuesto" value="<?php echo $nombreVacante; ?>" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="salarioPuesto" class="col-form-label font-weight-bold">Salario:</label>
												<input type="text"  maxlength="10" class="form-control form-control-lg" id="salarioPuesto" name="salarioPuesto" value="<?php echo $salarioVacante; ?>" pattern="[0-9]+(\.[0-9]{1,2})?" title="Ingrese un número con hasta dos decimales" required onkeypress="return (event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47)" min="1">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="salario_integrado" class="col-form-label font-weight-bold">Salario Diario Integrado:</label>
													<input type="text"  maxlength="10" class="form-control form-control-lg" id="salario_integrado" name="salario_integrado" pattern="[0-9]+(\.[0-9]{1,2})?" title="Ingrese un número con hasta dos decimales" required onkeypress="return (event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47)" min="1">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="salario_integrado" class="col-form-label font-weight-bold">Fecha de contratación:</label>
														<input type="date" name="fecha_contratado" id="fecha_contratado" class="form-control" max="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="horarios" class="col-form-label font-weight-bold">Horario:</label>
														<select class="form-control form-control-lg" id="horarios" name="horarios">
															<?php foreach ($horarios as $horario): ?>
																<?php $selected = ($horario['default'] == 1) ? ' selected' : ''; ?>
																<option value="<?php echo $horario['idHorarios'] ?>"<?php echo $selected; ?>><?php echo $horario['nameHorario'] ?></option>
															<?php endforeach ?>
														</select>
													</div>
												</div>
												<?php if (!isset($_GET['postulante'])): ?>
													<div class="form-group col-md-4">
														<label for="empresa" class="col-form-label font-weight-bold">Empresa:</label>
														<select class="form-control form-control-lg" id="empresa" name="empresa" required>
															<option>
																Seleccionar empresa
															</option>
															<?php foreach ($empresas as $empresa): ?>
																<?php if ($empresasSelect['idEmpresas'] == $empresa['idEmpresas']): ?>
																	<option value="<?php echo $empresa['idEmpresas']; ?>" selected>
																		<?php echo ucwords(strtolower($empresa['nombre_razon_social']." (".$empresa['rfc'].")")); ?>
																	</option>
																<?php else: ?>
																	<option value="<?php echo $empresa['idEmpresas']; ?>">
																		<?php echo ucwords(strtolower($empresa['nombre_razon_social']." (".$empresa['rfc'].")")); ?>
																	</option>
																<?php endif ?>
															<?php endforeach ?>
														</select>
													</div>
													<div class="form-group col-md-4">
														<label for="departamento" class="col-form-label text-center font-weight-bold">Departamento:</label>
														<select class="form-control form-control-lg" id="Pertenencia" name="departamento">
															<option>Selecciona la empresa</option>
														</select>
													</div>
													<div class="form-group col-md-4">
														<label for="asignarJefatura" class="col-form-label text-center font-weight-bold">¿Asignar Jefe?:</label>
														<div class="input-group-text" style="justify-content: center;">
															<input type="checkbox" name="asignarJefatura" id="asignarJefatura">
														</div>
													</div>
													<input type="hidden" name="postulante" value="0">
												<?php else: ?>
													<input type="hidden" name="postulante" value="<?php echo $idPostulante; ?>">
												<?php endif ?>
											</div>

										</div>
									</div>

									<div class="form-group">
										<button type="submit" class="btn btn-primary rounded btn-block">Enviar</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		var empresa = document.getElementById('empresa');
		var pertenencia = document.getElementById('Pertenencia');
		$("#empresa").change(function() {
			var empresaId = $(this).val();
			$.ajax({
				url: "ajax/ajax.formularios.php",
				type: "POST",
				data: {
					empresaId: empresaId
				},
				success: function(response) {
					var perteneceDepa = JSON.parse(response);

// Limpiar las opciones actuales del select de ciudades
					pertenencia.innerHTML = '';

// Agregar una opción predeterminada
					var opcionPredeterminada = document.createElement('option');
					opcionPredeterminada.text = 'Sin departamento';
					pertenencia.add(opcionPredeterminada);

// Agregar las opciones de ciudades correspondientes al estado seleccionado
					perteneceDepa.forEach(function(datos) {
						var opcionDepartamento = document.createElement('option');
						if (datos.Pertenencia === null) {
							opcionDepartamento.text = datos.name;
						}else{
							opcionDepartamento.text = datos.name + ' (' + datos.Pertenencia + ')';
						}
						opcionDepartamento.value = datos.id;
						pertenencia.add(opcionDepartamento);
					});
				}
			});
		});
	});
</script>
<!-- Validación de formulario con jQuery -->
<script>
	$(document).ready(function() {
		$("#formulario").submit(function(event) {
// Obtener valores de los campos
			var nombre = $("#nombre").val();
			var apellidos = $("#apellidos").val();
			var fecha_nacimiento = $("#fecha_nacimiento").val();
			var calle = $("#calle").val();
			var num_exterior = $("#num_exterior").val();
			var num_interior = $("#num_interior").val();
			var colonia = $("#colonia").val();
			var municipio = $("#municipio").val();
			var estado = $("#estado").val();
			var telefono = $("#telefono").val();
			var email = $("#email").val();
// Validar campos
			if (nombre.trim() == "") {
				alert("Por favor, ingrese su(s) nombre(s).");
				$("#nombre").focus();
				return false;
			}     
			if (apellidos.trim() == "") {
				alert("Por favor, ingrese sus apellidos.");
				$("#apellidos").focus();
				return false;
			}

			if (fecha_nacimiento.trim() == "") {
				alert("Por favor, ingrese su fecha de nacimiento.");
				$("#fecha_nacimiento").focus();
				return false;
			}

			if (calle.trim() == "") {
				alert("Por favor, ingrese su calle.");
				$("#calle").focus();
				return false;
			}

			if (num_exterior.trim() == "") {
				alert("Por favor, ingrese su número exterior.");
				$("#num_exterior").focus();
				return false;
			}

			if (colonia.trim() == "") {
				alert("Por favor, ingrese su colonia.");
				$("#colonia").focus();
				return false;
			}

			if (municipio.trim() == "") {
				alert("Por favor, ingrese su municipio.");
				$("#municipio").focus();
				return false;
			}

			if (estado.trim() == "") {
				alert("Por favor, ingrese su estado.");
				$("#estado").focus();
				return false;
			}

			if (telefono.trim() == "") {
				alert("Por favor, ingrese su teléfono.");
				$("#telefono").focus();
				return false;
			}

			if (email.trim() == "") {
				alert("Por favor, ingrese su email.");
				$("#email").focus();
				return false;
			}

// Validar formato de email
			var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
			if (!email_regex.test(email)) {
				alert("Por favor, ingrese un email válido.");
				$("#email").focus();
				return false;
			}

// Validar formato de teléfono
			var telefono_regex = /^[0-9]{10}$/;
			if (!telefono_regex.test(telefono)) {
				alert("Por favor, ingrese un teléfono válido de 10 dígitos.");
				$("#telefono").focus();
				return false;
			}

// Validar formato de número de identificación
			var num_identificacion_regex = /^[a-zA-Z0-9]+$/;
			if (!num_identificacion_regex.test($("#num_identificacion").val())) {
				alert("Por favor, ingrese un número de identificación válido (solo letras y números).");
				$("#num_identificacion").focus();
				return false;
			}

// Si todos los campos son válidos, enviar el formulario
			return true;
		});
	});

	$(document).ready(function(){
		$('[data-toggle="identificacion"]').popover();   
	});


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

function toggleInputFields(checkboxId, inputId) {
    var checkbox = document.getElementById(checkboxId);
    var input = document.getElementById(inputId);

    if (checkbox.checked) {
        input.disabled = false;
    } else {
        input.disabled = true;
        input.value = ''; // Limpia el valor del campo cuando se deshabilita
    }
}

// Asigna la función a los eventos 'click' de los checkboxes
document.getElementById('contrato').addEventListener('click', function () {
    toggleInputFields('contrato', 'tipo_contrato');
    toggleInputFields('contrato', 'fecha_contrato');
});

document.getElementById('cuenta_infonavit').addEventListener('click', function () {
    toggleInputFields('cuenta_infonavit', 'tipo_credito');
    toggleInputFields('cuenta_infonavit', 'numero_credito');
});
</script>
