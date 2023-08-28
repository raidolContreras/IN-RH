
$(document).ready(function() {
  $("#solicitud-permiso-btn").click(function() {
		var formData = $("#solicitud-permiso-form").serialize(); // Obtener los datos del formulario

		$.ajax({
		  url: "ajax/ajax.formularios.php",
		  type: "POST",
		  data: formData,
		  success: function(response) {
		  	switch (response) {
				  case '"ok"':
					  $("#form-result").html(`
							<div class='alert alert-success' role="alert" id="alerta">
							  <i class="fas fa-check-circle"></i>
							  <strong class="mx-2">¡Éxito!</strong>
							</div>
					  `);
					  deleteAlert();
					  if ( window.history.replaceState ) {

							window.history.replaceState( null, null, window.location.href );

					  }
					  setTimeout(function() {
							window.location.href = 'Asistencia-permisos-vacaciones';
					  }, 1600); 
						break;
				  case '"vacaciones generadas"':
					  $("#form-result").html(`
							<div class='alert alert-success' role="alert" id="alerta">
							  <i class="fas fa-check-circle"></i>
							  <strong class="mx-2">¡Éxito!</strong> Vacaciones solicitadas.
							</div>
					  `);
					  deleteAlert();
					  if ( window.history.replaceState ) {

							window.history.replaceState( null, null, window.location.href );

					  }
					  setTimeout(function() {
							window.location.href = 'Asistencia-permisos-vacaciones';
					  }, 1600);  
						break;
				  case '"error fecha"':
					  $("#form-result").html(`
							<div class='alert alert-danger' role="alert" id="alerta">
							  <i class="fas fa-exclamation-triangle"></i>
							  <strong class="mx-2">¡Error!</strong> La fecha de finalización debe ser igual o posterior a la fecha de inicio.
							</div>
					  `);
					  deleteAlert();
					  if ( window.history.replaceState ) {

							window.history.replaceState( null, null, window.location.href );

					  }
						break;
				  case '"dias"':
						$("#form-result").html(`
							<div class='alert alert-warning' role="alert" id="alerta">
								<i class="fas fa-exclamation-triangle"></i>
								<strong class="mx-2">¡Error!</strong> Los días solicitados son más que tus días disponibles, verifica de nuevo
							</div>
						`);
						deleteAlert();
						break;
				  default:
					  $("#form-result").html(`
							<div class='alert alert-danger' role="alert" id="alerta">
							  <i class="fas fa-exclamation-triangle"></i>
							  <strong class="mx-2">Error!</strong> No se pudo generar la solicitud, intenta nuevamente
							</div>
					  `);
					  deleteAlert();
				}
		  }
		});
  });
});

$(document).ready(function() {
  $("#solicitud-eliminar-btn").click(function() {
		var formData = $("#solicitud-eliminar-form").serialize(); // Obtener los datos del formulario

		$.ajax({
		  url: "ajax/ajax.formularios.php",
		  type: "POST",
		  data: formData,
		  success: function(response) {
				if (response === '"eliminado"') {
				  $("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
						  <i class="fas fa-check-circle"></i>
						  <strong class="mx-2">¡Éxito!</strong>
						</div>
				  `);
				  deleteAlert();
				  if ( window.history.replaceState ) {

						window.history.replaceState( null, null, window.location.href );

				  }
				  setTimeout(function() {
						window.location.reload();
				  }, 1600);
				} else {
				  $("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
						  <i class="fas fa-exclamation-triangle"></i>
						  <strong class="mx-2">Error!</strong> No se pudo eliminar la solicitud, intenta nuevamente
						</div>
				  `);
				  deleteAlert();
				}
		  }
		});
  });
});

$(document).ready(function() {
  $("#solicitud-eliminarV-btn").click(function() {
		var formData = $("#solicitud-eliminarV-form").serialize(); // Obtener los datos del formulario

		$.ajax({
		  url: "ajax/ajax.formularios.php",
		  type: "POST",
		  data: formData,
		  success: function(response) {
				if (response === '"eliminado"') {
				  $("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
						  <i class="fas fa-check-circle"></i>
						  <strong class="mx-2">¡Éxito!</strong>
						</div>
				  `);
				  deleteAlert();
				  if ( window.history.replaceState ) {

						window.history.replaceState( null, null, window.location.href );

				  }
				  setTimeout(function() {
						window.location.reload();
				  }, 1600);
				} else {
				  $("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
						  <i class="fas fa-exclamation-triangle"></i>
						  <strong class="mx-2">Error!</strong> No se pudo eliminar la solicitud de Vacaciones, intenta nuevamente
						</div>
				  `);
				  deleteAlert();
				}
		  }
		});
  });
});

