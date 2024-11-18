$(document).ready(function () {
    // Función para mostrar mensajes en el alert
    function showMessage(type, message) {
        $('.mensaje').html(
            '<div class="alert alert-' + type + ' alert-dismissible text-black fade show" role="alert">' +
            '<span class="text-sm">' + message + '</span>' +
            '<button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span></button></div>'
        );
        setTimeout(function () {
            $('.mensaje').html(''); // Limpiar el mensaje después de 3 segundos
        }, 3000);
    }

    // Generar reporte
    $('#generarReporteButton').click(function () {
        const tipo_reporte = $('#tipo_reporte').val();
        const descripcion_reporte = $('#descripcion_reporte').val(); // Obtener descripción
        const fecha_generacion = $('#fecha_generacion').val(); // Obtener fecha

        console.log('Tipo de reporte seleccionado:', tipo_reporte); // Verificar tipo de reporte
        console.log('Descripción del reporte:', descripcion_reporte);
        console.log('Fecha de generación:', fecha_generacion);
        if (tipo_reporte === "Tipo de reporte") {
            showMessage('danger', 'Selecciona un tipo de reporte válido.');
            return;
        }
        if (!descripcion_reporte) {
            showMessage('danger', 'Ingresa una descripción para el reporte.');
            return;
        }

        if (!fecha_generacion) {
            showMessage('danger', 'Selecciona una fecha de generación.');
            return;
        }

        $.ajax({
            url: '../controllers/ReporteController.php',
            type: 'POST',
            data: { tipo_reporte, descripcion_reporte, fecha_generacion },
            success: function (response) {
                console.log('Respuesta completa:', response);  // Muestra toda la respuesta
                console.log('Contenido:', response.data);     // Muestra solo el campo 'data'

                if (response.status === 'success') {
                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF();

                    // Verificar que 'titulo' y 'contenido' existen
                    if (response.data.titulo) {
                        doc.setFontSize(18);
                        doc.text(response.data.titulo, 10, 10);
                    } else {
                        console.log('No se encontró el título del reporte.');
                    }

                    // Verificar que 'contenido' sea un array
                    // Parsear el contenido si es un string JSON
                    let contenido = response.data.contenido;
                    if (typeof contenido === 'string') {
                        contenido = JSON.parse(contenido); // Convertir el string JSON a un array
                    }

                    if (Array.isArray(contenido)) {
                        let columnas = [];
                        let filas = [];

                        // Asegurarse de que el tipo de reporte sea el correcto
                        if (tipo_reporte === "1") { // Reporte de Ventas
                            columnas = ["ID Venta", "Fecha Venta", "Monto Venta", "Cliente"];
                            filas = contenido.map(venta => [
                                venta.id_venta,
                                venta.fecha_venta,
                                venta.monto_venta,
                                venta.nombre_cliente
                            ]);
                        } else if (tipo_reporte === "2") { // Reporte de Casas
                            columnas = ["ID Casa", "Número Casa", "Estado", "Precio"];
                            filas = contenido.map(casa => [
                                casa.id_casa,
                                casa.numero_casa,
                                casa.estado_casa,
                                casa.precio_casa
                            ]);
                        } else if (tipo_reporte === "3") { // Reporte de Proyectos
                            columnas = ["ID Proyecto", "Nombre", "Fecha Inicio", "Estado"];
                            filas = contenido.map(proyecto => [
                                proyecto.id_proyecto,
                                proyecto.nombre_proyecto,
                                proyecto.fecha_inicio,
                                proyecto.estado_proyecto
                            ]);
                        }

                        // Verificar que las filas estén siendo generadas correctamente
                        console.log('Filas generadas:', filas);

                        // Generar tabla con autoTable
                        doc.autoTable({
                            head: [columnas],
                            body: filas,
                            startY: 20 // Espacio debajo del título
                        });

                        // Verificar que 'nombreArchivo' exista para el nombre del PDF
                        const nombreArchivo = response.data.nombreArchivo || 'reporte_generado';
                        doc.save(`${nombreArchivo}.pdf`);
                        showMessage('success', 'Reporte generado con éxito.');
                         // Limpiar campos del formulario
                         $('#tipo_reporte').val('Tipo de reporte'); // Restablecer el select
                         $('#descripcion_reporte').val(''); // Limpiar descripción
                         $('#fecha_generacion').val(''); // Limpiar fecha
                    } else {
                        console.log('Los datos de contenido no son válidos o están vacíos.');
                        showMessage('danger', 'Los datos del reporte no son válidos o están mal formateados.');
                    }
                } else {
                    showMessage('danger', response.message || 'Error al generar el reporte.');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                showMessage('danger', `Error: ${textStatus} - ${errorThrown}`);
            }
        });
    });
});
