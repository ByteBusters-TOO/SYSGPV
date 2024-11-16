<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alarma</title>
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
        <h2>Editar Alarma</h2>

        <div class="mensaje mb-3"></div>

        <form id="editarProyectoForm">
            <!-- Campo oculto para almacenar el ID del proyecto -->
            <input type="hidden">
            <label for="tipoAlerta">Selecciona el tipo de alerta</label>
            <select  id="tipoAlerta" class="form-select" aria-label="Default select example">
                <option selected>Tipo de alerta</option>
                <option value="1">Alerta 1</option>
                <option value="2">Alerta 2</option>
                <option value="2">Alerta 3</option>
            </select>
            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de alerta</label>
                <input type="date" class="form-control">
            </div>
            <div class="mb-3">
                <label for="ubicacion_proyecto" class="form-label">Asunto</label>
                <textarea class="form-control" rows="4"></textarea>
            </div>
          
            <label for="estadoAlerta">Selecciona el estado de alerta</label>
            <select  id="estadoAlerta" class="form-select" aria-label="Default select example">
                <option selected>Estado de alerta</option>
                <option value="1">Estado 1</option>
                <option value="2">Estado 2</option>
                <option value="2">Estado 3</option>
            </select>
            
            <div class="mb-3">
                <label for="nombre_proyecto" class="form-label">Casa</label>
                <input type="text" class="form-control" >
            </div>
            <div class="mb-3">
                <label for="nombre_proyecto" class="form-label">Proyecto</label>
                <input type="text" class="form-control" >
            </div>
            <div class="mb-3">
                <label for="nombre_proyecto" class="form-label">Usuario</label>
                <input type="text" class="form-control" >
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
