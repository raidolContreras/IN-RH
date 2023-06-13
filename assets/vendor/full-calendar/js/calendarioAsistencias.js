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
						        	if (calEvent.colorFondo === '#D52E2E' || calEvent.colorFondo === '#DCD25B' ) {
						        		
						        		var startDate = new Date(calEvent.start);
										var formattedStartDate = startDate.toISOString().slice(0, 10);

						        		if (calEvent.colorFondo === '#D52E2E') {
							            	$('#event-title').text('Justificación del Retardo: '+formattedStartDate);
							            	$('#hEntrada').html("Hora registrada: -");
							            	$('#hSalida').html("Hora registrada: -");
						        		}
						        		if (calEvent.colorFondo === '#DCD25B') {
							            	$('#event-title').text('Justificación de la Ausencia: '+formattedStartDate);
							            	$('#hEntrada').html("Hora registrada: "+calEvent.hEntrada);
							            	$('#hSalida').html("Hora registrada: "+calEvent.hSalida);
						        		}
							            $('#entrada').html("Hora Esperada: "+calEvent.entrada);
							            $('#salida').html("Hora Esperada: "+calEvent.salida);
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
							<div class='alert alert-success' role="alert" id="alerta">Jusificante enviado</div>
							`);
						deleteAlert();
					}else{
						$("#form-result").val("");
						$("#form-result").html(`
							<div class='alert alert-danger' role="alert" id="alerta"><b>Error</b>, No se pudo enviar el justificante, intenta nuevamente</div>
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