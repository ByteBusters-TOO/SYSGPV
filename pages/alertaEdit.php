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
    <title>Alertas | SYSGPV</title>
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
        <h2>Editar Alerta</h2>

        <div class="mensaje mb-3"></div>

        <form id="createAlertaForm">
            <div class="mb-3">
                <label for="tipo_alerta" class="form-label">Seleccionar tipo de alerta:</label>
                <select id="tipo_alerta" name="estado_alerta" class="form-control" aria-label="Default select example">
                    <option selected>Tipo de alerta</option>
                    <option value="1">Proyecto atrasado</option>
                    <option value="2">Inactividad ventas de casa</option>
                    <option value="3">Otro</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="fecha_alerta" class="form-label">Fecha de alerta:</label>
                <input type="date" id="fecha_alerta" class="form-control">
            </div>
            <div class="mb-3">
                <label for="asunto_alerta" class="form-label">Asunto:</label>
                <textarea id="asunto_alerta" class="form-control" rows="4"></textarea>
            </div>
            <div class="mb-3">
                <label for="estado_alerta" class="form-label">Selecciona el estado de alerta:</label>
                <select id="estado_alerta" name="estado_alerta" class="form-control" aria-label="Default select example">
                    <option selected>Estado de alerta</option>
                    <option value="1">Alta</option>
                    <option value="2">Media</option>
                    <option value="3">Baja</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_proyecto" class="form-label">Proyecto asociado:</label>
                <select class="form-control" id="id_proyecto" name="id_proyecto" required>
                    <option value="">Seleccionar Proyecto</option>
                    <?php foreach ($proyectos as $proyecto): ?>
                        <option value="<?= $proyecto['id_proyecto'] ?>">
                            <?= htmlspecialchars($proyecto['nombre_proyecto']) ?> (<?= htmlspecialchars($proyecto['estado_proyecto']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_usuario" class="form-label">Usuario asignado para alerta:</label>
                <select id="id_usuario" name="id_usuario" class="form-control" required>
                <option value="">Seleccionar Usuario</option>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= $usuario['id_usuario'] ?>">
                            <?= htmlspecialchars($usuario['nombre_usuario']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="button" class="btn btn-info btn-sm mt-3" id="actionAlertaButton" style="min-width: 80px;">
                <i class="bi bi-pencil"></i> Guardar Alerta
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/alertaEdit.js"></script>

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
        // Pasar el ID de la alerta a alerta.js para cargar los datos
        var alertaId = <?php echo json_encode($_GET['id'] ?? null); ?>;
    </script>
</body>
</html>
