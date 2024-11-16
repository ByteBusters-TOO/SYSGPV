<?php
// Incluir el modelo de ventas
require_once '../models/mtoVenta.php';

// Crear instancia del modelo de ventas
$venta = new Venta();

// Obtener el historial de ventas
$ventas = $venta->getHistorialVentas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Reportes</title>
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
        }
    </style>
</head>
<body>
    <?php include '../partials/navbar.html'; ?>

    <div class="container mt-5">
        <h2>Historial de Reportes</h2>

        <!-- Contenedor de mensaje -->
        <div class="mensaje mb-3"></div>

        <!-- Tabla de ventas -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tipo de reporte</th>
                    <th>Descripcion de reporte</th>
                    <th>Fecha de generacion</th>
                    <th>Usuario</th>
                    <th>Proyecto</th>
                    <th>Casa</th>
                    
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se listarán los reportes registradas -->
                
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    

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
