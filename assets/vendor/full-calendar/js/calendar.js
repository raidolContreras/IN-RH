$(function() {
    "use strict"; 

    $(document).ready(function() {

        $('#calendar1').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title'
            },
            defaultDate: new Date(),
            navLinks: false, // can click day/week names to navigate views
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            events: [{
                    title: 'Reunión Mayel',
                    start: '2023-05-07 11:00:00',
                    backgroundColor: '#cc25ac5',
                    borderColor: '#cc25ac5'
                },
                {
                    id: 999,
                    title: 'Reunión Prueba',
                    start: '2023-05-09T16:00:00',
                    backgroundColor: '#ffc108',
                    borderColor: '#ffc108'

                }
            ]
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


        /* initialize the calendar
        -----------------------------------------------------------------*/

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            }
        });


    });


 });