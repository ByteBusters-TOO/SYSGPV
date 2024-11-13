$(document).ready(function() { 
    var editProyectoId = null;

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
    $('#actionProyectoButton').click(function() {
        console.log("Botón Guardar Proyecto presionado");
        var formData = new FormData();
        formData.append('nombre_proyecto', $('#nombre_proyecto').val());
        formData.append('descripcion_proyecto', $('#descripcion_proyecto').val());
        formData.append('ubicacion_proyecto', $('#ubicacion_proyecto').val());
        formData.append('fecha_inicio', $('#fecha_inicio').val());
        formData.append('fecha_fin', $('#fecha_fin').val());

        // Verificación de campos requeridos
        if (!$('#nombre_proyecto').val() || !$('#descripcion_proyecto').val() || !$('#fecha_inicio').val()) {
            showMessage('danger', "Complete los campos requeridos");
            return;
        }

        if (editProyectoId !== null) {
            formData.append('_method', 'PUT');
            formData.append('id_proyecto', editProyectoId);
        }

        $.ajax({
            url: '../controllers/ProyectoController.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log("Respuesta del servidor:", response);
                if (response.status === 'success') {
                    showMessage('success', response.message);
                    $('#crearProyectoForm')[0].reset();
                    $('#actionProyectoButton').text('Guardar Proyecto');
                    editProyectoId = null;
                } else {
                    showMessage('danger', response.message || "Ha ocurrido un error desconocido");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                showMessage('danger', "Error en la solicitud: " + textStatus + " - " + errorThrown);
            }
        });
    });
});
