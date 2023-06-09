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
								            cell.css("background-color", data.datos[i].color);
								            break;
								        }
								    }
								},
						        eventClick: function (calEvent, jsEvent, view) {
						        	if (calEvent.color === '#E7E199' || calEvent.color === '#EF8B8B' ) {
						        		if (calEvent.color === '#E7E199') {
							            	$('#event-title').text('Justificación del Retardo');
							            	$('#hEntrada').html("Hora registrada: "+calEvent.hEntrada);
						        		}
						        		if (calEvent.color === '#EF8B8B') {
							            	$('#event-title').text('Justificación de la Ausencia');
							            	$('#hEntrada').html("Hora registrada: -");
						        		}
							            $('#entrada').html("Hora Esperada: "+calEvent.entrada);
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