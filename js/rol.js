$(document).ready(function() {

    //Variables que tendran el id a seleccionar de la tabla
    var deleteTipoUsuarioId = null;
    var editTipoUsuarioId = null;

    function showMessage(type, message) {
        const modalTitle = document.getElementById('messageModalLabel');
        const modalBody = document.getElementById('messageModalBody');
        
        // Cambiar el color del título según el tipo
        const colors = {
            success: 'text-success',
            danger: 'text-danger',
            warning: 'text-warning',
            info: 'text-info'
        };
        
        modalTitle.className = colors[type];
        modalTitle.textContent = type === 'success' ? 'Éxito' : type === 'danger' ? 'Error' : 'Información';
        modalBody.textContent = message;
        
        // Mostrar el modal
        const messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
        messageModal.show();
    }
    
    

    // Leer todos los tipos de usuario
    function readAllTipoUsuarios() {
        $.ajax({
            url: '../controllers/rolesUsuarioController.php',
            type: 'GET',
            success: function(response) {
                console.log(response);
                $('#body-t').empty();
                response.forEach(function(tipoUsuario) {
                    $('#body-t').append(`
                        <tr>
                            <td class="text-center">
                                <p class="text-xs font-weight-bold mb-0">${tipoUsuario.id_rol}</p>
                            </td>
                            <td class="text-start">
                                <p class="text-xs font-weight-bold mb-0">${tipoUsuario.tipo_usuario}</p>
                            </td>
                            <td class="text-start">
                                <p class="text-xs font-weight-bold mb-0">${tipoUsuario.descripcion_usuario}</p>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-sm deleteButton" 
                                        data-id="${tipoUsuario.id_rol}"
                                        style="min-width: 80px;">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-info btn-sm editButton" 
                                        data-id="${tipoUsuario.id_rol}"
                                        style="min-width: 80px;">
                                    <i class="bi bi-pencil"></i> Modificar
                                </button>
                            </td>
                        </tr>
                    `);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                showMessage('danger', "Error en la solicitud: " + textStatus + " - " + errorThrown);
            }
        });
    }

    // Crear o modificar roles
    $('#actionTipoUsuarioButton').click(function() {
        console.log("Botón Guardar Roles presionado");
        var formData = new FormData();
        formData.append('tipo_usuario', $('#tipo_usuario').val());
        formData.append('descripcion_usuario', $('#descripcion_usuario').val());


        // Verificación de campos requeridos
        if (!$('#tipo_usuario').val() || !$('#descripcion_usuario').val()) {
            showMessage('danger', "Complete los campos requeridos.");
            return;
        }

        if (editTipoUsuarioId !== null) {
            formData.append('_method', 'PUT');
            formData.append('id_rol', editTipoUsuarioId);
        }

        $.ajax({
            url: '../controllers/rolesUsuarioController.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log("Respuesta del servidor:", response);
                if (response.status === 'success') {
                    showMessage('success', response.message);
                    setTimeout(function() {
                        window.location.href = 'rolesUsuario.php'; // Redirigir después de mostrar el mensaje
                    }, 3000); // Espera 3 segundos antes de redirigir
                    $('#createTipoUsuarioModal').modal('hide'); // Cerrar el modal de formulario
                    readAllTipoUsuarios(); // Recargar tabla
                    editTipoUsuarioId = null;
                } else {
                    showMessage('danger', response.message || "Ha ocurrido un error desconocido.");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                showMessage('danger', "Error en la solicitud: " + textStatus + " - " + errorThrown);
            }
        });
    });


    // Abrir modal de confirmación de eliminación
    $('#tipoUsuarioTable').on('click', '.deleteButton', function() {
        deleteTipoUsuarioId = $(this).data('id');
        $('#confirmDeleteModal').modal('show');
    });

    // Confirmar eliminación
    $('#confirmDeleteButton').click(function() {
        if (deleteTipoUsuarioId !== null) {
            $.ajax({
                url: '../controllers/rolesUsuarioController.php',
                type: 'DELETE',
                contentType: 'application/json',
                data: JSON.stringify({ id: deleteTipoUsuarioId }),
                success: function(response) {
                    showMessage('success', response.message);
                    $('#confirmDeleteModal').modal('hide');
                    readAllTipoUsuarios();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    showMessage('danger', "Error en la solicitud: " + textStatus + " - " + errorThrown);
                }
            });
        }
    });

    // Limpiar el formulario cuando se abre el modal de creación
    $('#createTipoUsuarioModal').on('show.bs.modal', function () {
        resetForm();
        $('#actionTipoUsuarioButton').text('Guardar');
        editTipoUsuarioId = null;
    });

    // Modificar el evento del botón de editar para que abra el modal
    $('#tipoUsuarioTable').on('click', '.editButton', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '../controllers/rolesUsuarioController.php?id=' + id,
            type: 'GET',
            success: function(response) {
                $('#tipo_usuario').val(response.tipo_usuario);
                $('#descripcion_usuario').val(response.descripcion_usuario);
                $('#actionTipoUsuarioButton').text('Modificar');
                $('#createTipoUsuarioModalLabel').text('Modificar Tipo de Rol');
                editTipoUsuarioId = id;
                $('#createTipoUsuarioModal').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                showMessage('danger', "Error en la solicitud: " + textStatus + " - " + errorThrown);
            }
        });
    });

    // Inicializar
    readAllTipoUsuarios();

    function resetForm() {
        document.getElementById("tipo_usuario").value = "";
        document.getElementById("descripcion_usuario").value = "";
    }
});
