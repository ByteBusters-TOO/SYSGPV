$(document).ready(function() {
    var editProyectoId = null;

    // Mostrar mensajes en el alert
    function showMessage(type, message) {
        $('.mensaje').html(
            '<div class="alert alert-' + type + ' alert-dismissible text-white fade show" role="alert">' +
            '<span class="text-sm">' + message + '</span>' +
            '<button type="button" class="btn-close text-lg py-3 opacity-10" data-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span></button></div>'
        );
    }

    // Crear o modificar proyectos
    $('#actionProyectoButton').click(function() {
        console.log("Botón Guardar Proyecto presionado");  // Depuración: Verificar si se presiona el botón
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
            formData.append('_method', 'PUT'); // Campo oculto para simular PUT
            formData.append('id_proyecto', editProyectoId);
        }

        $.ajax({
            url: '../controllers/ProyectoController.php',
            type: 'POST', // Usamos POST para ambas operaciones
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response); // Depuración: Verificar la respuesta del servidor
                if (response.status === 'success') {
                    showMessage('success', response.message);
                    $('#crearProyectoForm')[0].reset(); // Limpiar el formulario
                    $('#actionProyectoButton').text('Guardar Proyecto');
                    editProyectoId = null;
                } else {
                    showMessage('danger', response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                showMessage('danger', "Error en la solicitud: " + textStatus + " - " + errorThrown);
            }
        });
    });
});
