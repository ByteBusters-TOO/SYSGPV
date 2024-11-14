$(document).ready(function(){

    //Variables que tendran el id a seleccionar de la tabla
    var deleteUsuarioId = null;
    var editUsuarioId = null;

    //Expresion regular para el manejo de contraseña
    const pattern = new RegExp("^(?=.*[A-Z])(?=.*[a-z])(?=.*\\d)(?=.*[.@$!%*?&;+\\-*/])[^\\s]{8,25}$");

    // Función para cargar tipos de roles en el select
    function loadTiposRoles() {
        $.ajax({
            url: '../controllers/usuarioController.php?rol_usuario=true',
            type: 'GET',
            success: function(response) {
                var select = $('#u_rol_usuario');
                select.empty(); // Limpiar el select
                response.forEach(function(tipo) {
                    select.append('<option value="' + tipo.id_rol + '">' + tipo.tipo_usuario + '</option>');
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                showMessage('danger', "Error al cargar tipos de usuarios: " + textStatus + " - " + errorThrown);
            }
        });
    }

    // Mostrar mensajes en el alert
    function showMessage(type, message) {
        // Define los estilos específicos para cada tipo de alerta
        const alertStyles = {
            'success': 'background-color: #58d68d; border-color: #146c43;', // Verde 
            'danger': 'background-color: #ec7063; border-color: #b02a37;',  // Rojo 
            'warning': 'background-color: #f4d03f; border-color: #cc9a06; color: #000;', // Amarillo 
            'info': 'background-color: #5499c7; border-color: #0aa2c0;',    // Azul
        };

       // Crear el HTML de la alerta con los estilos personalizados
    $('.mensaje').html(`
        <div class="alert alert-${type} alert-dismissible fade show" 
             role="alert" 
             style="${alertStyles[type]} box-shadow: 0 2px 5px rgba(0,0,0,0.2); 
                    padding: 1rem; 
                    margin: 1rem 0;">
            <div class="d-flex align-items-center">
                <span class="text-sm" style="font-weight: 500;">
                    ${message}
                </span>
                <button type="button" 
                        class="btn-close" 
                        data-bs-dismiss="alert" 
                        aria-label="Close"
                        style="margin-left: auto; 
                               opacity: 0.8;
                               filter: brightness(${type === 'warning' ? '0' : '100'});">
                </button>
            </div>
        </div>
    `);

        // Autocierre después de 5 segundos
        setTimeout(() => {
            $('.alert').fadeOut('slow');
        }, 5000);
    }

    // Registrar usuario
    $('#actionUsuarioButton').click(function() {
        var id_rol = $('#u_rol_usuario').val();
        var nombre_usuario = $('#nombre_usuario').val();
        var correo_usuario = $('#correo_usuario').val();
        var password = $('#upassword').val();
        var confcontrasenia = $('#confcontrasenia').val();

        if (!pattern.test(password)) {
            // Contraseña inválida
            showMessage('danger', "Error, la contraseña no cumple con alguno de los requisitos. Almenos una mayúscula, una minúscula, un numero, un carácter especial, que no tenga espacios.");
        } else {
            if (password != confcontrasenia) {
                showMessage('warning', 'Las contraseñas no coinciden.');
                return;
            }

            if (!nombre_usuario || !correo_usuario || !password) {
                showMessage('danger', "Todos los campos son obligatorios.");
                return;
            }

            var url = '../controllers/usuarioController.php';
            var method = 'POST';
            var data = { nombre_usuario: nombre_usuario, correo_usuario: correo_usuario, id_rol: id_rol, password: password } ;

            if (editUsuarioId !== null) {
                method = 'PUT';
                data.id = editUsuarioId;
            }

            $.ajax({
                url: url,
                type: method,
                contentType: 'application/json',
                data: JSON.stringify(data),
                success: function(response) {
                    showMessage('success', response.message);
                    resetForm();
                    $('#actionUsuarioButton').text('Guardar');
                    editUsuarioId = null;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    showMessage('danger', "Error en la solicitud: " + textStatus + " - " + errorThrown);
                }
            }); 
        }
    });

    // Confirmar eliminación
    $('#confirmDeleteButton').click(function() {
        if (deleteUsuarioId !== null) {
            $.ajax({
                url: '../controllers/usuarioController.php',
                type: 'DELETE',
                contentType: 'application/json',
                data: JSON.stringify({ id: deleteUsuarioId}),
                success: function(response) {
                    showMessage('success', response.message);
                    $('#confirmDeleteModal').modal('hide');
                    resetForm();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    showMessage('danger', "Error en la solicitud: " + textStatus + " - " + errorThrown);
                }
            });
        }
    });

    // Inicializar
    loadTiposRoles(); // Cargar los tipos de usuarios al cargar la página

    function resetForm() {
        loadTiposRoles();
        document.getElementById("nombre_usuario").value = "";
        document.getElementById("correo_usuario").value = "";
        document.getElementById("upassword").value = "";
        document.getElementById("confcontrasenia").value = "";
    }
});