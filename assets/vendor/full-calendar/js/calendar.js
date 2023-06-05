$(function() {
	"use strict"; 

	$(document).ready(function() {

		// Hacemos una solicitud AJAX al archivo PHP para obtener los datos de fecha
		$.ajax({
			url: 'ajax/obtener.fechas.php',
			dataType: 'json'
		}).done(function(data) {

			// Inicializamos el calendario con los eventos
			$('#calendar1').fullCalendar({
				header: {
						left: 'prev,next today',
						center: 'title'
				},
				defaultDate: new Date(),
				navLinks: false, // can click day/week names to navigate views
				editable: false,
				eventLimit: true, // allow "more" link when too many events
				events: data // Pasamos los eventos al calendario
			});

			// Inicializamos el calendario con los eventos
			$('#calendar2').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title'
				},
				defaultDate: new Date(),
				navLinks: false, // can click day/week names to navigate views
				editable: false,
				eventLimit: true, // allow "more" link when too many events
				events: data // Pasamos los eventos al calendario
			});

		}).fail(function(jqXHR, textStatus, errorThrown) {
				console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
		});
	});
		
	$(document).ready(function() {
		// Hacemos una solicitud AJAX al archivo PHP para obtener los datos de fecha
		$.ajax({
			url: 'ajax/fechas.festivas.php',
			dataType: 'json'
		}).done(function(data) {
			$('#festivos').fullCalendar({
				header: {
					left: 'title'
				},
				defaultView: 'month',
				navLinks: false,
				editable: false,
				eventLimit: true,
				dayRender: function(date, cell) {
					var today = new Date();
					// Recorremos los eventos y verificamos si la fecha está entre el inicio y el fin (si existe)
					for (var i = 0; i < data.length; i++) {
						var eventStart = moment(data[i].start).format("YYYY-MM-DD");
						var eventEnd = data[i].end ? moment(data[i].end).format("YYYY-MM-DD") : eventStart;
						if (date.isBetween(eventStart, eventEnd, 'day', '[]')) {
							cell.css("background-color", "#BABABA");
							break; // Si encontramos una coincidencia, salimos del bucle
						}
					}
				},
				events: data // Pasamos los eventos al calendario
			});
		}).fail(function(jqXHR, textStatus, errorThrown) {
			console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
		});
	});

$(document).ready(function() {
	// Obtener los días no laborables del servidor mediante AJAX
	$.ajax({
		url: 'ajax/fechasEmpleados.php',
		dataType: 'json',
		success: function(data) {
			// Configuración del calendario
			$('#calendar3').fullCalendar({
				header: {
						left: 'title'
				},
				defaultView: 'month',
				navLinks: false,
				editable: false,
				eventLimit: true,
				
				businessHours: {
					dow: data // dias de semana, 0=Domingo
				},
				dayClick: function(date, jsEvent, view) {
					$("#hora_seleccionada").html(date.format("MM/DD/YYYY, h:mm:ss"));
				}
			});
		},
		error: function(xhr, status, error) {
				console.error('Error en la solicitud AJAX:', status, error);
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