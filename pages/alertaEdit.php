<?php
  session_start();
  if (!isset($_SESSION['user']) || $_SESSION['tpu'] == 2)
      header("Location: ../pages/homeDueño.php");
  elseif (!isset($_SESSION['user']) || $_SESSION['tpu'] > 3) 
    header("Location: ./index.php");

    // Crear instancia del modelo y obtener los datos de alertas
    require_once '../models/mtoAlerta.php';
    
    if (isset($_GET['id'])) {
        $id_alerta = $_GET['id'];
    
        // Crear instancia del modelo y obtener los datos de alertas
        $alerta = new Alerta();
        $datosAlerta = $alerta->getAlertaPorId($id_alerta);
    }
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

        <form id="editAlertaForm">
            <div class="mb-3">
                <label for="tipo_alerta" class="form-label">Seleccionar tipo de alerta:</label>
                <select id="tipo_alerta" name="tipo_alerta" class="form-control">
                    <option value="1" <?php echo $datosAlerta['tipo_alerta'] == 1 ? 'selected' : ''; ?>>Proyecto atrasado</option>
                    <option value="2" <?php echo $datosAlerta['tipo_alerta'] == 2 ? 'selected' : ''; ?>>Inactividad ventas de casa</option>
                    <option value="3" <?php echo $datosAlerta['tipo_alerta'] == 3 ? 'selected' : ''; ?>>Otro</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="fecha_alerta" class="form-label">Fecha de alerta:</label>
                    <input type="date" id="fecha_alerta" class="form-control" 
                        value="<?php echo htmlspecialchars($datosAlerta['fecha_alerta']); ?>" required>
            </div>
            <div class="mb-3">
                 <label for="asunto_alerta" class="form-label">Asunto:</label>
                <textarea id="asunto_alerta" class="form-control" rows="4" required><?php echo htmlspecialchars($datosAlerta['asunto_alerta']); ?></textarea>
             </div>
            <div class="mb-3">
                <label for="estado_alerta" class="form-label">Selecciona el estado de alerta:</label>
                <select id="estado_alerta" name="estado_alerta" class="form-control">
                    <option value="1" <?php echo $datosAlerta['estado_alerta'] == 1 ? 'selected' : ''; ?>>Alta</option>
                    <option value="2" <?php echo $datosAlerta['estado_alerta'] == 2 ? 'selected' : ''; ?>>Media</option>
                    <option value="3" <?php echo $datosAlerta['estado_alerta'] == 3 ? 'selected' : ''; ?>>Baja</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_proyecto" class="form-label">Proyecto Asociado</label>
                <select class="form-control" id="id_proyecto" name="id_proyecto" required>
                    <option value="<?php echo $datosAlerta['id_proyecto']; ?>" selected>
                        <?php echo $datosAlerta['nombre_proyecto']; ?>
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_usuario" class="form-label">Usuario asignado para alerta:</label>
                <select class="form-control" id="id_usuario" name="id_usuario" required>
                    <option value="<?php echo $datosAlerta['id_usuario']; ?>" selected>
                        <?php echo $datosAlerta['nombre_usuario']; ?>
                    </option>
                </select>
            </div>

            <button type="button" class="btn btn-info btn-sm mt-3" id="editAlertaButton" style="min-width: 80px;">
            <i class="bi bi-save"></i> Actualizar Alerta
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