$(document).ready(function() {
  $("#solicitud-eliminarI-btn").click(function() {
		var formData = $("#solicitud-eliminarI-form").serialize(); // Obtener los datos del formulario

		$.ajax({
		  url: "ajax/ajax.formularios.php",
		  type: "POST",
		  data: formData,
		  success: function(response) {
				if (response === 'ok') {
				  $("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
						  <i class="fas fa-check-circle"></i>
						  <strong class="mx-2">¡Éxito!</strong>
						</div>
				  `);
				  deleteAlert();
				  if ( window.history.replaceState ) {

						window.history.replaceState( null, null, window.location.href );

				  }
				  setTimeout(function() {
						window.location.reload();
				  }, 1600);
				} else {
				  $("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
						  <i class="fas fa-exclamation-triangle"></i>
						  <strong class="mx-2">Error!</strong> No se pudo ocultar la incapacidad, intenta nuevamente
						</div>
				  `);
				  deleteAlert();
				}
		  }
		});
  });
});

$(document).ready(function() {
  $("#incapacidad-permiso-btn").click(function() {
		var formData = $("#incapacidad-permiso-form").serialize(); // Obtener los datos del formulario

		$.ajax({
		  url: "ajax/ajax.formularios.php",
		  type: "POST",
		  data: formData,
		  success: function(response) {
				if (response === 'ok') {
				  $("#form-result").html(`
						<div class='alert alert-success' role="alert" id="alerta">
						  <i class="fas fa-check-circle"></i>
						  <strong class="mx-2">¡Incapacidad creada con éxito!</strong>
						</div>
				  `);
				  deleteAlert();
				  if ( window.history.replaceState ) {

						window.history.replaceState( null, null, window.location.href );

				  }
				  setTimeout(function() {
						window.location.reload();
				  }, 1600);
				} else {
				  $("#form-result").html(`
						<div class='alert alert-danger' role="alert" id="alerta">
						  <i class="fas fa-exclamation-triangle"></i>
						  <strong class="mx-2">Error!</strong> No se pudo crear la incapacidad, intenta nuevamente
						</div>
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
  }, 1800);
  
}
  // Obtener referencias a los elementos del formulario
  var fechaPermisoInput = document.getElementById('fechaPermiso');
  var fechaFinInput = document.getElementById('fechaFin');

  // Agregar evento de cambio al campo de fecha "fechaPermiso"
  fechaPermisoInput.addEventListener('change', function() {
		// Obtener la fecha seleccionada en "fechaPermiso"
		var fechaPermiso = new Date(fechaPermisoInput.value);

		// Activar el campo de fecha "fechaFin"
		fechaFinInput.disabled = false;

		// Establecer el atributo "min" del campo de fecha "fechaFin" como la fecha seleccionada en "fechaPermiso"
		fechaFinInput.min = fechaPermisoInput.value;
  });

  // Agregar evento de cambio al campo de fecha "fechaFin"
  fechaFinInput.addEventListener('change', function() {
		// Obtener la fecha seleccionada en "fechaFin"
		var fechaFin = new Date(fechaFinInput.value);

		// Obtener la fecha seleccionada en "fechaPermiso"
		var fechaPermiso = new Date(fechaPermisoInput.value);

		// Verificar si la fecha en "fechaFin" es menor que la fecha en "fechaPermiso"
		if (fechaFin < fechaPermiso) {
		  alert('La fecha de finalización debe ser igual o posterior a la fecha de inicio.');
		  fechaFinInput.value = fechaPermisoInput.value; // Restablecer la fecha en "fechaFin" a la fecha en "fechaPermiso"
		}
  });

$('#permiso').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var recipient = button.data('whatever');
  var name = button.data('name');

  var modal = $(this);
  modal.find('#id').val(recipient);

  var tituloElement = modal.find('#titulo');
  var description = modal.find('#description');
  tituloElement.empty(); // Vaciar el contenido anterior
  tituloElement.append('<span class="badge-dot"></span>');
  tituloElement.append(name);

  modal.find('.badge-dot').addClass('badge-' + name);
  if (name === 'Vacaciones') {
		description.hide();
  } else {
		description.show();
  }
});

$('#eliminar').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var recipient = button.data('whatever');
  var name = button.data('name');

  var modal = $(this);
  modal.find('#eliminarSolicitud').val(recipient);

  var tituloElement = modal.find('#titulo');
  tituloElement.empty(); // Vaciar el contenido anterior
  tituloElement.append(name);
});

$('#eliminarV').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var recipient = button.data('whatever');
  var name = button.data('name');

  var modal = $(this);
  modal.find('#eliminarVSolicitud').val(recipient);

  var tituloElement = modal.find('#tituloV');
  tituloElement.empty(); // Vaciar el contenido anterior
  tituloElement.append(name);
});

$('#eliminarI').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var recipient = button.data('whatever');
  var name = button.data('name');

  var modal = $(this);
  modal.find('#eliminarISolicitud').val(recipient);

  var tituloElement = modal.find('#tituloI');
  tituloElement.empty(); // Vaciar el contenido anterior
  tituloElement.append(name);
});