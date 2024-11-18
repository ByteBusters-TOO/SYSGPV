$(document).ready(function() { 
    var editAlertaId = null;

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

    // Crear o modificar proyectos
    $('#actionAlertaButton').on('click', function() {
        console.log("Botón Guardar Alerta presionado");
        var formData = new FormData();
        formData.append('estado_alerta', $('#estado_alerta').val());
        formData.append('asunto_alerta', $('#asunto_alerta').val());
        formData.append('fecha_alerta', $('#fecha_alerta').val());
        formData.append('tipo_alerta', $('#tipo_alerta').val());
        formData.append('id_proyecto', $('#id_proyecto').val());
        formData.append('id_usuario', $('#id_usuario').val()); //Se captura el ID usuario


        if (editAlertaId !== null) {
            formData.append('_method', 'PUT');
            formData.append('id_alerta', editAlertaId);
        }

        $.ajax({
            url: '../controllers/alertaController.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log("Respuesta del servidor:", response);
                if (response.status === 'success') {
                    showMessage('success', response.message);
                    $('#createAlertaForm')[0].reset();
                    $('#actionAlertaButton').text('Guardar Alerta');
                    editAlertaId = null;
                } else {
                    showMessage('danger', response.message || "Ha ocurrido un error desconocido.");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                showMessage('danger', "Error en la solicitud: " + textStatus + " - " + errorThrown);
            }
        });
    });
    function loadOptions(type, selectId) {
        $.ajax({
            url: '../controllers/alertaController.php',
            type: 'GET',
            data: { type: type },
            success: function(response) {
                if (response.status === 'success') {
                    const select = $(`#${selectId}`);
                    select.empty(); // Limpiar el select
                    response.data.forEach(item => {
                        select.append(new Option(item[`nombre_${type}`], item[`id_${type}`]));
                    });
                } else {
                    console.error(`Error al cargar ${type}: `, response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(`Error al realizar la solicitud para ${type}: ${textStatus} - ${errorThrown}`);
            }
        });
    }
    
    $(document).ready(function() {
        // Cargar opciones al cargar la página
        loadOptions('proyecto', 'id_proyecto');
        loadOptions('usuario', 'id_usuario');
    });
    
});
