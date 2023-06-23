<?php
	$diaLaborableNombres = [
		1 => "Lunes",
		2 => "Martes",
		3 => "Miércoles",
		4 => "Jueves",
		5 => "Viernes",
		6 => "Sábado",
		0 => "Domingo"
	];
	if (isset($_GET['plantilla'])): ?>
	<?php 
$plantilla = ControladorFormularios::ctrSeleccionarHorarios("idHorarios", $_GET['plantilla']);
$diasLaborables = ControladorFormularios::ctrSeleccionarHorarios("Horarios_idHorarios", $_GET['plantilla']);

?>

<div class="container-fluid dashboard-content">
	<div class="container">
		<div class="card p-4">
			<form id="NewHorario-form">
				<div class="form-result"></div>
				<div class="row mb-2">
					<div class="col-7">
						<label class="col-form-label font-weight-light" for="actualizarNameHorario">Añadir un nombre</label>
						<input class="form-control" type="text" name="actualizarNameHorario" id="actualizarNameHorario" value="<?php echo $plantilla[0]['nameHorario'] ?>" required>
						<input type="hidden" name="plantilla" id="plantilla" value="<?php echo $_GET['plantilla'] ?>">
					</div>
				</div>

				<div class="encabezado pt-4">Selecciona las horas por cada día laboral</div>
				<p class="ajustes-text"><i class="far fa-question-circle"></i> Añade todos los turnos por día para esta plantilla de horario de trabajo.</p>
				<div class="table-in">
					<div class="table-header row">
						<div class="col-1"></div>
						<div class="col-2">DÍAS</div>
						<div class="col-5">HORARIOS DE TRABAJO</div>
						<div class="col-4">HORAS ESPERADAS</div>
					</div>
					<div class="table-body">
						<?php foreach ($diaLaborableNombres as $key => $value): ?>
							<?php
							$activeClass = '';
							$checked = '';
							$horaEntrada = '';
							$horaSalida = '';

							// Buscar el día laborable correspondiente en $diasLaborables
							$diaLaborable = array_filter($diasLaborables, function($dia) use ($key) {
								return $dia['dia_Laborable'] == $key;
							});

							// Verificar si se encontró el día laborable
							if (!empty($diaLaborable)) {
								$activeClass = 'active';
								$checked = 'checked';
								$horaEntrada = reset($diaLaborable)['hora_Entrada'];
								$horaSalida = reset($diaLaborable)['hora_Salida'];

								// Calcular el número de horas esperadas
								$horas = floor(reset($diaLaborable)['numero_Horas']);
								$minutos = floor((reset($diaLaborable)['numero_Horas'] - $horas) * 60);
								$resultado = $horas . " horas " . $minutos . " min";
							} else {
								$resultado = "";
							}
							?>
							<div class="row">
								<div class="col-1">
									<input type="checkbox" 
										   name="dia" 
										   <?php echo $checked; ?>
										   id="<?php echo $value; ?>" 
										   value="<?php echo $key; ?>" 
										   onChange="activarDiv(this)">
								</div>

								<div class="col-2 <?php echo $activeClass ?>" id="dia<?php echo $key; ?>">
									<?php echo $value ?>
								</div>
								<div class="col-5 <?php echo $activeClass ?>" id="horarios<?php echo $key; ?>">
									<?php if ($checked): ?>
										<div class="row pt-1 pb-1 in-col">
											<div class="col-6">
												<input class="form-control input-dia" type="time" name="Entrada<?php echo $key; ?>" value="<?php echo $horaEntrada; ?>" onChange="calcularHoras(<?php echo $key; ?>)">
											</div>
											<div class="col">a</div>
											<div class="col-6">
												<input class="form-control input-dia" type="time" name="Salida<?php echo $key; ?>" value="<?php echo $horaSalida; ?>" onChange="calcularHoras(<?php echo $key; ?>)">
											</div>
										</div>
									<?php endif; ?>
								</div>
								<div class="col-4 <?php echo $activeClass ?>" id="horasxdia<?php echo $key; ?>">
									<?php echo $resultado; ?>
								</div>
							</div>
						<?php endforeach ?>

						</div>
					</div>


					<div class="card">
						<div class="card-footer p-0 text-center d-flex justify-content-center ">
							<div class="card-footer-item card-footer-item-bordered">
								<a href="Asistencia-ajustes" class="card-link btn btn-outline-secondary btn-block rounded">Cancelar</a>
							</div>
							<div class="card-footer-item card-footer-item-bordered">
								<button class="btn btn-primary btn-block guardar-horario" type="submit">Guardar</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<script>
		function activarDiv(checkbox) {
			var dia = checkbox.value;
			var diaElement = document.getElementById("dia" + dia);
			var horariosElement = document.getElementById("horarios" + dia);
			var horasxdiaElement = document.getElementById("horasxdia" + dia);
			var btnEnviar = document.getElementById("NewHorario-btn");

			if (checkbox.checked) {
				diaElement.classList.add("active");
				horariosElement.classList.add("active");
				horasxdiaElement.classList.add("active");

				horariosElement.innerHTML = "";

				var inputDia = document.createElement("input");
				inputDia.className = "form-control input-dia";
				inputDia.name = "Entrada" + dia;
				inputDia.type = "time";
				inputDia.addEventListener("input", function () {
					calcularHoras(dia);
				});

				var inputDia2 = document.createElement("input");
				inputDia2.className = "form-control input-dia";
				inputDia2.name = "Salida" + dia;
				inputDia2.type = "time";
				inputDia2.addEventListener("input", function () {
					calcularHoras(dia);
				});

				var entrada = document.createElement("div");
				var salida = document.createElement("div");
				var texto = document.createElement("div");

				entrada.className = "col-5";
				salida.className = "col-5";
				texto.className = "col-2";

				var newContent = document.createTextNode(" a ");

				entrada.appendChild(inputDia);
				salida.appendChild(inputDia2);
				texto.appendChild(newContent);

				var divDia = document.createElement("div");
				divDia.className = "row";
				divDia.appendChild(entrada);
				divDia.appendChild(texto);
				divDia.appendChild(salida);
				horariosElement.appendChild(divDia);

				calcularHoras(dia);
			} else {
				diaElement.classList.remove("active");
				horariosElement.classList.remove("active");
				horasxdiaElement.classList.remove("active");

// Eliminar los elementos creados anteriormente
				horariosElement.innerHTML = "";

// Limpiar el contenido del elemento horasxdiaElement
				horasxdiaElement.textContent = "";
			}

			verificarCheckboxes();
		}

		function verificarCheckboxes() {
			var checkboxes = document.querySelectorAll("input[type='checkbox']");
			var btnEnviar = document.getElementById("NewHorario-btn");

			var todosDesactivados = true;

			for (var i = 0; i < checkboxes.length; i++) {
				if (checkboxes[i].checked) {
					todosDesactivados = false;
					break;
				}
			}

			if (todosDesactivados) {
				btnEnviar.classList.add("disabled");
			} else {
				btnEnviar.classList.remove("disabled");
			}
		}

		function calcularHoras(dia) {
			var horasxdia = document.getElementById("horasxdia" + dia);
			var inputs = document.querySelectorAll("#horarios" + dia + " input[type='time']");

			var entrada = inputs[0].value.split(":");
			var salida = inputs[1].value.split(":");

			var horaEntrada = parseInt(entrada[0]);
			var minutoEntrada = parseInt(entrada[1]);
			var horaSalida = parseInt(salida[0]);
			var minutoSalida = parseInt(salida[1]);

			var diferenciaHoras = horaSalida - horaEntrada;
			var diferenciaMinutos = minutoSalida - minutoEntrada;

			if (diferenciaMinutos < 0) {
				diferenciaHoras -= 1;
				diferenciaMinutos += 60;
			}
			if (isNaN(diferenciaHoras) || isNaN(diferenciaMinutos)) {
				diferenciaHoras = 0;
				diferenciaMinutos = 0;
			}

			horasxdia.textContent = diferenciaHoras + " horas " + diferenciaMinutos + " min";
		}

