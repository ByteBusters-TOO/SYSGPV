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

    <?php
    include '../partials/navbar.html';
    ?>

    <div class="container mt-5">
        <h2>Reportes</h2>

        <div class="mensaje mb-3"></div>

        <form>

            <select class="form-select" aria-label="Default select example">
                <option selected>Tipo de reporte</option>
                <option value="1">Ventas</option>
                <option value="2">Casas</option>
                <option value="2">Proyectos</option>
            </select>
            <div class="mb-3">
                <label for="descripcion_proyecto" class="form-label">Descripción de reporte</label>
                <textarea class="form-control" rows="4"
                    required></textarea>
            </div>
            <div class="mb-3">
                <label for="fecha_fin" class="form-label">Fecha de Generacion</label>
                <input type="date" class="form-control">
            </div>
            <div class="mb-3">
                <label for="nombre_proyecto" class="form-label">Usuario</label>
                <input type="text" class="form-control" >
            </div>
            <div class="mb-3">
                <label for="nombre_proyecto" class="form-label">Proyecto</label>
                <input type="text" class="form-control" >
            </div>
            <div class="mb-3">
                <label for="nombre_proyecto" class="form-label">Casa</label>
                <input type="text" class="form-control">
            </div>

            <button type="button" class="btn btn-primary">Generar reporte</button>
        </form>
    </div>


























    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/proyecto.js"></script>

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