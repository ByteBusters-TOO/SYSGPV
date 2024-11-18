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
    $('#editAlertaButton').on('click', function () {
        const id_alerta = $('#id_alerta').val();
        const tipo_alerta = $('#tipo_alerta').val();
        const fecha_alerta = $('#fecha_alerta').val();
        const asunto_alerta = $('#asunto_alerta').val();
        const estado_alerta = $('#estado_alerta').val();
        const id_proyecto = $('#id_proyecto').val();
        const id_usuario = $('#id_usuario').val();

        if (id_alerta && tipo_alerta && fecha_alerta && asunto_alerta && estado_alerta && id_proyecto && id_usuario) {
            $.ajax({
                url: '../controllers/alertaController.php',
                type: 'POST',
                data: {
                    id_alerta: id_alerta,
                    tipo_alerta: tipo_alerta,
                    fecha_alerta: fecha_alerta,
                    asunto_alerta: asunto_alerta,
                    estado_alerta: estado_alerta,
                    id_proyecto: id_proyecto,
                    id_usuario: id_usuario
                },
                success: function (response) {

                    const data = JSON.parse(response);
                    if (data.status) {
                        showMessage('success', 'Alerta actualizada correctamente.'); // Mensaje de éxito
                        // Redirigir a la lista de alertas después de un breve momento
                        setTimeout(function () {
                            window.location.href = "alertaVer.php";
                        }, 2000);
                    } else {
                        showMessage('warning', data.mensaje); // Mensaje de advertencia (problemas en el servidor)
                    }
                },
                error: function () {
                    showMessage('danger', 'Error al actualizar la alerta.'); // Mensaje de error
                }
            });
        } else {
            showMessage('warning', 'Por favor, completa todos los campos.'); // Mensaje de advertencia
        }
    });
});
