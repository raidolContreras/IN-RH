<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="assets/vendor/bootstrap-colorpicker/%40claviska/jquery-minicolors/jquery.minicolors.css" rel="stylesheet">
<?php $permisos = ControladorFormularios::ctrVerPermisos(null,null); ?>
<style>
<?php foreach ($permisos as $permiso): ?>
	
.badge-<?php echo strtr($permiso['namePermisos'], " ", "-"); ?> {
	background-color: <?php echo $permiso['colorPermisos']; ?>;
}
	
<?php endforeach ?>
	
</style>
<div class="container-fluid dashboard-content">
	<div class="ecommerce-widget">
		<div class="card mx-5">
			<div class="card-header encabezado">Configuración del registro de horas</div>
			<div class="row">
				<div class="card-side-nav col-xl-2 col-lg-3 col-md-4 col-sm-4 col-3 lista-ajustes">
					<div><a href="Asistencia-ajustes" class="btn btn-block btn-in-consulting-link">Horarios de trabajo</a></div>
					<div><a href="Asistencia-permisos" class="btn btn-block btn-in-consulting-link active">Permisos</a></div>
					<div><a href="Asistencia-importar" class="btn btn-block btn-in-consulting-link">Importar horarios</a></div>
				</div>
				<div class=" col-xl-10 col-lg-9 col-md-8 col-sm-8 col-9" id="permisos">
					<div class="row mr-4 ml-2 mt-3">
						<div class="card-header encabezado">
							Permisos
							<div class="form-result"></div>
						</div>
						<div class="card-body">
							<h3 class="encabezado-h">Tipo de permisos y días festivos
							</h3>
							<div class="row">
								<div class="col-8">
									<div class="card">
										<div class="card-body">
											<?php include "Calendarios/calendario-permisos.php" ?>
										</div>
									</div>
								</div>
								<div class="col-2">
									<h3 class="encabezado-h">Días festivos
								<button type="button"
												class="btn btn-in-consulting"
												data-toggle="modal" 
												data-target="#Festivo">
									<i class="fas fa-plus-circle"></i>
								</button></h3>
									<div id="d-fest"></div>
								</div>
								<div class="col-2">
									<h3 class="encabezado-h">Permisos
								<button type="button"
												class="btn btn-in-consulting"
												data-toggle="modal" 
												data-target="#Permisos">
									<i class="fas fa-plus-circle"></i>
								</button></h3>
									<?php foreach ($permisos as $permiso): ?>
									<div class="festivo">
										<span class="mr-2 title">
											<span class="badge-dot badge-<?php echo strtr($permiso['namePermisos'], " ", "-"); ?>">
											</span>
											<?php echo $permiso['namePermisos'] ?>
										</span>
									</div>
									<?php endforeach ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

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
						setTimeout('document.location.reload()',800);
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

	$(document).ready(function() {
// Hacemos una solicitud AJAX al archivo PHP para obtener los datos de fecha
		$.ajax({
			url: 'ajax/fechas.festivas.php',
			dataType: 'json'
		}).done(function(data) {
// Creamos una variable para almacenar el contenido de las fechas festivas
			var fechasFestivas = '';

// Recorremos los eventos y creamos una cadena con los datos de las fechas
			for (var i = 0; i < data.length; i++) {
				var festivo = data[i];
				var title = festivo.title;
				var start = moment(festivo.start).format("DD/MM/YYYY");
				var end = festivo.end ? ' - ' + moment(festivo.end).format("DD/MM/YYYY") : '';

				fechasFestivas += '<div class="festivo">';
				fechasFestivas += '<p class="title">' + title + '</p>';
				fechasFestivas += '<p class="date">' + start + end + '</p>';
				fechasFestivas += '</div>';
			}

// Insertamos el contenido de las fechas festivas en el elemento div
			$('#d-fest').html(fechasFestivas);
		}).fail(function(jqXHR, textStatus, errorThrown) {
			console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
		});
	});


	$(document).ready(function() {
		$("#permiso-btn").click(function() {
			var formData = $("#permiso-form").serialize(); // Obtener los datos del formulario

			$.ajax({
				url: "ajax/horarios.php", // Ruta al archivo PHP que procesará los datos del formulario
				type: "POST",
				data: formData,
				success: function(response) {

					if (response === '"ok"') {
						$("#form-result").val("");
						$("#form-result").parent().after(`
							<div class='alert alert-success' role="alert" id="alerta">Permiso registrado</div>
							`);
						setTimeout('document.location.reload()',800);
						deleteAlert();
					}else{
						$("#form-result").val("");
						$("#form-result").parent().after(`
							<div class='alert alert-danger' role="alert" id="alerta"><b>Error</b>, no se creo el permiso, intenta nuevamente</div>
							`);
						deleteAlert();
					}

				}
			});

		});
	});
