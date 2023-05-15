<?php if (isset($_POST['Historial'])): ?>
<div class="container-fluid dashboard-content ">
<div class="container">
	<div class="card">
		<div class="card-body">
			<form method="POST">
				<input type="hidden" name="Historial" value="<?php echo $_POST['Historial']; ?>">
				<?php 

				/*=============================================
				FORMA EN QUE SE INSTANCIA LA CLASE DE UN MÉTODO ESTÁTICO 
				=============================================*/

				$registro = ControladorFormularios::ctrRegistrarHistorial($_POST['Historial']);

				if($registro == "otro"){

					echo '<div class="alert alert-success">¡Historial registrado!</div>';

				}
				if($registro == "terminar"){

					echo '<script>

					window.location = "Empleados";

					</script>';

					echo '<div class="alert alert-success">¡Historial registrado!</div>';

				}
				if ($registro == "error") {

					echo '<script>

					if ( window.history.replaceState ) {

						window.history.replaceState( null, null, window.location.href );

					}

					</script>';

					echo '<div class="alert alert-danger">Error, no se pudo registrar el historial, Error en los datos</div>';
				}

				?>
				<div class="form-group">
					<label for="empresa" class="col-form-label font-weight-bold">Empresa:</label>
					<input type="text" class="form-control" id="empresa" name="empresa" required>
				</div>
				<div class="form-group">
					<label for="puesto" class="col-form-label font-weight-bold">Puesto:</label>
					<input type="text" class="form-control" id="puesto" name="puesto" required>
				</div>
				<div class="form-group">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" id="noResponder" name="noResponder">
						<label class="form-check-label" for="noResponder">
							Prefiero no responder
						</label>
					</div>
				</div>
				<div class="form-group">
					<label for="salario" class="col-form-label font-weight-bold">Salario:</label>
					<input type="number" class="form-control" id="salario" name="salario" required>
				</div>
				<div class="form-group">
					<label for="fecha_inicio" class="col-form-label font-weight-bold">Fecha de inicio:</label>
					<input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
				</div>
				<div class="form-group">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" id="trabajo_actual" name="trabajo_actual">
						<label class="form-check-label" for="trabajo_actual">
							Actualmente trabaja ahí
						</label>
					</div>
				</div>
				<div class="form-group">
					<label for="fecha_fin" class="col-form-label font-weight-bold">Fecha de fin:</label>
					<input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
				</div>
				<div class="form-group">
					<label for="motivos" class="col-form-label font-weight-bold">Motivos de separación:</label>
					<textarea class="form-control" id="motivos" name="motivos" rows="5" required></textarea>
				</div>
				<div class="form-group">
					<label for="logros" class="col-form-label font-weight-bold">Logros:</label>
					<textarea class="form-control" id="logros" name="logros" rows="5"></textarea>
				</div>
				<div class="row mt-5 rounded float-right">
					<div class="text-center">
						<button type="submit" name="accion" class="btn btn-primary mr-1" value="otro">Enviar y Añadir otro</button>
					</div>
					<div class="text-center">
						<button type="submit" name="accion" class="btn btn-success mr-1" value="terminar">Enviar y terminar</button>
					</div>
					<div class="text-center">
						<a href="Empleados" class="btn btn-danger mr-3">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

	</div>
</div>
<script type="text/javascript">
	// Obtenemos los elementos del DOM
const trabajoActualInput = document.getElementById('trabajo_actual');
const fechaFinInput = document.getElementById('fecha_fin');
const motivos = document.getElementById('motivos');

const noResponder = document.getElementById('noResponder');
const salario = document.getElementById('salario');

// Función para bloquear/desbloquear el campo de fecha de fin
function toggleFechaFin() {
	if (trabajoActualInput.checked) {
		fechaFinInput.disabled = true;
		motivos.disabled = true;
	} else {
		fechaFinInput.disabled = false;
		motivos.disabled = false;
	}
}
// Función para bloquear/desbloquear el campo de salario
function toggleSalario() {
	if (noResponder.checked) {
		salario.disabled = true;
	} else {
		salario.disabled = false;
	}
}

// Manejador del evento de cambio del botón switch
trabajoActualInput.addEventListener('change', toggleFechaFin);
noResponder.addEventListener('change', toggleSalario);


// Llamamos a la función una vez al cargar la página para asegurarnos de que el campo de fecha de fin esté en el estado correcto
toggleFechaFin();
toggleSalario();

</script>
<?php else: ?>
<div class="container-fluid dashboard-content ">
	<div class="alert alert-danger">¡Selecciona un empleado antes de ingresar!</div>
	<div>
		<a class="btn btn-warning float-right" href="Empleados">Regresar</a>
	</div>
</div>
<?php endif ?>