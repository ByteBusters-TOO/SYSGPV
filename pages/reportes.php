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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
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

    <div class="container mt-5">
        <h2>Reportes</h2>

        <div class="mensaje mb-3"></div>

        <form id="reporteForm">
            <label for="tipo_reporte">Selecciona el tipo de reporte</label>
            <select id="tipo_reporte" name="tipo_reporte" class="form-select" aria-label="Default select example">
                <option selected disabled>Tipo de reporte</option>
                <option value="1">Ventas</option>
                <option value="2">Casas</option>
                <option value="3">Proyectos</option>
            </select>
            <div class="mb-3">
                <label for="descripcion_reporte" class="form-label">Descripción de reporte</label>
                <textarea id="descripcion_reporte" name="descripcion_reporte" class="form-control" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="fecha_generacion" class="form-label">Fecha de Generación</label>
                <input type="date" id="fecha_generacion" name="fecha_generacion" class="form-control" required>
            </div>
            <button type="button" id="generarReporteButton" class="btn btn-primary">Generar reporte</button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>



    <script src="../js/reportes.js"></script>

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
</body>

</html>