$(function() {
	"use strict"; 


$(document).ready(function() {
	// Obtener los días no laborables del servidor mediante AJAX
	$.ajax({
		url: 'ajax/fechasEmpleados.php',
		dataType: 'json',
		success: function(dataEmpleados) {
			// Obtener los días festivos del servidor mediante AJAX
			$.ajax({
				url: 'ajax/fechas.festivas.php',
				dataType: 'json',
				success: function(dataFestivos) {
					// Obtener los días de asistencias del servidor mediante AJAX
					$.ajax({
						url: 'ajax/fechas.asistencias.php',
						dataType: 'json',
						success: function(data) {
							// Combinar los datos de fechas empleados y festivos en una sola variable
							var allEvents = dataEmpleados.concat(dataFestivos.concat(data.datos));

							console.log(allEvents);
							// Configuración del calendario
							$('#horarios').fullCalendar({
								header: {
									left: 'title'
								},
								defaultView: 'month',
								navLinks: false,
								editable: false,
								eventLimit: true,
								showNonCurrentDates: false,
								businessHours: {
									dow: dataEmpleados // días de semana, 0=Domingo
								},
								dayRender: function(date, cell) {
								    var today = moment().startOf('day');
								    for (var i = 0; i < data.datos.length; i++) {
								        var eventStart = moment(data.datos[i].start, 'YYYY-MM-DD');
								        if (date.isSame(eventStart, 'day')) {
								            cell.css("background-color", data.datos[i].colorFondo);
								            break;
								        }
								    }
								},
						        eventClick: function (calEvent, jsEvent, view) {
						        	if (calEvent.colorFondo === '#EC5869' || calEvent.colorFondo === '#EF890C' ) {
						        		
						        		var startDate = new Date(calEvent.start);
										var formattedStartDate = startDate.toISOString().slice(0, 10);

						        		if (calEvent.colorFondo === '#EC5869') {
							            	$('#event-title').text('Justificación del Retardo: '+formattedStartDate);
							            	$('#hEntrada').html("Entrada registrada: -");
							            	$('#hSalida').html("Salida registrada: -");
						        		}
						        		if (calEvent.colorFondo === '#EF890C') {
							            	$('#event-title').text('Justificación de la Ausencia: '+formattedStartDate);
							            	$('#hEntrada').html("Entrada registrada: "+calEvent.hEntrada);
							            	$('#hSalida').html("Salida registrada: "+calEvent.hSalida);
						        		}
							            $('#entrada').html("Entrada Esperada: "+calEvent.entrada);
							            $('#salida').html("Salida Esperada: "+calEvent.salida);
							            $('#asistencia').val(calEvent.description);
							            $('#modal-event').modal();
							        }
						        },
								events: allEvents, // Pasar todos los eventos al calendario
							});
						},
						error: function(xhr, status, error) {
							console.error('Error en la solicitud AJAX de fechas de asistencias:', status, error);
						}
					});
				},
				error: function(xhr, status, error) {
					console.error('Error en la solicitud AJAX de fechas festivas:', status, error);
				}
			});
		},
		error: function(xhr, status, error) {
			console.error('Error en la solicitud AJAX de fechas de empleados:', status, error);
		}
	});
});




	 
	$(document).ready(function() {


		/* initialize the external events
		-----------------------------------------------------------------*/

		$('#external-events .fc-event').each(function() {

			// store data so the calendar knows to render an event upon drop
			$(this).data('event', {
				title: $.trim($(this).text()), // use the element's text as the event title
				stick: true // maintain when user navigates (see docs on the renderEvent method)
			});

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: false, // will cause the event to go back to its
				revertDuration: 0 //  original position after the drag
			});

		});


	});


 });


    	
	$(document).ready(function() {
		$("#asistencia-btn").click(function() {
		var formData = $("#asistencia-form").serialize(); // Obtener los datos del formulario

			$.ajax({
				url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
				type: "POST",
				data: formData,
				success: function(response) {

					if (response === '"ok"') {
						$("#form-result").val("");
						$("#form-result").html(`
							<div class='alert alert-success' role="alert" id="alerta">
							<i class="fas fa-check-circle"></i>
        			<strong class="mx-2">¡Éxito!</strong> 
								Jusificante enviado
							</div>
							`);
						deleteAlert();
						setTimeout(function() {
					    location.reload();
					  }, 1600);
					}else{
						$("#form-result").val("");
						$("#form-result").html(`
							<div class='alert alert-danger' role="alert" id="alerta">
								<i class="fas fa-exclamation-triangle"></i>
	        			<strong class="mx-2">Error!</strong> No se pudo enviar el justificante, intenta nuevamente
							</div>
							`);
							deleteAlert();
							setTimeout(function() {
						    location.reload();
						  }, 1600);
					}

				}
			});
		});
	});


	$(document).ready(function() {
		$("#exportarExcel-btn").click(function() {
		var formData = $("#exportarExcel-form").serialize(); // Obtener los datos del formulario

			$.ajax({
				url: "ajax/ajax.formularios.php", // Ruta al archivo PHP que procesará los datos del formulario
				type: "POST",
				data: formData,
				success: function(response) {

					if (response !== '"Error"') {
						var respuesta = response.replace(/"/g, '');
						$("#form-result").val("");
						$("#form-result").html(`
							<div class='alert alert-success' role="alert" id="alerta">
							<i class="fas fa-check-circle"></i>
        				<strong class="mx-2">¡Éxito!</strong>
							</div>
							`);

      			window.location.href = "view/Asistencias/"+respuesta+".xlsx";
						deleteAlert();
					}else{
						$("#form-result").val("");
						$("#form-result").html(`
							<div class='alert alert-danger' role="alert" id="alerta">
								<i class="fas fa-exclamation-triangle"></i>
	        			<strong class="mx-2">Error!</strong> No se pudo generar el Excel, intenta nuevamente
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
  }, 1500);
  
}