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

    // Acción al hacer clic en el botón Registrar Venta
    $('#actionVentaButton').on('click', function() {
        const fechaVenta = $('#fecha_venta').val();
        const montoVenta = $('#monto_venta').val();
        const nombreCliente = $('#nombre_cliente').val();
        const apellidoCliente = $('#apellido_cliente').val();
        const correoCliente = $('#correo_cliente').val();
        const telefonoCliente = $('#telefono_cliente').val();
        const idCasa = $('#id_casa').val();

        if (fechaVenta && montoVenta && nombreCliente && apellidoCliente && correoCliente && telefonoCliente && idCasa) {
            $.ajax({
                url: '../controllers/VentaController.php',
                type: 'POST',
                data: {
                    action: 'create',
                    fecha_venta: fechaVenta,
                    monto_venta: montoVenta,
                    nombre_cliente: nombreCliente,
                    apellido_cliente: apellidoCliente,
                    correo_cliente: correoCliente,
                    telefono_cliente: telefonoCliente,
                    id_casa: idCasa
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    showMessage(data.status, data.mensaje); // Mostrar mensaje de éxito o error
                    if (data.status === 'success') {
                        $('#registrarVentaForm')[0].reset();  // Limpia el formulario si es exitoso
                    }
                },
                error: function() {
                    showMessage('danger', 'Error al registrar la venta.'); // Mostrar mensaje de error
                }
            });
        } else {
            showMessage('warning', 'Por favor, completa todos los campos.'); // Mostrar mensaje de advertencia
        }
    });
});
