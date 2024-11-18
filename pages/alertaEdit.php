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
            <!-- Campo oculto para almacenar el ID del proyecto -->
            <input type="hidden">
            <label for="tipoAlerta">Selecciona el tipo de alerta:</label>
            <select  id="tipoAlerta" class="form-select" aria-label="Default select example">
                <option selected>Tipo de alerta</option>
                <option value="1">Proyecto atrasado</option>
                <option value="2">Inactividad ventas de casa</option>
                <option value="3">Otro</option>
            </select>
            <div class="mb-3">
                <label for="fecha_alerta" class="form-label">Fecha de alerta:</label>
                <input type="date" class="form-control">
            </div>
            <div class="mb-3">
                <label for="asunto_alerta" class="form-label">Asunto:</label>
                <textarea class="form-control" rows="4"></textarea>
            </div>
            <label for="estadoAlerta">Selecciona el estado de alerta: </label>
            <select  id="estadoAlerta" class="form-select" aria-label="Default select example">
                <option selected>Estado de alerta</option>
                <option value="1">Alta</option>
                <option value="2">Media</option>
                <option value="3">Baja</option>
            </select>
            <div class="mb-3">
                <label for="casa_alerta" class="form-label">Casa:</label>
                <input type="text" class="form-control" >
            </div>
            <div class="mb-3">
                <label for="proyecto_alerta" class="form-label">Proyecto:</label>
                <input type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label for="id_usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" >
            </div>
            <button type="button" class="btn btn-info btn-sm" id="updateAlertaButton" style="min-width: 80px;">
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
