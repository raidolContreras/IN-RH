<?php if (!empty($rol) && $rol['Editar_Empleados'] == 1): ?>
<?php if (isset($_GET['perfil'])){
	$empleado = ControladorEmpleados::ctrVerEmpleados("idEmpleados", $_GET['perfil']);
	$puesto = ControladorFormularios::ctrVerPuestos("Empleados_idEmpleados", $_GET['perfil']);
	$horarios = ControladorFormularios::ctrSeleccionarHorarios(null, null);
	$Empleado_has_Horario = ControladorFormularios::ctrVerEmpleadosHorarios("Empleados_idEmpleados", $_GET['perfil']);
	$empresas = ControladorFormularios::ctrVerEmpresas(null,null);
	$departamento = ControladorFormularios::ctrVerDepartamentos("idDepartamentos", $puesto['Departamentos_idDepartamentos']);
	$empresaElegida = ControladorFormularios::ctrVerEmpresas("idEmpresas",$departamento['Empresas_idEmpresas']);

	$jefe = 0;
	if ($departamento['Empleados_idEmpleados'] == $_GET['perfil']) {
		$jefe = 1;
	}
}else{
	echo '<script>

	window.location = "Empleados";

	</script>';
}


// Leer el archivo JSON de estados
$estadosJson = file_get_contents('view/pages/json/estados.json');

// Leer el archivo JSON de ciudades
$ciudadesJson = file_get_contents('view/pages/json/ciudades.json');

// Convertir el JSON a un array asociativo
$estadosArray = json_decode($estadosJson, true);
$ciudadesArray = json_decode($ciudadesJson, true);

$parentesco = array("Padre" => "padre",
	"Madre" => "madre",
	"Hermano" => "hermano",
	"Amigo" => "amigo",
	"Pareja" => "pareja"); ?>
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

$registro = ControladorEmpleados::ctrActualizarEmpleado();

