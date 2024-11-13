<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casas Listas para la Venta</title>
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
        <h2>Casas Listas para la Venta</h2>
        
        <!-- Contenedor de mensaje -->
        <div class="mensaje mb-3"></div>

        <!-- Tabla de casas -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Número de Casa</th>
                    <th>Estado</th>
                    <th>Precio</th>
                    <th>Proyecto Asociado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se listarán las casas registradas -->
                <tr>
                    <td>1</td>
                    <td>Casa 101</td>
                    <td>Lista para la Venta</td>
                    <td>$100,000</td>
                    <td>Proyecto A</td>
                    <td>
                        <!-- Botones para registrar la venta y editar -->
                        <button class="btn btn-success btn-sm" onclick="registrarVenta(1)">Registrar Venta</button>
                        <button class="btn btn-warning btn-sm" onclick="editarCasa(1)">Editar</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Casa 102</td>
                    <td>Lista para la Venta</td>
                    <td>$120,000</td>
                    <td>Proyecto B</td>
                    <td>
                        <button class="btn btn-success btn-sm" onclick="registrarVenta(2)">Registrar Venta</button>
                        <button class="btn btn-warning btn-sm" onclick="editarCasa(2)">Editar</button>
                    </td>
                </tr>
                <!-- Más filas de casas se agregarán aquí -->
            </tbody>
        </table>
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
        // Función para registrar que la casa se venderá
        function registrarVenta(casaId) {
            // Redirigir al archivo de venta
            window.location.href = "ventaR.php?id=" + casaId; // Redirige a ventaR.php con el ID de la casa
        }

        // Función para editar los detalles de la casa
        function editarCasa(casaId) {
            // Redirigir al archivo de edición
            window.location.href = "editarCasa.php?id=" + casaId; // Redirige a editarCasa.php con el ID de la casa
        }
    </script>
</body>
</html>
