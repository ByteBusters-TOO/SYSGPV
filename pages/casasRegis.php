<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Casa</title>
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
    require_once '../models/mtoProyecto.php'; // Asegúrate de que el archivo esté en la ruta correcta
    $proyectoModel = new Proyecto();
    $proyectos = $proyectoModel->readAll();  // Obtenemos todos los proyectos
    ?>

    <div class="container mt-5">
        <h2>Registrar Nueva Casa</h2>

        <div class="mensaje mb-3"></div>

        <form id="registrarCasaForm">
            <div class="mb-3">
                <label for="numero_casa" class="form-label">Número de Casa</label>
                <input type="text" class="form-control" id="numero_casa" name="numero_casa" required>
            </div>
            <div class="mb-3">
                <label for="estado_casa" class="form-label">Estado de la Casa</label>
                <select class="form-control" id="estado_casa" name="estado_casa" required>
                    <option value="En Construcción">En Construcción</option>
                    <option value="Lista para la Venta">Lista para la Venta</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="precio_casa" class="form-label">Precio de la Casa</label>
                <input type="number" class="form-control" id="precio_casa" name="precio_casa" required>
            </div>
            <div class="mb-3">
                <label for="id_proyecto" class="form-label">Proyecto Asociado</label>
                <select class="form-control" id="id_proyecto" name="id_proyecto" required>
                    <option value="">Seleccionar Proyecto</option>
                    <?php foreach ($proyectos as $proyecto): ?>
                        <option value="<?= $proyecto['id_proyecto'] ?>">
                            <?= htmlspecialchars($proyecto['nombre_proyecto']) ?> (<?= htmlspecialchars($proyecto['estado_proyecto']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="button" class="btn btn-primary" id="actionCasaButton">Guardar Casa</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/casa.js"></script>

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