if($registro == "ok"){

	echo '<div class="alert alert-success">Se actualizo empleado</div>';
	echo '<script>

	setTimeout(function() {
		window.location = "Empleados";
		}, 500);
		</script>';

	}
	if ($registro == "1") {

		echo '<script>

		if ( window.history.replaceState ) {

			window.history.replaceState( null, null, window.location.href );

		}

		</script>';

		echo '<div class="alert alert-danger">Error, no se pudo actualizar, Error en los datos</div>';
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
						<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $empleado['name'] ?>" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="apellidos">Apellidos</label>
						<input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $empleado['lastname'] ?>" required>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="genero">Género</label>
						<select class="form-control" id="genero" name="genero" required>
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
				<div class="col-md-4">
					<div class="form-group">
						<label for="fecha_nacimiento">Fecha de nacimiento</label>
						<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $empleado['fNac'] ?>" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="num_identificacion">Número de identificación
							<a data-toggle="identificacion" title="Número de identificación" 
							data-content="Ejemplos: N° de INE, Pasaporte, etc."><i class="fas fa-info-circle"></i></a>
						</label>
						<input type="text" class="form-control" id="num_identificacion" name="num_identificacion" value="<?php echo $empleado['identificacion'] ?>" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="curp">CURP</label>
						<input type="text" class="form-control" id="curp" name="curp" value="<?php echo $empleado['CURP'] ?>" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="num_seguro_social">Número de Seguro Social</label>
						<input type="number" class="form-control" id="num_seguro_social" name="num_seguro_social" value="<?php echo $empleado['NSS'] ?>" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="rfc">RFC</label>
						<input type="text" class="form-control" id="rfc" name="rfc" value="<?php echo $empleado['RFC'] ?>" required>
					</div>
				</div>
			</div>
			<div class="form-group card p-3">
				<label for="direccion">Dirección</label>
				<div class="row">
					<div class="col-md-9">
						<input type="text" class="form-control" id="calle" name="calle" placeholder="Calle" value="<?php echo $empleado['street'] ?>" required>
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control" id="num_exterior" name="num_exterior" placeholder="Núm. Ext." value="<?php echo $empleado['numE'] ?>" required>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-md-3">
						<?php if ($empleado['numI'] != ''): ?>
							<input type="text" class="form-control" id="num_interior" name="num_interior" placeholder="Núm. Int." value="<?php echo $empleado['numI'] ?>">
						<?php else: ?>
							<input type="text" class="form-control" id="num_interior" name="num_interior" placeholder="Núm. Int.">
						<?php endif ?>
					</div>
					<div class="col-md-6">
						<input type="text" class="form-control" id="colonia" name="colonia" placeholder="Colonia" value="<?php echo $empleado['col'] ?>" required>
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control" id="cp" name="cp" placeholder="C.P." value="<?php echo $empleado['CP'] ?>" required>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-md-6">
						<select class="form-control" id="estado" name="estado" required>
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
						<select class="form-control" id="municipio" name="municipio" required>
							<option value="<?php echo $empleado['municipio'] ?>"><?php echo $empleado['municipio'] ?></option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col-md-6">	
					<div class="form-group">
						<label for="telefono">Teléfono</label>
						<input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo $empleado['phone'] ?>" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" value="<?php echo $empleado['email'] ?>" required>
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
						<input type="text" class="form-control" id="emergencia" name="emergencia" placeholder="Nombre" value="<?php echo $empleado['nameEmer'] ?>" required>
					</div>
				</div>
				<div class="col-md-6">	
					<div class="form-group">
						<label for="telefono">Teléfono de emergengia</label>
						<input type="tel" class="form-control" id="telefono" name="telefonoE" value="<?php echo $empleado['phoneEmer'] ?>" required>
					</div>
				</div>

				<div class="form-group col-md-6">
					<label for="parentesco" class="col-form-label text-center font-weight-bold">Parentesco:</label>
					<select class="form-control form-control-lg" id="parentesco" name="parentesco">
						<?php foreach ($parentesco as $key => $pariente): ?>
							<?php if ($empleado['parentesco'] == $pariente): ?>
								<option value="<?php echo $pariente; ?>" selected><?php echo $key; ?></option>
							<?php else: ?>
								<option value="<?php echo $pariente; ?>"><?php echo $key; ?></option>
							<?php endif ?>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<hr>
			<h3 class="hprofile">Datos del puesto</h3>
			<hr>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="namePuesto" class="col-form-label font-weight-bold">Nombre del puesto:</label>
						<input type="text" class="form-control" id="namePuesto" name="namePuesto" value="<?php echo $puesto['namePuesto']; ?>" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="salarioPuesto" class="col-form-label font-weight-bold">Salario:</label>
						<input type="text"	maxlength="10" class="form-control form-control-lg" id="salarioPuesto" name="salarioPuesto" pattern="[0-9]+(\.[0-9]{1,2})?" title="Ingrese un número con hasta dos decimales" required onkeypress="return (event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47)" min="1" value="<?php echo $puesto['salario'] ?>">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="salario_integrado" class="col-form-label font-weight-bold">Salario Diario Integrado:</label>
							<input type="text"	maxlength="10" class="form-control form-control-lg" id="salario_integrado" name="salario_integrado" pattern="[0-9]+(\.[0-9]{1,2})?" title="Ingrese un número con hasta dos decimales" required onkeypress="return (event.charCode >= 46 && event.charCode <= 57 && event.charCode != 47)" min="1" value="<?php echo $puesto['salario_integrado'] ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="salario_integrado" class="col-form-label font-weight-bold">Fecha de contratación:</label>
								<input type="date" name="fecha_contratado" id="fecha_contratado" class="form-control" max="<?php echo date('Y-m-d'); ?>" value="<?php echo $empleado['fecha_contratado']; ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="horarios" class="col-form-label font-weight-bold">Horario:</label>
								<select class="form-control" id="horarios" name="horarios">
									<?php foreach ($horarios as $horario): ?>
										<?php $selected = ($horario['idHorarios'] == $Empleado_has_Horario[0]['Horarios_idHorarios']) ? ' selected' : ''; ?>
										<option value="<?php echo $horario['idHorarios'] ?>"<?php echo $selected; ?>><?php echo $horario['nameHorario'] ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>

						<div class="form-group col-md-4">
							<label for="empresa" class="col-form-label font-weight-bold">Empresa:</label>
							<select class="form-control form-control-lg" id="empresa" name="empresa" required>
								<option>
									Seleccionar empresa
								</option>
								<?php foreach ($empresas as $empresa): ?>
									<?php if ($departamento['Empresas_idEmpresas'] == $empresa['idEmpresas']): ?>
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
							<select class="form-control form-control-lg" id="departamento" name="departamento">
								<option>Selecciona la empresa</option>
							</select>
						</div>
						<input type="hidden" name="empleado" value="<?php echo $_GET['perfil'] ?>">

						<div class="form-group col-md-4">
							<label for="asignarJefatura" class="col-form-label text-center font-weight-bold">¿Asignar Jefe?:</label>
							<div class="input-group-text" style="justify-content: center;">
								<?php if ($jefe == 1): ?>
									<input type="checkbox" checked name="asignarJefatura" id="asignarJefatura">
								<?php else: ?>
									<input type="checkbox" name="asignarJefatura" id="asignarJefatura">
								<?php endif ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary rounded btn-block" name="btn-update">Actualizar</button>
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
  var departament = document.getElementById('departamento');

  // Función para cargar los departamentos correspondientes a la empresa seleccionada
  function cargarDepartamentos(EmpresaActual,Depa) {
    $.ajax({
      url: "ajax/obtener.depas.empresas.php",
      type: "POST",
      data: { EmpresaActual: EmpresaActual, Departamento: Depa },
      success: function(response) {
        // Limpiar las opciones actuales del select de departamentos
        departament.innerHTML = '';

        // Agregar una opción predeterminada
        var opcionPredeterminada = document.createElement('option');
        opcionPredeterminada.text = 'Sin departamento';
        departament.add(opcionPredeterminada);

        // Agregar las opciones de departamentos correspondientes a la empresa seleccionada
        departament.innerHTML += response;
      }
    });
  }

  // Cargar los departamentos iniciales de la empresa seleccionada por defecto
  cargarDepartamentos(empresa.value, <?php echo $puesto['Departamentos_idDepartamentos'] ?>);

  // Cambiar los departamentos cuando se seleccione otra empresa
  $("#empresa").change(function() {
    var EmpresaActual = $(this).val();
    cargarDepartamentos(EmpresaActual,<?php echo $puesto['Departamentos_idDepartamentos']; ?>);
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

	function showAlert() {
		var alertContainer = document.getElementById('alertContainer');
		var alert = document.getElementById('alert');

		alertContainer.style.display = 'block';

		setTimeout(function () {
			alert.classList.add('show');
		}, 100);
	}

	function closeAlert() {
		var alertContainer = document.getElementById('alertContainer');
		var alert = document.getElementById('alert');

		alert.classList.remove('show');

		setTimeout(function () {
			alertContainer.style.display = 'none';
		}, 300);
	}


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
<?php else: ?>
	<script>
		window.location.href = 'Inicio';
	</script>
<?php endif ?>