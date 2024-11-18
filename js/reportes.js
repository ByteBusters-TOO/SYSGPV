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
        const tipoReporte = $('#tipoReporte').val();
    
        if (tipoReporte === "Tipo de reporte") {
            showMessage('danger', 'Selecciona un tipo de reporte válido.');
            return;
        }
    
        $.ajax({
            url: '../controllers/ReporteController.php',
            type: 'POST',
            data: { tipoReporte },
            success: async function (response) {
                if (response.status === 'success') {
                    const { jsPDF } = window.jspdf; // Asegúrate de extraer jsPDF del objeto global
                    const doc = new jsPDF();
                    doc.text(response.data.titulo, 10, 10);
                    doc.text(response.data.contenido, 10, 20);
                    doc.save(`${response.data.nombreArchivo}.pdf`);
                    showMessage('success', 'Reporte generado con éxito.');
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
