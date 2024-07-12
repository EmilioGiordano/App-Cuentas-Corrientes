$(document).ready(function(){
    $('#dataTable').DataTable({
        "ordering": true,
        "order": [],
        "language": {
            // ... configuración de idioma ...
        },
        "dom": '<"top"B>rt<"bottom"lp><"clear">',
        "buttons": [
            {
                extend: 'collection',
                text: 'Exportar <i class="fa-solid fa-file-export"></i>', // Utiliza el ícono en lugar del texto
                className: 'btn-exportar', // Clase personalizada
                buttons: [
                    { extend: 'copy', text: 'Copiar', className: 'btn-exportar-opcion' },
                    { extend: 'excel', text: 'Excel', className: 'btn-exportar-opcion' },
                    { extend: 'csv', text: 'CSV', className: 'btn-exportar-opcion' },
                    { extend: 'pdf', text: 'PDF', className: 'btn-exportar-opcion' }
                ]
            }
        ],
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "columnDefs": [
            { "targets": 'no-export', "searchable": false, "orderable": false, "visible": false }
        ]
    });
    });