// Verificar checkboxes al cargar la página
		window.onload = function () {
			verificarCheckboxes();
		};

		$(document).ready(function() {
			$("#NewHorario-form").on("submit", function(e) {
				e.preventDefault();

				var diasSeleccionados = [];
				$("input[name='dia']:checked").each(function() {
					diasSeleccionados.push($(this).val());
				});

				var datosHorarios = {};

				diasSeleccionados.forEach(function(dia) {
					datosHorarios["Entrada" + dia] = $("#horarios" + dia + " input[name='Entrada" + dia + "']").val();
					datosHorarios["Salida" + dia] = $("#horarios" + dia + " input[name='Salida" + dia + "']").val();
				});

				$.ajax({
					type: "POST",
					url: "ajax/horarios.php",
					data: {
						actualizarNameHorario: $("#actualizarNameHorario").val(),
						plantilla: $("#plantilla").val(),
						dia: diasSeleccionados,
						horarios: datosHorarios
					},
					dataType: "json",
					success: function(response) {
						if (response === '"ok"' || response === 'ok') {
							$(".form-result").empty();
							$(".form-result").after(`
								<div class='alert alert-success'>Nuevo Horario Registrado</div>
								`);
							setTimeout(function() {
								location.href="Asistencia-ajustes";
							}, 500);
						}else{
							$(".form-result").val("");
							$(".form-result").parent().after(`
								<div class='alert alert-danger'><b>Error</b>, No se pudo registrar el horario, intenta nuevamente</div>
								`);
						}
					},
					error: function(xhr, status, error) {
						console.log(error);
					}
				});
			});
		});
	</script>
