<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href='assets/vendor/full-calendar/css/fullcalendar.css' rel='stylesheet' />
<link href='assets/vendor/full-calendar/css/fullcalendar.print.css' rel='stylesheet' media='print' />
<link rel="stylesheet" href="assets/vendor/multi-select/css/multi-select.css">
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="card mx-5">
			<div class="card-header encabezado">Configuración del registro de horas</div>
			<div class="row">
				<div class="card-side-nav col-2 lista-ajustes">
					<div><a href="Asistencia-ajustes" class="btn btn-block btn-in-consulting-link">Horarios de trabajo</a></div>
					<div><a href="Asistencia-permisos" class="btn btn-block btn-in-consulting-link active">Permisos</a></div>
					<div><a href="Asistencia-importar" class="btn btn-block btn-in-consulting-link">Importar horarios</a></div>
					<div><a href="Asistencia-exportar" class="btn btn-block btn-in-consulting-link">Exportar resultados</a></div>
				</div>
				<div class="col-10" id="permisos">
					<div class="row mr-4 ml-2 mt-3">
						<div class="card-header encabezado">
							Permisos
							<div class="form-result"></div>
						</div>
						<div class="card-body">
							<h3 class="encabezado-h">Tipo de permisos y días festivos
								<button type="button"
												class="btn btn-in-consulting"
												data-toggle="modal" 
												data-target="#Festivo">
									<i class="fas fa-plus-circle"></i> <span>Crear día festivo</span>
								</button>
							</h3>
							<div class="row">
							<div class="col-10">
								<div class="card">
									<div class="card-body">
										<div id="festivos"></div>
									</div>
								</div>
							</div>
							<div class="col-2">
								<h3 class="encabezado-h">Días festivos</h3>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Eliminar postulante -->

	<div class="modal fade" id="Festivo">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<div class="modal-header">
					<h3 class="encabezado-h mt-2">Asignar día festivo</h3>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<form id="festivo-form">
					  <div class="row">
					    <div class="col-12 col-md-6">
					      <div class="form-group">
					        <label for="nameFestivo">Nombre del festivo</label>
					        <input type="text" class="form-control" id="nameFestivo" name="nameFestivo" required>
					      </div>
					    </div>
					    <div class="col-12 col-md-6">
					      <div class="form-group">
					        <label>¿Es puente?</label>
					        <div class="form-check">
					          <input type="checkbox" class="form-check-input" id="Puente" name="Puente">
					          <label class="form-check-label" for="Puente">Sí</label>
					        </div>
					      </div>
					    </div>
					    <div class="col-12" id="fechaFestivoContainer">
					      <div class="form-group">
					        <label for="fechaFestivo">Fecha del festivo</label>
					        <input type="date" class="form-control" id="fechaFestivo" name="fechaFestivo" required>
					      </div>
					    </div>
					    <div id="fechaFinContainer" class="col-6"></div>
					  </div>
					</form>

					<script>
					  $(document).ready(function() {
					    $("#Puente").change(function() {
					      if (this.checked) {
					        createFechaFinField();
					        adjustFechaFestivoContainer();
					      } else {
					        destroyFechaFinField();
					        resetFechaFestivoContainer();
					      }
					    });

					    function createFechaFinField() {
					      var fechaFinContainer = $("#fechaFinContainer");
					      fechaFinContainer.empty(); // Limpiar cualquier contenido existente

					      var fechaFinLabel = $("<label>", {
					        for: "fechaFin",
					        text: "Fecha final"
					      });

					      var fechaFinInput = $("<input>", {
					        type: "date",
					        class: "form-control",
					        id: "fechaFin",
					        name: "fechaFin",
					        required: true
					      });

					      fechaFinContainer.append(fechaFinLabel, fechaFinInput);
					    }

					    function destroyFechaFinField() {
					      $("#fechaFinContainer").empty();
					    }

					    function adjustFechaFestivoContainer() {
					      $("#fechaFestivoContainer").removeClass("col-12").addClass("col-6");
					    }

					    function resetFechaFestivoContainer() {
					      $("#fechaFestivoContainer").removeClass("col-6").addClass("col-12");
					    }
					  });
					</script>
						<!---->
					<div class="card">
						<div class="card-footer p-0 text-center d-flex justify-content-center ">
							<div class="card-footer-item card-footer-item-bordered">
								<button data-dismiss="modal" class="card-link btn btn-outline-secondary">Cancelar</button>
							</div>
							<div class="card-footer-item card-footer-item-bordered">
								<button type="button" id="festivo-btn" data-dismiss="modal" class="card-link btn btn-outline-primary">Enviar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<script>
	
	$(document).ready(function() {
		$("#festivo-btn").click(function() {
		var formData = $("#festivo-form").serialize(); // Obtener los datos del formulario

			$.ajax({
				url: "ajax/horarios.php", // Ruta al archivo PHP que procesará los datos del formulario
				type: "POST",
				data: formData,
				success: function(response) {

					if (response === '"ok"') {
						$("#form-result").val("");
						$("#form-result").parent().after(`
							<div class='alert alert-success' role="alert" id="alerta">Día festivo registrado</div>
							`);
							deleteAlert();
					}else{
						$("#form-result").val("");
						$("#form-result").parent().after(`
							<div class='alert alert-danger' role="alert" id="alerta"><b>Error</b>, no se creo el día festivo, intenta nuevamente</div>
							`);
							deleteAlert();
					}

				}
			});
		});
	});

function deleteAlert() {
  setTimeout(function() {
    var alert = $('#alerta');
    alert.fadeOut('slow', function() {
      alert.remove();
    });
  }, 1500);
}
</script>

<script src='assets/vendor/full-calendar/js/moment.min.js'></script>
<script src='assets/vendor/full-calendar/js/fullcalendar.js'></script>
<script src='assets/vendor/full-calendar/js/jquery-ui.min.js'></script>
<script src='assets/vendor/full-calendar/js/calendar.js'></script>