import Swal from 'sweetalert2';

document.addEventListener('DOMContentLoaded', function () {
    var editButtonDisabled = document.getElementById('edit-service-button-disabled');

    if (editButtonDisabled) {
        editButtonDisabled.addEventListener('click', function (event) {
            event.preventDefault(); // Detiene la acción predeterminada del botón

            Swal.fire({
                title: 'No es posible editar este elemento',
                html: 'Ya existe un pago asociado a este servicio',
                icon: 'error',
                showDenyButton: true,
                denyButtonText: 'Aceptar',
                denyButtonColor: '#d33',
                showConfirmButton: false
            }).then((result) => {
                if (result.isDenied) {
                    // Solo cierra la alerta
                }
            });
        });
    }
});
