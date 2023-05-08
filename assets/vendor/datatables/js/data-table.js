jQuery(document).ready(function($) {
    'use strict';

    if ($("table.second").length) {

        $(document).ready(function() {
            var table = $('table.second').DataTable({
                lengthChange: false,
                buttons: ['excel',
                    'pdf'
                    ],
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

    if ($("table.Postulantes").length) {

        $(document).ready(function() {
            var table = $('table.Postulantes').DataTable({
                lengthChange: false,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        customize: function( xlsx ) {
                            var sheet = xlsx.xl.worksheets['IN Consulting.xml'];
                            $('row:first c', sheet).attr( 's', '42' );
                        }
                    },
                    'pdf'
                    ],
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

    if ($("table.Puestos").length) {

        $(document).ready(function() {
            var table = $('table.Puestos').DataTable({
                lengthChange: false,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        customize: function( xlsx ) {
                            var sheet = xlsx.xl.worksheets['IN Consulting.xml'];
                            $('row:first c', sheet).attr( 's', '42' );
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        orientation: 'landscape'
                    }
                    ],
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


});
function createCellPos( n ){
    var ordA = 'A'.charCodeAt(0);
    var ordZ = 'Z'.charCodeAt(0);
    var len = ordZ - ordA + 1;
    var s = "";
 
    while( n >= 0 ) {
        s = String.fromCharCode(n % len + ordA) + s;
        n = Math.floor(n / len) - 1;
    }
 
    return s;
}