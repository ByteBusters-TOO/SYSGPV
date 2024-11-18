<?php

session_start();
if (!isset($_SESSION['user']) || $_SESSION['tpu'] == 2)
    header("Location: ../pages/homeDueño.php");
elseif (!isset($_SESSION['user']) || $_SESSION['tpu'] > 3) 
  header("Location: ./index.php");

require_once '../models/mtoCasa.php';

// Verificar que el ID esté presente en la URL
if (isset($_GET['id'])) {
    $id_casa = $_GET['id'];

    // Crear instancia del modelo y obtener los datos de la casa
    $casa = new Casa();
    $datosCasa = $casa->getCasaPorId($id_casa);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Casa</title>
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
        <h2>Editar Casa</h2>
         <!-- Contenedor para mensajes -->
         <div class="mensaje mb-3"></div>

        <!-- Formulario para editar los detalles de la casa -->
        <form id="editarCasaForm">
            <!-- Campo oculto para el ID de la casa -->
            <input type="hidden" id="id_casa" name="id_casa" value="<?php echo $datosCasa['id_casa']; ?>">

            <div class="mb-3">
                <label for="numero_casa" class="form-label">Número de Casa</label>
                <input type="text" class="form-control" id="numero_casa" name="numero_casa" 
                       value="<?php echo $datosCasa['numero_casa']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="estado_casa" class="form-label">Estado de la Casa</label>
                <select class="form-control" id="estado_casa" name="estado_casa" required>
                    <option value="En Construcción" <?php echo ($datosCasa['estado_casa'] == 'En Construcción') ? 'selected' : ''; ?>>En Construcción</option>
                    <option value="Lista para la Venta" <?php echo ($datosCasa['estado_casa'] == 'Lista para la Venta') ? 'selected' : ''; ?>>Lista para la Venta</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="precio_casa" class="form-label">Precio de la Casa</label>
                <input type="number" class="form-control" id="precio_casa" name="precio_casa" 
                       value="<?php echo $datosCasa['precio_casa']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="id_proyecto" class="form-label">Proyecto Asociado</label>
                <select class="form-control" id="id_proyecto" name="id_proyecto" required>
                    <option value="<?php echo $datosCasa['id_proyecto']; ?>" selected>
                        <?php echo $datosCasa['nombre_proyecto']; ?>
                    </option>
                </select>
            </div>

            <button type="button" class="btn btn-primary" id="editarCasaButton">Guardar Cambios</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/editarCasa.js"></script>
</body>
</html>
