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

		$(document).ready(function(){
			var presente = "#ACE799";
			var retardo = "#E7E199";
			var ausencia = "#EF8B8B";
			$('#calendar3').fullCalendar({
				header: {
						right: 'prev,next today',
						left: 'title'
				},
				height: 740,
				
				defaultView: 'month',
				dayRender: function (date, cell) {
					var today = new Date();
					 if(date.format("YYYY-MM-DD") == "2023-06-01"){
						cell.css("background-color", presente);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-02"){
						cell.css("background-color", retardo);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-05"){
						cell.css("background-color", presente);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-06"){
						cell.css("background-color", ausencia);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-07"){
						cell.css("background-color", retardo);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-08"){
						cell.css("background-color", presente);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-09"){
						cell.css("background-color", ausencia);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-12"){
						cell.css("background-color", presente);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-13"){
						cell.css("background-color", presente);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-14"){
						cell.css("background-color", retardo);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-15"){
						cell.css("background-color", retardo);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-16"){
						cell.css("background-color", ausencia);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-19"){
						cell.css("background-color", presente);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-20"){
						cell.css("background-color", presente);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-21"){
						cell.css("background-color", retardo);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-22"){
						cell.css("background-color", presente);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-23"){
						cell.css("background-color", ausencia);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-26"){
						cell.css("background-color", presente);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-27"){
						cell.css("background-color", presente);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-28"){
						cell.css("background-color", retardo);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-29"){
						cell.css("background-color", presente);
					}
					 if(date.format("YYYY-MM-DD") == "2023-06-30"){
						cell.css("background-color", presente);
					}
				}
			})
		})
	
	 
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