<?php elseif (isset($_GET['eliminar'])): 

	if (isset($_POST['horario'])) {
		$eliminar = ControladorFormularios::ctrEliminarHorarios();

		/*=============================================
		FORMA EN QUE SE INSTANCIA LA CLASE DE UN MÉTODO ESTÁTICO 
		=============================================*/

		if($eliminar == "ok"){
			echo '<script>
			location.href="Asistencia-ajustes";
			</script>';

			echo '<div class="alert alert-success">¡Horario eliminado con exito!</div>';
		}
		if ($eliminar == "error") {

			echo '<script>

			if ( window.history.replaceState ) {

				window.history.replaceState( null, null, window.location.href );

			}

			</script>';

			echo '<div class="alert alert-danger">¡<b>Error</b>,no s epudo eliminar el Horario!, intentalo de nuevo</div>';
		}
	}
	?>
	<div class="container-fluid dashboard-content ">
		<div class="container">
			<div class="card">
				<div class="card-body">
					<form method="POST">
						<div class="form-group">
							<p style="font-size: 26px;">Antes de continuar, por favor confirme que desea eliminar el horario seleccionado. Esta acción es ireversible, y puede afectar el funcionamiento de la organización. Si está seguro, haga clic en el botón "Eliminar". De lo contrario, haga clic en "Cancelar".</p>
						</div>
						<div class="row mt-5 rounded float-right">
							<div class="text-center">
								<input type="hidden" name="horario" value="<?php echo $_GET['eliminar']; ?>">
								<button type="submit" name="accion" class="btn btn-primary mr-1" value="eliminar">Eliminar</button>
							</div>
							<div class="text-center">
								<a href="Asistencia-ajustes" class="btn btn-danger mr-3">Cancelar</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php else: ?>
	<div class="container-fluid dashboard-content">
		<div class="container">
			<div class="card p-4">
				<form id="NewHorario-form">
					<div class="form-result"></div>
					<div class="row mb-2">
						<div class="col-7">
							<label class="col-form-label font-weight-light" for="nameHorario">Añadir un nombre</label>
							<input class="form-control" type="text" name="nameHorario" id="nameHorario" required>
						</div>
					</div>

					<div class="encabezado pt-4">Selecciona las horas por cada día laboral</div>
					<p class="ajustes-text"><i class="far fa-question-circle"></i> Añade todos los turnos por día para esta plantilla de horario de trabajo.</p>

					<div class="table-in">
						<div class="table-header row">
							<div class="col-1"></div>
							<div class="col-2">DÍAS</div>
							<div class="col-5">HORARIOS DE TRABAJO</div>
							<div class="col-4">HORAS ESPERADAS</div>
						</div>
						<div class="table-body">
							<?php foreach ($diaLaborableNombres as $key => $value): ?>
							<div class="row">
								<div class="col-1">
									<input type="checkbox" 
									name="dia" 
									id="<?php echo $value; ?>" 
									value="<?php echo $key; ?>" 
									onChange="activarDiv(this)">
								</div>
								<div class="col-2 <?php echo $activeClass ?>" id="dia<?php echo $key; ?>">
									<?php echo $value ?>
								</div>
								<div class="col-5" id="horarios<?php echo $key; ?>"></div>
								<div class="col-4" id="horasxdia<?php echo $key; ?>"></div>
							</div>
							<?php endforeach ?>
						</div>
					</div>

					<div class="card">
						<div class="card-footer p-0 text-center d-flex justify-content-center ">
							<div class="card-footer-item card-footer-item-bordered">
								<a href="Asistencia-ajustes" class="card-link btn btn-outline-secondary btn-block rounded">Cancelar</a>
							</div>
							<div class="card-footer-item card-footer-item-bordered">
								<button class="btn btn-primary btn-block guardar-horario" type="submit">Guardar</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<script>
		function activarDiv(checkbox) {
			var dia = checkbox.value;
			var diaElement = document.getElementById("dia" + dia);
			var horariosElement = document.getElementById("horarios" + dia);
			var horasxdiaElement = document.getElementById("horasxdia" + dia);
			var btnEnviar = document.getElementById("NewHorario-btn");

			if (checkbox.checked) {
				diaElement.classList.add("active");
				horariosElement.classList.add("active");
				horasxdiaElement.classList.add("active");

				horariosElement.innerHTML = "";

				var inputDia = document.createElement("input");
				inputDia.className = "form-control input-dia";
				inputDia.name = "Entrada" + dia;
				inputDia.type = "time";
				inputDia.addEventListener("input", function () {
					calcularHoras(dia);
				});

				var inputDia2 = document.createElement("input");
				inputDia2.className = "form-control input-dia";
				inputDia2.name = "Salida" + dia;
				inputDia2.type = "time";
				inputDia2.addEventListener("input", function () {
					calcularHoras(dia);
				});

				var entrada = document.createElement("div");
				var salida = document.createElement("div");
				var texto = document.createElement("div");

				entrada.className = "col-6";
				salida.className = "col-6";
				texto.className = "col";

				var newContent = document.createTextNode(" a ");

				entrada.appendChild(inputDia);
				salida.appendChild(inputDia2);
				texto.appendChild(newContent);

				var divDia = document.createElement("div");
				divDia.className = "row pt-1 pb-1 in-col";
				divDia.appendChild(entrada);
				divDia.appendChild(texto);
				divDia.appendChild(salida);
				horariosElement.appendChild(divDia);

				calcularHoras(dia);
			} else {
				diaElement.classList.remove("active");
				horariosElement.classList.remove("active");
				horasxdiaElement.classList.remove("active");

// Eliminar los elementos creados anteriormente
				horariosElement.innerHTML = "";

// Limpiar el contenido del elemento horasxdiaElement
				horasxdiaElement.textContent = "";
			}

			verificarCheckboxes();
		}

		function verificarCheckboxes() {
			var checkboxes = document.querySelectorAll("input[type='checkbox']");
			var btnEnviar = document.getElementById("NewHorario-btn");

			var todosDesactivados = true;

			for (var i = 0; i < checkboxes.length; i++) {
				if (checkboxes[i].checked) {
					todosDesactivados = false;
					break;
				}
			}

			if (todosDesactivados) {
				btnEnviar.classList.add("disabled");
			} else {
				btnEnviar.classList.remove("disabled");
			}
		}

		function calcularHoras(dia) {
			var horasxdia = document.getElementById("horasxdia" + dia);
			var inputs = document.querySelectorAll("#horarios" + dia + " input[type='time']");

			var entrada = inputs[0].value.split(":");
			var salida = inputs[1].value.split(":");

			var horaEntrada = parseInt(entrada[0]);
			var minutoEntrada = parseInt(entrada[1]);
			var horaSalida = parseInt(salida[0]);
			var minutoSalida = parseInt(salida[1]);

			var diferenciaHoras = horaSalida - horaEntrada;
			var diferenciaMinutos = minutoSalida - minutoEntrada;

			if (diferenciaMinutos < 0) {
				diferenciaHoras -= 1;
				diferenciaMinutos += 60;
			}
			if (isNaN(diferenciaHoras) || isNaN(diferenciaMinutos)) {
				diferenciaHoras = 0;
				diferenciaMinutos = 0;
			}

			horasxdia.textContent = diferenciaHoras + " horas " + diferenciaMinutos + " min";
		}

