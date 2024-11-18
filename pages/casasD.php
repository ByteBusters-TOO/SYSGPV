<?php

session_start();
if (!isset($_SESSION['user']) || $_SESSION['tpu'] == 2)
    header("Location: ../pages/homeDueño.php");
elseif (!isset($_SESSION['user']) || $_SESSION['tpu'] > 3) 
  header("Location: ./index.php");

require_once '../models/mtoCasa.php';

// Crear instancia del modelo
$casa = new Casa();

// Obtener las casas disponibles para la venta
$casasDisponibles = $casa->getCasasDisponibles();

?>

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
            color: #6c757d;
            /* Color del texto */
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
                <?php foreach ($casasDisponibles as $casa): ?>
                    <tr>
                        <td><?php echo $casa['id_casa']; ?></td>
                        <td><?php echo $casa['numero_casa']; ?></td>
                        <td><?php echo $casa['estado_casa']; ?></td>
                        <td>$<?php echo number_format($casa['precio_casa'], 2); ?></td>
                        <td><?php echo $casa['id_proyecto']; ?></td>
                        <td>
                            <button class="btn btn-success btn-sm" onclick="registrarVenta(<?php echo $casa['id_casa']; ?>, <?php echo $casa['precio_casa']; ?>)">Registrar Venta</button>
                            <button class="btn btn-warning btn-sm" onclick="editarCasa(<?php echo $casa['id_casa']; ?>)">Editar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
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
         // Función para registrar la venta de una casa, redirigiendo a ventaR.php con el ID y el precio de la casa
         function registrarVenta(casaId, precioCasa) {
            // Redirigir a ventaR.php con el ID y precio de la casa como parámetros en la URL
            window.location.href = "ventaR.php?id=" + casaId + "&precio=" + precioCasa;
        }

        // Función para editar los detalles de la casa
        function editarCasa(casaId) {
            // Redirigir al archivo de edición
            window.location.href = "editarCasa.php?id=" + casaId; // Redirige a editarCasa.php con el ID de la casa
        }
    </script>
</body>

</html>