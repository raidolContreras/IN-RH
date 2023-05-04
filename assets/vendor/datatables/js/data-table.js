jQuery(document).ready(function($) {
    'use strict';

    if ($("table.first").length) {

        $(document).ready(function() {
            $('table.first').DataTable();
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
            }
        });
    }

if ($("table.second").length) {

    $(document).ready(function() {
        var table = $('table.second').DataTable({
            lengthChange: false,
            buttons: ['excel', 'pdf'],
            fixedHeader: true,
            scrollY: 375,
            stateSave: true,
            select: true,
        language: {
            lengthMenu: 'Mostrar _MENU_ resultados por pagina',
            zeroRecords: 'Sin resultados - lo siento',
            info: 'Pagina _PAGE_ de _PAGES_',
            infoEmpty: 'No se encontraron registros',
            infoFiltered: '(Filtrado de _MAX_ registros totales)',
            search: 'Buscar',
        }
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    });
}

    if ($("#example2").length) {

        $(document).ready(function() {
            $(document).ready(function() {
                var groupColumn = 2;
                var table = $('#example2').DataTable({
                    "columnDefs": [
                        { "visible": false, "targets": groupColumn }
                    ],
                    "order": [
                        [groupColumn, 'asc']
                    ],
                    "displayLength": 25,
                    "drawCallback": function(settings) {
                        var api = this.api();
                        var rows = api.rows({ page: 'current' }).nodes();
                        var last = null;

                        api.column(groupColumn, { page: 'current' }).data().each(function(group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before(
                                    '<tr class="group"><td colspan="5">' + group + '</td></tr>'
                                );

                                last = group;
                            }
                        });
                    }
                });

                // Order by the grouping
                $('#example2 tbody').on('click', 'tr.group', function() {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                        table.order([groupColumn, 'desc']).draw();
                    } else {
                        table.order([groupColumn, 'asc']).draw();
                    }
                });
            });
        });
    }

    if ($("#example3").length) {

        $('#example3').DataTable({
            select: {
                style: 'multi'
            }
        });

    }
    if ($("#example4").length) {

        $(document).ready(function() {
            var table = $('#example4').DataTable({
                fixedHeader: true
            });
        });
    }

});