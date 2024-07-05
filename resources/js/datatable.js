$(document).ready(function(){
    $('#dataTable').DataTable({
        "ordering": true,
        "order": [],
        "language": {
            // ... configuración de idioma ...
        },
        "dom": 'Blfrtip',
        "buttons": [
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':not(.no-export)' // Excluye las columnas con la clase 'no-export'
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':not(.no-export)'
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':not(.no-export)'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':not(.no-export)'
                }
            }
           
        ],
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "columnDefs": [
            { "targets": 'no-export', "searchable": false, "orderable": false, "visible": false }
        ]
    });
});