</script>
	<div class="modal fade" id="Permisos">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<div class="modal-header">
					<h3 class="encabezado-h mt-2">Crear permisos</h3>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<form id="permiso-form">
					  <div class="row">
					    <div class="col-12 col-md-6">
					      <div class="form-group">
					        <label for="namePermiso">Nombre del permiso</label>
					        <input type="text" class="form-control" id="namePermiso" name="namePermiso" required>
					      </div>
					    </div>
					    <div class="col-12 col-md-6">
					        <label for="colorPermiso">Color</label>

					        <div class="minicolors minicolors-theme-bootstrap minicolors-position-bottom minicolors-position-left">
					        	<input type="hidden" id="colorPermiso" name="colorPermiso" class="demo minicolors-input" value="#4DFF00" size="7">
					        <span class="minicolors-swatch minicolors-sprite minicolors-input-swatch">
					        	<span class="minicolors-swatch-color" style="background-color: rgb(222, 222, 222); opacity: 1;">
						        </span>
						    </span>
					        <div class="minicolors-panel minicolors-slider-hue" style="display: none;">
					        	<div class="minicolors-slider minicolors-sprite">
						        	<div class="minicolors-picker" style="top: 136.709px;"></div>
							    </div>
						        <div class="minicolors-opacity-slider minicolors-sprite">
						        	<div class="minicolors-picker"></div>
							    </div>
						        <div class="minicolors-grid minicolors-sprite" style="background-color: rgb(255, 136, 0);">
						        	<div class="minicolors-grid-inner"></div>
							        <div class="minicolors-picker" style="top: 19px; left: 0px;">
							        	<div></div>
								    </div>
							    </div>
						    </div>
					    </div>
					    </div>
					  </div>
					</form>
						<!---->
					<div class="card">
						<div class="card-footer p-0 text-center d-flex justify-content-center ">
							<div class="card-footer-item card-footer-item-bordered">
								<button data-dismiss="modal" class="card-link btn btn-outline-secondary">Cancelar</button>
							</div>
							<div class="card-footer-item card-footer-item-bordered">
								<button type="button" id="permiso-btn" data-dismiss="modal" class="card-link btn btn-outline-primary">Enviar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/vendor/bootstrap-colorpicker/jquery-asColor/dist/jquery-asColor.min.js"></script>
	<script src="assets/vendor/bootstrap-colorpicker/jquery-asGradient/dist/jquery-asGradient.js"></script>
	<script src="assets/vendor/bootstrap-colorpicker/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
	<script src="assets/vendor/bootstrap-colorpicker/%40claviska/jquery-minicolors/jquery.minicolors.min.js"></script>
	<script>
    $('.demo').each(function() {
        //
        // Dear reader, it's actually very easy to initialize MiniColors. For example:
        //
        //  $(selector).minicolors();
        //
        // The way I've done it below is just for the demo, so don't get confused
        // by it. Also, data- attributes aren't supported at this time...they're
        // only used for this demo.
        //
        $(this).minicolors({
            control: $(this).attr('data-control') || 'hue',
            defaultValue: $(this).attr('data-defaultValue') || '',
            format: $(this).attr('data-format') || 'hex',
            keywords: $(this).attr('data-keywords') || '',
            inline: $(this).attr('data-inline') === 'true',
            letterCase: $(this).attr('data-letterCase') || 'lowercase',
            opacity: $(this).attr('data-opacity'),
            position: $(this).attr('data-position') || 'bottom left',
            swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
            change: function(value, opacity) {
                if (!value) return;
                if (opacity) value += ', ' + opacity;
                if (typeof console === 'object') {
                    console.log(value);
                }
            },
            theme: 'bootstrap'
        });

    });
    </script>