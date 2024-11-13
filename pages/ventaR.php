<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Venta de Casa</title>
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
        <h2>Registrar Venta de Casa</h2>
        
        <!-- Contenedor de mensaje -->
        <div class="mensaje mb-3"></div>

        <form id="registrarVentaForm">
            <div class="mb-3">
                <label for="fecha_venta" class="form-label">Fecha de Venta</label>
                <input type="date" class="form-control" id="fecha_venta" name="fecha_venta" required>
            </div>
            <div class="mb-3">
                <label for="monto_venta" class="form-label">Monto de Venta</label>
                <input type="number" class="form-control" id="monto_venta" name="monto_venta" required>
            </div>
            <div class="mb-3">
                <label for="id_cliente" class="form-label">Cliente</label>
                <select class="form-control" id="id_cliente" name="id_cliente" required>
                    <!-- Aquí se agregarán los clientes registrados -->
                    <option value="">Seleccionar Cliente</option>
                    <!-- Ejemplo de cliente: -->
                    <option value="1">Cliente 1</option>
                    <option value="2">Cliente 2</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_casa" class="form-label">Casa a Vender</label>
                <select class="form-control" id="id_casa" name="id_casa" required>
                    <!-- Aquí se agregarán las casas disponibles para la venta -->
                    <option value="">Seleccionar Casa</option>
                    <!-- Ejemplo de casa disponible: -->
                    <option value="1">Casa 101 - $100,000</option>
                    <option value="2">Casa 102 - $120,000</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary" id="actionVentaButton">Registrar Venta</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/venta.js"></script> <!-- Referencia al archivo JS externo -->
    
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