<?php
session_start();

// Verificar si la sesión está activa
if (!isset($_SESSION['user'])) {
    // Si no hay sesión activa, redirigir al login
    header("Location: ./index.php");
    exit;
}

// Redirigir según el rol del usuario
if ($_SESSION['tpu'] == 1) {
    // Si es Administrador, incluir el navbar de administrador
    include "../partials/navbar.html";
} elseif ($_SESSION['tpu'] == 2) {
    // Si es Dueño, redirigir al home del Dueño
    include "../partials/navbar-dueño.html";
    //header("Location: ../pages/homeDueño.php");
} else {
    // Si el rol no es reconocido, redirigir al inicio de sesión
    header("Location: ./index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Proyecto</title>
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
            color: #6c757d;
            /* Color del texto */
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h2>Crear Nuevo Proyecto</h2>

        <!-- Contenedor de mensaje -->
        <div class="mensaje mb-3"></div>

        <form id="crearProyectoForm">
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
            <div class="mb-3">
                <label for="estado_proyecto" class="form-label">Estado del Proyecto</label>
                <select class="form-control" id="estado_proyecto" name="estado_proyecto">
                    <option value="">Seleccione un estado</option>
                    <option value="En curso">En curso</option>
                    <option value="Completado">Completado</option>
                    <option value="Atrasado">Atrasado</option>
                </select>
            </div>
            <button type="button" class="btn btn-info btn-sm" id="actionProyectoButton" style="min-width: 80px;">
                <i class="bi bi-pencil"></i> Guardar Proyecto
            </button>


        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/proyecto.js"></script> <!-- Referencia al archivo JS externo -->
    <footer class="footer py-4  ">
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
</body>

</html>