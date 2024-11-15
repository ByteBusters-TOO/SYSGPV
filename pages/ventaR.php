<?php
// Verificar si los parámetros 'id' y 'precio' están presentes en la URL
$idCasa = isset($_GET['id']) ? $_GET['id'] : '';
$precioCasa = isset($_GET['precio']) ? $_GET['precio'] : '';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Venta de Casa</title>
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
        <h2>Registrar Venta de Casa</h2>

        <div class="mensaje mb-3"></div>

        <form id="registrarVentaForm">
            <div class="mb-3">
                <label for="fecha_venta" class="form-label">Fecha de Venta</label>
                <input type="date" class="form-control" id="fecha_venta" name="fecha_venta" required>
            </div>
            <div class="mb-3">
                <label for="monto_venta" class="form-label">Monto de Venta</label>
                <input type="number" class="form-control" id="monto_venta" name="monto_venta" value="<?php echo $precioCasa; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nombre_cliente" class="form-label">Nombre del Cliente</label>
                <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" required>
            </div>
            <div class="mb-3">
                <label for="apellido_cliente" class="form-label">Apellido del Cliente</label>
                <input type="text" class="form-control" id="apellido_cliente" name="apellido_cliente" required>
            </div>
            <div class="mb-3">
                <label for="correo_cliente" class="form-label">Correo del Cliente</label>
                <input type="email" class="form-control" id="correo_cliente" name="correo_cliente" required>
            </div>
            <div class="mb-3">
                <label for="telefono_cliente" class="form-label">Teléfono del Cliente</label>
                <input type="tel" class="form-control" id="telefono_cliente" name="telefono_cliente" required>
            </div>
            <div class="mb-3">
                <label for="id_casa" class="form-label">Casa a Vender</label>
                <input type="text" class="form-control" id="id_casa" name="id_casa" value="<?php echo htmlspecialchars($idCasa); ?>" readonly>
            </div>
            <button type="button" class="btn btn-primary" id="actionVentaButton">Registrar Venta</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/venta.js"></script>

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