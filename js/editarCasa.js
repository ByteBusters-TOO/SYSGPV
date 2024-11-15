$(document).ready(function () {
    $("#editarCasaButton").click(function () {
        var formData = $("#editarCasaForm").serialize(); // Obtener datos del formulario
        formData += '&action=update'; // Añadir acción específica

        $.ajax({
            type: "POST",
            url: "../controllers/CasaController.php", // Controlador específico
            data: formData,
            success: function (response) {
                var responseObj = JSON.parse(response);
                if (responseObj.status === true) {
                    alert("Casa actualizada correctamente.");
                    window.location.href = "casasD.php"; // Redirigir tras éxito
                } else {
                    alert("Error al actualizar la casa: " + responseObj.mensaje);
                }
            },
            error: function () {
                alert("Error al enviar los datos. Intenta nuevamente.");
            }
        });
    });
});
