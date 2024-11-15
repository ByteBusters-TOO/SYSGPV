$(document).ready(function () {
    // Función para mostrar el mensaje con tipo y contenido
    function showMessage(type, message) {
        $('.mensaje').html(
            '<div class="alert alert-' + type + ' alert-dismissible text-black fade show" role="alert">' +
            '<span class="text-sm">' + message + '</span>' +
            '<button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span></button></div>'
        );

        // Desaparecer el mensaje después de 3 segundos
        setTimeout(function () {
            $('.mensaje').html(''); // Limpiar el mensaje después de 3 segundos
        }, 3000);
    }

    // Acción al hacer clic en el botón Guardar Cambios
    $('#editarCasaButton').on('click', function () {
        const idCasa = $('#id_casa').val();
        const numeroCasa = $('#numero_casa').val();
        const estadoCasa = $('#estado_casa').val();
        const precioCasa = $('#precio_casa').val();
        const idProyecto = $('#id_proyecto').val();

        if (idCasa && numeroCasa && estadoCasa && precioCasa && idProyecto) {
            $.ajax({
                url: '../controllers/CasaController.php',
                type: 'POST',
                data: {
                    action: 'update',
                    id_casa: idCasa,
                    numero_casa: numeroCasa,
                    estado_casa: estadoCasa,
                    precio_casa: precioCasa,
                    id_proyecto: idProyecto
                },
                success: function (response) {
                    const data = JSON.parse(response);
                    if (data.status) {
                        showMessage('success', 'Casa actualizada correctamente.'); // Mensaje de éxito
                        // Redirigir a la lista de casas después de un breve momento
                        setTimeout(function () {
                            window.location.href = "casasD.php";
                        }, 2000);
                    } else {
                        showMessage('warning', data.mensaje); // Mensaje de advertencia (problemas en el servidor)
                    }
                },
                error: function () {
                    showMessage('danger', 'Error al actualizar la casa.'); // Mensaje de error
                }
            });
        } else {
            showMessage('warning', 'Por favor, completa todos los campos.'); // Mensaje de advertencia
        }
    });
});
