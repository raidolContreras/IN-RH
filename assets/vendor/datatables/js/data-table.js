jQuery(document).ready(function($) {
    'use strict';

    if ($("table.second").length) {

        $(document).ready(function() {
            var table = $('table.second').DataTable({
                lengthChange: false,
                scrollCollapse: true,
                paging: true,
                scrollY: 350,
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Exportar a Excel',
                        className: 'btn btn-outline-success rounded',
                        customize: function( xlsx ) {
                            var sheet = xlsx.xl.worksheets['Datos.xml'];
                            $('row:first c', sheet).attr( 's', '42' );
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Exportar a PDF',
                        className: 'btn btn-outline-danger rounded',
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    }
                    ],
                fixedHeader: true,
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

    if ($("table.depto").length) {

        $(document).ready(function() {
            var table = $('table.depto').DataTable({
                dom: 'Bfrtip',
                lengthChange: false,
                "ordering": false,
                scrollY: 350,
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Exportar a Excel',
                        className: 'btn btn-outline-success rounded',
                        customize: function( xlsx ) {
                            var sheet = xlsx.xl.worksheets['Datos.xml'];
                            $('row:first c', sheet).attr( 's', '42' );
                        },
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Exportar a PDF',
                        className: 'btn btn-outline-danger rounded',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    }
                ],
                fixedHeader: true,
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
                scrollY: 350,
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Exportar a Excel',
                        className: 'btn btn-outline-success rounded',
                        customize: function( xlsx ) {
                            var sheet = xlsx.xl.worksheets['Postulantes.xml'];
                            $('row:first c', sheet).attr( 's', '42' );
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Exportar a PDF',
                        className: 'btn btn-outline-danger rounded',
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    }
                    ],
                fixedHeader: true,
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
                scrollY: 350,
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Exportar a Excel',
                        className: 'btn btn-outline-success rounded',
                        customize: function( xlsx ) {
                            var sheet = xlsx.xl.worksheets['IN Consulting.xml'];
                            $('row:first c', sheet).attr( 's', '42' );
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Exportar a PDF',
                        className: 'btn btn-outline-danger rounded',
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    }
                    ],
                fixedHeader: false,
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

    if ($("table.Extras").length) {

        $(document).ready(function() {
            var table = $('table.Extras').DataTable({
                lengthChange: false,
                fixedHeader: true,
                stateSave: true,
                scrollY: 350,
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

    if ($("table.Peticiones").length) {

        $(document).ready(function() {
            var table = $('table.Peticiones').DataTable({
                lengthChange: false,
                fixedHeader: false,
                ordering: false,
                scrollY: 350,
            language: {
                lengthMenu: 'Mostrar _MENU_ resultados por pagina',
                zeroRecords: 'Parece que no hay ninguna solicitud en el tablero.',
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

    if ($("table.ResumenAsistencias").length) {

        $(document).ready(function() {
            var table = $('table.ResumenAsistencias').DataTable({
                lengthChange: false,
                fixedHeader: false,
                ordering: false,
                scrollY: 350,
            language: {
                lengthMenu: 'Mostrar _MENU_ resultados por pagina',
                zeroRecords: 'Parece que no hay ninguna solicitud en el tablero.',
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

    if ($("table.examenes").length) {

        $(document).ready(function() {
            var table = $('table.examenes').DataTable({
                lengthChange: false,
                fixedHeader: false,
                ordering: false,
                scrollY: 350,
            language: {
                lengthMenu: 'Mostrar _MENU_ resultados por pagina',
                zeroRecords: 'Parece que no hay ninguna solicitud en el tablero.',
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

    if ($("table.examenes_empleados").length) {

        $(document).ready(function() {
            var table = $('table.examenes_empleados').DataTable({
                lengthChange: false,
                scrollCollapse: true,
                paging: false,
                fixedHeader: true,
                fixedColumns: true,
                scrollY: 350,
                fixedHeader: true,
            language: {
                lengthMenu: 'Mostrar _MENU_ resultados por pagina',
                zeroRecords: 'Sin resultados - lo siento',
                info: 'Pagina _PAGE_ de _PAGES_',
                infoEmpty: 'No se encontraron registros',
                infoFiltered: '(Filtrado de _MAX_ registros totales)',
                search: 'Buscar',
            }
            });
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