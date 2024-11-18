$(document).ready(function() {
    // Obtener el ID de la URL
    var editEmpresaId = new URLSearchParams(window.location.search).get('id');; // Se asigna el ID del proyecto al cargar
    
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
    function loadEmpresaData(id) {
        $.ajax({
            url: '../controllers/empresaController.php',
            type: 'GET',
            data: { id: id },
            success: function(response) {
                
                if (response.status === 'success') {
                    var empresa = response.data;
                    $('#id_empresa').val(empresa.id_empresa);
                    $('#nombre_empresa').val(empresa.nombre_empresa);
                    $('#ventas_empresa').val(empresa.ventas_empresa);
                    $('#proyectos_empresa').val(empresa.proyectos_empresa);
                } else {
                    showMessage('danger', response.message || "Error al cargar la empresa");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                showMessage('danger', "Error en la solicitud: " + textStatus + " - " + errorThrown);
            }
        });
    }

    // Actualizar empresa
    $('#updateEmpresaButton').click(function() {
        var formData = new FormData();
        formData.append('nombre_empresa', $('#nombre_empresa').val());
        formData.append('ventas_empresa', $('#ventas_empresa').val());
        formData.append('proyectos_empresa', $('#proyectos_empresa').val());
        formData.append('_method', 'PUT');
        formData.append('id_empresa', $('#id_empresa').val());

        // Verificación de campos requeridos
        if (!$('#nombre_empresa').val() || !$('#ventas_empresa').val() || !$('#proyectos_empresa').val()) {
            showMessage('danger', "Complete los campos requeridos");
            return;
        }

        $.ajax({
            url: '../controllers/empresaController.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status === 'success') {
                    showMessage('success', response.message);
                    setTimeout(function() {
                        window.location.href = 'empresas.php';
                    }, 3000);
                } else {
                    showMessage('danger', response.message || "Error al actualizar la empresa");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                showMessage('danger', "Error en la solicitud: " + textStatus + " - " + errorThrown);
            }
        });
    });

    // Cargar datos de la empresa al iniciar la página
    if (editEmpresaId) {
        loadEmpresaData(editEmpresaId);
    } else {
        showMessage('danger', "ID de empresa no proporcionado en la URL");
    }
});
