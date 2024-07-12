import Swal from 'sweetalert2';

document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('delete-button-general');
    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Evita el envío automático del formulario
        
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Estás seguro de que deseas eliminar este elemento?\n\nEste cambio es irreversible ',
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
