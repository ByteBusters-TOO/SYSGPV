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
    <title>Alertas</title>
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
    require_once '../models/mtoAlerta.php';

    $alerta = new Alerta();
    $alertas = $alerta->readAll();
    ?>

    <div class="container mt-5">
        <h2>Alertas</h2>
        
        <table class='table table-striped'>
            <tr>
                <th>Tipo de alerta</th>
                <th>Fecha</th>
                <th>Asunto</th>
                <th>Estado</th>
                <th>Casa asociada</th>
                <th>Proyecto asociado</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
            <?php if (count($alertas) > 0): ?>
                <?php foreach ($alertas as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row["tipo_alerta"]) ?></td>
                        <td><?= htmlspecialchars($row["fecha_alerta"]) ?></td>
                        <td><?= htmlspecialchars($row["asunto_alerta"]) ?></td>
                        <td><?= htmlspecialchars($row["estado_alerta"]) ?></td>
                        <td><?= htmlspecialchars($row["id_casa"]) ?></td>
                        <td><?= htmlspecialchars($row["id_proyecto"]) ?></td>
                        <td><?= htmlspecialchars($row["id_usuario"]) ?></td>
                        <td>
                            <a href='alertaEdit.php?id=<?= $row["id_alerta"] ?>' class='btn btn-primary btn-sm'>Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">No se encontraron resultados.</td></tr>
            <?php endif; ?>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/alerta.js"></script>
    
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
