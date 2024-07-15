$(document).ready(function() {
    var table = $('#dataTable').DataTable({
        
        "ordering": true,
        "order": [],
        "language": {
            "sLengthMenu":    "Mostrar _MENU_ registros",
            "sEmptyTable":    "Ningún dato disponible en esta tabla",
            "sEmptyTable":    "Ningún dato disponible en esta tabla",
            "sSearch":        "Buscar:",
        },
        "dom": '<"top"lf>rt<"bottom"Bp><"clear">',
        "buttons": [
            {   
                extend: 'collection',
                text: 'Exportar <i class="fa-solid fa-file-export"></i>',
                className: 'btn-exportar',
                buttons: [
                    { extend: 'copy', text: 'Copiar', className: 'btn-exportar-opcion' },
                    { extend: 'excel', text: 'Excel', className: 'btn-exportar-opcion' },
                    { extend: 'csv', text: 'CSV', className: 'btn-exportar-opcion' },
                    { extend: 'pdf', text: 'PDF', className: 'btn-exportar-opcion' }
                ]
            }
        ],
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        "columnDefs": [
            { "targets": 'no-export', "searchable": false, "orderable": false, "visible": false }
        ]
    });
});
