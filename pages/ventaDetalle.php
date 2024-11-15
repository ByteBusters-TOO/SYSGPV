<?php
// Incluir el modelo de ventas
require_once '../models/mtoVenta.php';

// Validar que el ID de la venta esté en la URL
if (!isset($_GET['id'])) {
    die('ID de venta no proporcionado.');
}

// Obtener el ID de la venta
$id_venta = $_GET['id'];

// Crear instancia del modelo de ventas
$venta = new Venta();

// Obtener los detalles de la venta
$detallesVenta = $venta->getDetalleVenta($id_venta);

// Verificar si se encontró la venta
if (!$detallesVenta) {
    die('No se encontraron detalles para la venta seleccionada.');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../partials/navbar.html'; ?>

    <div class="container mt-5">
        <h2>Detalles de la Venta</h2>

        <!-- Tabla con los detalles de la venta -->
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>ID Venta</th>
                    <td><?php echo $detallesVenta['id_venta']; ?></td>
                </tr>
                <tr>
                    <th>Fecha de Venta</th>
                    <td><?php echo $detallesVenta['fecha_venta']; ?></td>
                </tr>
                <tr>
                    <th>Monto</th>
                    <td>$<?php echo number_format($detallesVenta['monto_venta'], 2); ?></td>
                </tr>
                <tr>
                    <th>Cliente</th>
                    <td><?php echo $detallesVenta['nombre_cliente'] . ' ' . $detallesVenta['apellido_cliente']; ?></td>
                </tr>
                <tr>
                    <th>Correo</th>
                    <td><?php echo $detallesVenta['correo_cliente']; ?></td>
                </tr>
                <tr>
                    <th>Teléfono</th>
                    <td><?php echo $detallesVenta['telefono_cliente']; ?></td>
                </tr>
                <tr>
                    <th>Casa</th>
                    <td><?php echo $detallesVenta['numero_casa']; ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Botón para regresar al historial -->
        <a href="ventaH.php" class="btn btn-secondary">Regresar al Historial</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