// Verificar checkboxes al cargar la página
		window.onload = function () {
			verificarCheckboxes();
		};

		$(document).ready(function() {
			$("#NewHorario-form").on("submit", function(e) {
				e.preventDefault();

				var diasSeleccionados = [];
				$("input[name='dia']:checked").each(function() {
					diasSeleccionados.push($(this).val());
				});

				var datosHorarios = {};

				diasSeleccionados.forEach(function(dia) {
					datosHorarios["Entrada" + dia] = $("#horarios" + dia + " input[name='Entrada" + dia + "']").val();
					datosHorarios["Salida" + dia] = $("#horarios" + dia + " input[name='Salida" + dia + "']").val();
				});

				$.ajax({
					type: "POST",
					url: "ajax/horarios.php",
					data: {
						nameHorario: $("#nameHorario").val(),
						dia: diasSeleccionados,
						horarios: datosHorarios
					},
					dataType: "json",
					success: function(response) {
						if (response === '"ok"' || response === 'ok') {
							$(".form-result").empty();
							$(".form-result").after(`
								<div class='alert alert-success'>Nuevo Horario Registrado</div>
								`);
							setTimeout(function() {
								location.href="Asistencia-ajustes";
							}, 500);
						}else{
							$(".form-result").val("");
							$(".form-result").parent().after(`
								<div class='alert alert-danger'><b>Error</b>, No se pudo registrar el horario, intenta nuevamente</div>
								`);
						}
					},
					error: function(xhr, status, error) {
						console.log(error);
					}
				});
			});
		});
	</script>

	<?php endif ?>