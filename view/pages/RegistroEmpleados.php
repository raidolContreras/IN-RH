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

	$departamentos = ControladorFormularios::ctrVerDepartamentos(null, null);
?>
<link rel="stylesheet" href="assets/vendor/datepicker/tempusdominus-bootstrap-4.css" />
<div class="container-fluid dashboard-content ">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<form id="formulario" class="container mt-4" method="post">


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
													<input type="text" class="form-control" id="municipio" name="municipio" placeholder="Municipio" required>
												</div>
												<div class="col-md-6">
													<input type="text" class="form-control" id="estado" name="estado" placeholder="Estado" required>
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
											<h3 class="hprofile">Datos del puesto</h3>
											<hr>
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label for="namePuesto" class="col-form-label font-weight-bold">Nombre del puesto:</label>
															<input type="text" class="form-control" id="namePuesto" name="namePuesto" value="<?php echo $nombreVacante; ?>" required>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="salarioPuesto" class="col-form-label font-weight-bold">Salario:</label>
															<input type="text"  maxlength="10" class="form-control" id="salarioPuesto" name="salarioPuesto" value="<?php echo $salarioVacante; ?>" pattern="[0-9]+(\.[0-9]{1,2})?" title="Ingrese un número con hasta dos decimales" required onkeypress="return (event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47)" min="1">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="salario_integrado" class="col-form-label font-weight-bold">Salario Diario Integrado:</label>
																<input type="text"  maxlength="10" class="form-control" id="salario_integrado" name="salario_integrado" pattern="[0-9]+(\.[0-9]{1,2})?" title="Ingrese un número con hasta dos decimales" required onkeypress="return (event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47)" min="1">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label for="horario_entrada" class="col-form-label font-weight-bold">Horario de entrada:</label>
																	<input type="time" class="form-control" id="horario_entrada" name="horario_entrada" required>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label for="horario_salida" class="col-form-label font-weight-bold">Horario de salida:</label>
																	<input type="time" class="form-control" id="horario_salida" name="horario_salida" required>
																</div>
															</div>
													<?php if (!isset($_GET['postulante'])): ?>
														<div class="form-group col-md-6">
															<label for="departamento" class="col-form-label text-center font-weight-bold">Departamento:</label>
															<select class="form-control form-control-lg" id="departamento" name="departamento">
																<?php foreach ($departamentos as $key => $departamento): ?>
																	<?php if ($departamento['idDepartamentos'] == $puesto['Departamentos_idDepartamentos']): ?>
																		<option value="<?php echo $departamento['idDepartamentos']; ?>" selected><?php echo ucwords(strtolower($departamento['nameDepto'])); ?></option>
																	<?php else: ?>
																		<option value="<?php echo $departamento['idDepartamentos']; ?>"><?php echo ucwords(strtolower($departamento['nameDepto'])); ?></option>
																	<?php endif ?>
																<?php endforeach ?>
															</select>
														</div>
														<div class="form-group col-md-6">
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

		<script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
		<script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
		<script src="assets/libs/js/main-js.js"></script>
		<script src="assets/vendor/datepicker/moment.js"></script>
		<script src="assets/vendor/datepicker/tempusdominus-bootstrap-4.js"></script>
		<script src="assets/vendor/datepicker/datepicker.js"></script>
		<!-- Bootstrap 4 JS -->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper-base.min.js"></script>

		<!-- Validación de formulario con jQuery -->
		<script>
			$(document).ready(function() {
				$("#registro-form").submit(function(event) {
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
		</script>