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
                locale: 'es',
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