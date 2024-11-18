<?php
  session_start();
  if (!isset($_SESSION['user']) || $_SESSION['tpu'] == 2)
      header("Location: ../pages/homeDueño.php");
  elseif (!isset($_SESSION['user']) || $_SESSION['tpu'] > 3) 
    header("Location: ./index.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Proyectos</title>
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
    require_once '../models/mtoProyecto.php';

    $proyecto = new Proyecto();
    $proyectos = $proyecto->readAll();
    ?>

    <div class="container mt-5">
        <h2>Proyectos</h2>
        
        <table class='table table-striped'>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Ubicación</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            <?php if (count($proyectos) > 0): ?>
                <?php foreach ($proyectos as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row["nombre_proyecto"]) ?></td>
                        <td><?= htmlspecialchars($row["descripcion_proyecto"]) ?></td>
                        <td><?= htmlspecialchars($row["ubicacion_proyecto"]) ?></td>
                        <td><?= htmlspecialchars($row["fecha_inicio"]) ?></td>
                        <td><?= htmlspecialchars($row["fecha_fin"]) ?></td>
                        <td><?= htmlspecialchars($row["estado_proyecto"]) ?></td>
                        <td>
                            <a href='proyectoEdit.php?id=<?= $row["id_proyecto"] ?>' class='btn btn-primary btn-sm'>Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">No se encontraron resultados</td></tr>
            <?php endif; ?>
        </table>
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
