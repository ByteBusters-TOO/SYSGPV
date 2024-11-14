$(document).ready(function() {
    // Función para mostrar el mensaje con tipo y contenido
    function showMessage(type, message) {
        $('.mensaje').html(
            '<div class="alert alert-' + type + ' alert-dismissible text-black fade show" role="alert">' +
            '<span class="text-sm">' + message + '</span>' +
            '<button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span></button></div>'
        );
        
        // Desaparecer el mensaje después de 3 segundos
        setTimeout(function() {
            $('.mensaje').html(''); // Limpiar el mensaje después de 3 segundos
        }, 3000);
    }

    // Acción al hacer clic en el botón Guardar Casa
    $('#actionCasaButton').on('click', function() {
        const numeroCasa = $('#numero_casa').val();
        const estadoCasa = $('#estado_casa').val();
        const precioCasa = $('#precio_casa').val();
        const idProyecto = $('#id_proyecto').val();

        if (numeroCasa && estadoCasa && precioCasa && idProyecto) {
            $.ajax({
                url: '../controllers/CasaController.php',
                type: 'POST',
                data: {
                    action: 'create',
                    numero_casa: numeroCasa,
                    estado_casa: estadoCasa,
                    precio_casa: precioCasa,
                    id_proyecto: idProyecto
                },
                success: function(response) {
                    const mensaje = JSON.parse(response).mensaje;
                    showMessage('success', mensaje); // Mostrar mensaje de éxito
                    $('#registrarCasaForm')[0].reset();  // Limpia el formulario
                    // Verificar si el registro fue exitoso o si hubo un duplicado
                    if (data.status) {
                        showMessage('success', mensaje); // Mostrar mensaje de éxito
                        $('#registrarCasaForm')[0].reset();  // Limpia el formulario si es exitoso
                    } else {
                        showMessage('warning', mensaje); // Mostrar mensaje de advertencia (duplicado)
                    }
                },
                error: function() {
                    showMessage('danger', 'Error al registrar la casa.'); // Mostrar mensaje de error
                }
            });
        } else {
            showMessage('warning', 'Por favor, completa todos los campos.'); // Mostrar mensaje de advertencia
        }
    });
});
