$(document).ready(function(){

    //Variables que tendran el id a seleccionar de la tabla
    var deleteUsuarioId = null;
    var editUsuarioId = null;

    //Expresion regular para el manejo de contraseña
    const pattern = new RegExp("^(?=.*[A-Z])(?=.*[a-z])(?=.*\\d)(?=.*[.@$!%*?&;+\\-*/])[^\\s]{8,25}$");

    // Función para cargar tipos de roles en el select
    function loadTiposRoles() {
        $.ajax({
            url: '../controllers/usuarioController.php?tipo_usuario=true',
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
        $('.mensaje').html(
            '<div class="alert alert-' + type + ' alert-dismissible text-white fade show" role="alert"><span class="text-sm">'
            + message +'<button type="button" class="btn-close text-lg py-3 opacity-10" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
    }

    // Registrar usuario
    $('#actionUsuarioButton').click(function() {
        var id_rol = $('#u_tipo_usuario').val();
        var nombre_usuario = $('#nombre_usuario').val();
        var correo_usuario = $('#correo_usuario').val();
        var password = $('#upassword').val();
        var confcontrasenia = $('#confcontrasenia').val();

        if (!pattern.test(password)) {
            // Contraseña inválida
            showMessage('warning', "Error, la contraseña no cumple con alguno de los requisitos /n Almenos una mayúscula, una minúscula, un numero, un carácter especial, que no tenga espacios");
        } else {
            if (password != confcontrasenia) {
                showMessage('danger', 'Las contraseñas no coinciden.');
                return;
            }

            if (!nombre_usuario || !correo_usuario || !password) {
                showMessage('danger', "Todos los campos son obligatorios.");
                return;
            }

            var url = '../controllers/usuarioController.php';
            var method = 'POST';
            var data = { id_rol: id_rol, nombre_usuario: nombre_usuario, correo_usuario: correo_usuario, password: password } ;

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