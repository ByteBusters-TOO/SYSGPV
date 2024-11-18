$(document).ready(function() {
    var editProyectoId = projectId; // Se asigna el ID del proyecto al cargar

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

    // Cargar datos del proyecto
    function loadProjectData(id) {
        $.ajax({
            url: '../controllers/ProyectoController.php',
            type: 'GET',
            data: { id: id },
            success: function(response) {
                if (response.status === 'success') {
                    var project = response.data;
                    $('#id_proyecto').val(project.id_proyecto);
                    $('#nombre_proyecto').val(project.nombre_proyecto);
                    $('#descripcion_proyecto').val(project.descripcion_proyecto);
                    $('#ubicacion_proyecto').val(project.ubicacion_proyecto);
                    $('#fecha_inicio').val(project.fecha_inicio);
                    $('#fecha_fin').val(project.fecha_fin);
                    $('#estado_proyecto').val(project.estado_proyecto);
                } else {
                    showMessage('danger', response.message || "Error al cargar el proyecto");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                showMessage('danger', "Error en la solicitud: " + textStatus + " - " + errorThrown);
            }
        });
    }

    // Actualizar proyecto
    $('#updateProyectoButton').click(function() {
        var formData = new FormData();
        formData.append('nombre_proyecto', $('#nombre_proyecto').val());
        formData.append('descripcion_proyecto', $('#descripcion_proyecto').val());
        formData.append('ubicacion_proyecto', $('#ubicacion_proyecto').val());
        formData.append('fecha_inicio', $('#fecha_inicio').val());
        formData.append('fecha_fin', $('#fecha_fin').val());
        formData.append('estado_proyecto', $('#estado_proyecto').val());
        formData.append('_method', 'PUT');
        formData.append('id_proyecto', $('#id_proyecto').val());

        // Verificación de campos requeridos
        if (!$('#nombre_proyecto').val() || !$('#descripcion_proyecto').val() || !$('#fecha_inicio').val() || !$('#estado_proyecto').val()) {
            showMessage('danger', "Complete los campos requeridos");
            return;
        }

        $.ajax({
            url: '../controllers/ProyectoController.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status === 'success') {
                    showMessage('success', response.message); // Mostrar mensaje de éxito
                    setTimeout(function() {
                        window.location.href = 'proyectoVer.php'; // Redirigir después de mostrar el mensaje
                    }, 3000); // Espera 3 segundos antes de redirigir
                    // Limpiar el formulario después de la edición
                    $('#crearEmpresaForm')[0].reset(); // Resetea el formulario
                    $('#updateEmpresaButton').text('Guardar Proyecto'); // Vuelve al texto original
                    editProyectoId = null; // Resetea el ID de edición

                } else {
                    showMessage('danger', response.message || "Error al actualizar el proyecto");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                showMessage('danger', "Error en la solicitud: " + textStatus + " - " + errorThrown);
            }
        });
    });

    // Llamada para cargar el proyecto al iniciar la página
    if (editProyectoId) {
        loadProjectData(editProyectoId);
    }
});
