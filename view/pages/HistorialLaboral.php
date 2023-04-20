<div class="container-fluid dashboard-content ">
	<!-- ============================================================== -->
	<!-- pageheader  -->
	<!-- ============================================================== -->
	<div class="row">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="page-header">
				<h2 class="pageheader-title">Registro Empleados</h2>
				<div class="page-breadcrumb">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="Inicio" class="breadcrumb-link">IN Consulting México</a></li>
							<li class="breadcrumb-item active" aria-current="page">Registro Empleados</li>
							<li class="breadcrumb-item active" aria-current="page">Información laboral</li>
							<li class="breadcrumb-item active" aria-current="page">Formación</li>
							<li class="breadcrumb-item active" aria-current="page">Historial laboral</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
<div class="container">
  <div class="card">
    <div class="card-body">
      <form>
        <div class="form-group">
          <label for="empresa" class="col-form-label font-weight-bold">Empresa:</label>
          <input type="text" class="form-control" id="empresa" name="empresa">
        </div>
        <div class="form-group">
          <label for="puesto" class="col-form-label font-weight-bold">Puesto:</label>
          <input type="text" class="form-control" id="puesto" name="puesto">
        </div>
        <div class="form-group">
          <label for="fecha_inicio" class="col-form-label font-weight-bold">Fecha de inicio:</label>
          <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
        </div>
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="trabajo_actual" name="trabajo_actual">
            <label class="form-check-label" for="trabajo_actual">
              Actualmente trabajo aquí
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="fecha_fin" class="col-form-label font-weight-bold">Fecha de fin:</label>
          <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
        </div>
        <div class="form-group">
          <label for="responsabilidades" class="col-form-label font-weight-bold">Responsabilidades:</label>
          <textarea class="form-control" id="responsabilidades" name="responsabilidades" rows="5"></textarea>
        </div>
        <div class="form-group">
          <label for="logros" class="col-form-label font-weight-bold">Logros:</label>
          <textarea class="form-control" id="logros" name="logros" rows="5"></textarea>
        </div>
        <div class="row mt-5 rounded float-right">
          <div class="text-center">
            <button type="submit" name="otro" class="btn btn-primary mr-1">Enviar y Añadir otro</button>
          </div>
          <div class="text-center">
            <button type="submit" name="terminar" class="btn btn-success mr-1">Enviar y terminar</button>
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

// Función para bloquear/desbloquear el campo de fecha de fin
function toggleFechaFin() {
  if (trabajoActualInput.checked) {
    fechaFinInput.disabled = true;
  } else {
    fechaFinInput.disabled = false;
  }
}

// Manejador del evento de cambio del botón switch
trabajoActualInput.addEventListener('change', toggleFechaFin);

// Llamamos a la función una vez al cargar la página para asegurarnos de que el campo de fecha de fin esté en el estado correcto
toggleFechaFin();

</script>