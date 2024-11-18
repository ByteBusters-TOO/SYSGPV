$(document).ready(function() {
    var editAlertaId = alertaId; // Se asigna el ID del proyecto al cargar

    // Mostrar mensajes en el alert
    function showMessage(type, message) {
        $('.mensaje').html(
            '<div class="alert alert-' + type + ' alert-dismissible text-black fade show" role="alert">' +
            '<span class="text-sm">' + message + '</span>' +
            '<button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span></button></div>'
        );
        setTimeout(function() {
            $('.mensaje').html(''); // Limpiar el mensaje después de 3 segundos
        }, 3000);
    }

    // Cargar datos de la alerta
    function loadAlertaData(id) {
        $.ajax({
            url: '../controllers/alertaController.php',
            type: 'GET',
            data: { id: id },
            success: function(response) {
                if (response.status === 'success') {
                    var alerta = response.data;
                    $('#id_alerta').val(alerta.id_alerta);
                    $('#estado_alerta').val(alerta.estado_alerta);
                    $('#asunto_alerta').val(alerta.asunto_alerta);
                    $('#fecha_alerta').val(alerta.fecha_alerta);
                    $('#tipo_alerta').val(alerta.tipo_alerta);
                    $('#id_rol').val(alerta.id_rol);
                    $('#id_proyecto').val(alerta.id_proyecto);
                    $('#id_casa').val(alerta.id_casa);
                } else {
                    showMessage('danger', response.message || "Error al cargar la alerta.");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                showMessage('danger', "Error en la solicitud: " + textStatus + " - " + errorThrown);
            }
        });
    }

    // Actualizar alerta
    $('#updateAlertaButton').click(function() {
        var formData = new FormData();
        formData.append('estado_alerta', $('#estado_alerta').val());
        formData.append('asunto_alerta', $('#asunto_alerta').val());
        formData.append('fecha_alerta', $('#fecha_alerta').val());
        formData.append('tipo_alerta', $('#tipo_alerta').val());
        formData.append('id_usuario', $('#id_usuario').val());
        formData.append('id_proyecto', $('#id_proyecto').val());
        formData.append('id_casa', $('#id_casa').val());
        formData.append('_method', 'PUT');
        formData.append('id_alerta', $('#id_alerta').val());

        // Verificación de campos requeridos
        if (!$('#estado_alerta').val() || !$('#asunto_alerta').val() || !$('#fecha_alerta').val() || !$('#tipo_alerta').val() ||!$('#id_rol').val() || !$('#id_proyecto').val()  || !$('#id_casa') ) {
            showMessage('danger', "Complete los campos requeridos.");
            return;
        }

        $.ajax({
            url: '../controllers/alertaController.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status === 'success') {
                    showMessage('success', response.message); // Mostrar mensaje de éxito
                    setTimeout(function() {
                        window.location.href = 'alertaNueva.php'; // Redirigir después de mostrar el mensaje
                    }, 3000); // Espera 3 segundos antes de redirigir
                    // Limpiar el formulario después de la edición
                    $('#createAlertaForm')[0].reset(); // Resetea el formulario
                    $('#updateAlertaButton').text('Guardar Alerta'); // Vuelve al texto original
                    editAlertaId = null; // Resetea el ID de edición

                } else {
                    showMessage('danger', response.message || "Error al actualizar la alerta.");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                showMessage('danger', "Error en la solicitud: " + textStatus + " - " + errorThrown);
            }
        });
    });

    // Llamada para cargar las alertas al iniciar la página
    if (editAlertaId) {
        loadAlertaData(editAlertaId);
    }
});
