<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proyecto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .copyright {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: right;
            padding: 10px 10px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <?php include '../partials/navbar.html'; ?>

    <div class="container mt-5">
        <h2>Editar Proyecto</h2>

        <div class="mensaje mb-3"></div>

        <form id="editarProyectoForm">
            <!-- Campo oculto para almacenar el ID del proyecto -->
            <input type="hidden" id="id_proyecto" name="id_proyecto">
            <div class="mb-3">
                <label for="nombre_proyecto" class="form-label">Nombre del Proyecto</label>
                <input type="text" class="form-control" id="nombre_proyecto" name="nombre_proyecto" required>
            </div>
            <div class="mb-3">
                <label for="descripcion_proyecto" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion_proyecto" name="descripcion_proyecto" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="ubicacion_proyecto" class="form-label">Ubicación</label>
                <textarea class="form-control" id="ubicacion_proyecto" name="ubicacion_proyecto" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
            </div>
            <div class="mb-3">
                <label for="fecha_fin" class="form-label">Fecha de Finalización</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
            </div>
            <button type="button" class="btn btn-primary" id="updateProyectoButton">Actualizar Proyecto</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/proyectoE.js"></script>

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
        // Pasar el ID del proyecto a proyecto.js para cargar los datos
        var projectId = <?php echo json_encode($_GET['id'] ?? null); ?>;
    </script>
</body>
</html>
