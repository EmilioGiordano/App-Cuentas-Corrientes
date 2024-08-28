import Swal from 'sweetalert2';

document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('delete-button-general');
    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Evita el envío automático del formulario
        
        Swal.fire({
            title: '¿Está seguro?',
            html: '¿Está seguro de que desea eliminar este elemento?<br><span style="display:inline-block; margin-top: 5px;">Este cambio es irreversible y puede afectar otras tablas.</span>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); // Envía el formulario si el usuario confirma
            }
        });
    });
});
