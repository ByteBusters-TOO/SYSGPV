<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Casa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Estilo adicional para la marca de copyright */
        .copyright {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: right;
            padding: 10px 10px;
            color: #6c757d; /* Color del texto */
        }
    </style>
</head>
<body>
    <?php include '../partials/navbar.html'; ?>

    <div class="container mt-5">
        <h2>Editar Casa</h2>
        
        <!-- Contenedor de mensaje -->
        <div class="mensaje mb-3"></div>

        <!-- Formulario para editar los detalles de la casa -->
        <form id="editarCasaForm">
            <!-- Campo para el ID de la casa (Oculto para no modificarlo directamente) -->
            <input type="hidden" id="id_casa" name="id_casa" value="1"> <!-- Ejemplo, usa el ID real de la casa -->

            <div class="mb-3">
                <label for="numero_casa" class="form-label">Número de Casa</label>
                <input type="text" class="form-control" id="numero_casa" name="numero_casa" value="Casa 101" required> <!-- Ejemplo -->
            </div>
            <div class="mb-3">
                <label for="estado_casa" class="form-label">Estado de la Casa</label>
                <select class="form-control" id="estado_casa" name="estado_casa" required>
                    <option value="nuevo">En Construcción</option>
                    <option value="usado" selected>Lista para la Venta</option> <!-- Ejemplo, la casa ya está lista para la venta -->
                </select>
            </div>
            <div class="mb-3">
                <label for="precio_casa" class="form-label">Precio de la Casa</label>
                <input type="number" class="form-control" id="precio_casa" name="precio_casa" value="100000" required> <!-- Ejemplo -->
            </div>
            <div class="mb-3">
                <label for="id_proyecto" class="form-label">Proyecto Asociado</label>
                <select class="form-control" id="id_proyecto" name="id_proyecto" required>
                    <option value="1" selected>Proyecto A</option> <!-- Ejemplo, este es el proyecto actual -->
                    <option value="2">Proyecto B</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary" id="actionEditarCasaButton">Guardar Cambios</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/casa.js"></script> <!-- Referencia al archivo JS externo -->
    
    <footer class="footer py-4">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        © 2024 | BYTE BUSTERS
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Lógica para guardar los cambios de la casa
        $("#actionEditarCasaButton").click(function() {
            var formData = $("#editarCasaForm").serialize(); // Obtener todos los datos del formulario

            // Puedes hacer una llamada AJAX para actualizar los datos en el servidor
            $.ajax({
                type: "POST",
                url: "actualizar_casa.php", // Aquí debes poner el archivo PHP que actualizará los datos en el servidor
                data: formData,
                success: function(response) {
                    alert("Los datos de la casa han sido actualizados correctamente.");
                    // Redirigir a la lista de casas o mostrar un mensaje de éxito
                    window.location.href = "casas_lista.php"; // Redirige a la página de lista de casas
                },
                error: function() {
                    alert("Hubo un error al actualizar los datos. Intenta nuevamente.");
                }
            });
        });
    </script>
</body>
</html>
