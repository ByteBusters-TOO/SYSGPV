<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Ventas</title>
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
        <h2>Historial de Ventas</h2>
        
        <!-- Contenedor de mensaje -->
        <div class="mensaje mb-3"></div>

        <!-- Tabla de ventas -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha de Venta</th>
                    <th>Monto</th>
                    <th>Cliente</th>
                    <th>Casa Vendida</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se listarán las ventas registradas -->
                <tr>
                    <td>1</td>
                    <td>2024-11-01</td>
                    <td>$100,000</td>
                    <td>Cliente 1</td>
                    <td>Casa 101</td>
                    <td>
                        <!-- Botón para ver detalles de la venta (puedes agregar lógica de ver detalles) -->
                        <button class="btn btn-info btn-sm" onclick="verDetallesVenta(1)">Ver Detalles</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>2024-11-05</td>
                    <td>$120,000</td>
                    <td>Cliente 2</td>
                    <td>Casa 102</td>
                    <td>
                        <button class="btn btn-info btn-sm" onclick="verDetallesVenta(2)">Ver Detalles</button>
                    </td>
                </tr>
                <!-- Más filas de ventas se agregarán aquí -->
            </tbody>
        </table>
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

    <script>
        // Función para ver detalles de la venta
        function verDetallesVenta(ventaId) {
            // Lógica para ver detalles de la venta, como mostrar un modal o redirigir a otra página
            alert('Ver detalles de la venta con ID ' + ventaId);
            // Puedes redirigir a otra página que contenga detalles específicos de la venta
            // window.location.href = 'detallesVenta.php?id=' + ventaId;
        }
    </script>
</body>
</html>
