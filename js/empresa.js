$(document).ready(function () {

    //Variables que tendran el id a seleccionar de la tabla
    
    var deleteEmpresaId = null;
    var editEmpresaId = null;

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

        // Agregar evento para recargar la página cuando el modal se cierre
    $('#messageModal').on('hidden.bs.modal', function () {
        // Recargar la página
        location.reload();
    });

    }



    // Leer todos las empresas
    function readAllempresas() {
        $.ajax({
            url: '../controllers/empresaController.php',
            type: 'GET',
            success: function (response) {
                console.log(response);
                $('#body-t').empty();
                response.forEach(function (empresa) {
                    $('#body-t').append(`
                        <tr>
                            <td class="text-center">
                                <p class="text-xs font-weight-bold mb-0">${empresa.id_empresa}</p>
                            </td>
                            <td class="text-start">
                                <p class="text-xs font-weight-bold mb-0">${empresa.nombre_empresa}</p>
                            </td>
                            <td class="text-start">
                                <p class="text-xs font-weight-bold mb-0">${empresa.ventas_empresa}</p>
                            </td>
                             <td class="text-start">
                                <p class="text-xs font-weight-bold mb-0">${empresa.proyectos_empresa}</p>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-sm deleteButton" 
                                        data-id="${empresa.id_empresa}"
                                        style="min-width: 80px;">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-info btn-sm editButton" 
                                        data-id="${empresa.id_empresa}"
                                        style="min-width: 80px;">
                                    <i class="bi bi-pencil"></i> Modificar
                                </button>
                            </td>
                        </tr>
                    `);
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                showMessage('danger', "Error en la solicitud: " + textStatus + " - " + errorThrown);
            }
        });
    }

    // Crear o modificar empresas
    $('#guardarEmpresa').click(function () {
        console.log("Botón Guardar empresas presionado");
        var formData = new FormData();
        formData.append('nombre_empresa', $('#nombre_empresa').val());
        formData.append('ventas_empresa', $('#ventas_empresa').val());
        formData.append('proyectos_empresa', $('#proyectos_empresa').val());


        // Verificación de campos requeridos
        if (!$('#nombre_empresa').val() || !$('#ventas_empresa').val()) {
            showMessage('danger', "Complete los campos requeridos.");
            return;
        }

        if (editEmpresaId !== null) {
            formData.append('_method', 'PUT');
            formData.append('id_empresa', editEmpresaId);
        }

        $.ajax({
            url: '../controllers/empresaController.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log("Respuesta del servidor:", response);
                if (response.status === 'success') {
                    showMessage('success', response.message);
                    window.location.href = '../pages/empresas.php'; // Redirigir inmediatamente
                } else {
                    showMessage('danger', response.message || "Ha ocurrido un error desconocido.");
                    
                }
            }
            
            ,
            error: function (jqXHR, textStatus, errorThrown) {
                showMessage('danger', "Error en la solicitud: " + textStatus + " - " + errorThrown);
            }
        });
    });


    // Abrir modal de confirmación de eliminación
$('#empresaTable').on('click', '.deleteButton', function () {
    deleteEmpresaId = $(this).data('id');  // Asegúrate de que usas data-id
    $('#confirmDeleteModal').modal('show');
});

// Confirmar eliminación
$('#confirmDeleteButton').click(function () {
    if (deleteEmpresaId !== null) {
        $.ajax({
            url: '../controllers/empresaController.php',
            type: 'DELETE',
            contentType: 'application/json',
            data: JSON.stringify({ id_empresa: deleteEmpresaId }),  // Usar id_empresa en lugar de id
            success: function (response) {
                showMessage('success', response.message);
                $('#confirmDeleteModal').modal('hide');
                readAllempresas();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                showMessage('danger', "Error en la solicitud: " + textStatus + " - " + errorThrown);
            }
        });
    }
});


    // Limpiar el formulario cuando se abre el modal de creación
    $('#createEmpresaModal').on('show.bs.modal', function () {
        resetForm();
        $('#actionEmpresaButton').text('Guardar');
        editEmpresaId = null;
    });
    

    // Modificar el evento del botón de editar para que abra el modal
    $('#empresaTable').on('click', '.editButton', function () {
        var id = $(this).data('id');
        window.location.href = 'editarEmpresa.php?id=' + id;  // Redirigir con el ID como parámetro
       
    });

    // Inicializar
    readAllempresas();

    function resetForm() {
        document.getElementById("nombre_empresa").value = "";
        document.getElementById("ventas_empresa").value = "";
        document.getElementById("proyectos_empresa").value = "";
        
    }
});
