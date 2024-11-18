<?php
session_start();

// Redirigir según el rol del usuario
if ($_SESSION['tpu'] == 1) {
    // Si es Administrador, incluir el navbar de administrador
    include "../partials/navbar.html";
} elseif ($_SESSION['tpu'] == 2) {
    // Si es Dueño, redirigir al home del Dueño
    include "../partials/navbar-dueño.html";
    //header("Location: ../pages/homeDueño.php");
} else {
    // Si el rol no es reconocido, redirigir al inicio de sesión
    header("Location: ./index.php");
    exit;
}
require_once '../models/mtoEmpresaCompetencia.php';
    // Crear una instancia del modelo
    $empresaModel = new EmpresaModel();

    // Obtener todas las empresas
    $empresas = $empresaModel->readAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas</title>
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

<div class="container mt-5">
    <h2>Empresas de la competencia</h2>
    <a href="crearEmpresa.php" class="btn btn-primary">Crear nueva</a>

    <!-- Contenedor de mensaje -->
    <div class="mensaje mb-3"></div>

    <!-- Tabla de Empresas -->
    <table id="empresaTable" class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre de Empresa</th>
                <th>Ventas</th>
                <th>Proyectos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Verificar si hay empresas y mostrarlas en la tabla
            if (count($empresas) > 0) {
                foreach ($empresas as $empresa) {
                    echo "<tr>
                        <td>{$empresa['id_empresa']}</td>
                        <td>{$empresa['nombre_empresa']}</td>
                        <td>{$empresa['ventas_empresa']}</td>
                        <td>{$empresa['proyectos_empresa']}</td>
                        <td>
                            <a href='editarEmpresa.php?id=" . trim($empresa['id_empresa']) . "' class='btn btn-primary btn-sm'>Editar</a>
                            <button class='btn btn-danger btn-sm deleteButton' data-id='{$empresa['id_empresa']}'>Eliminar</button>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>No hay empresas registradas.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Modal de confirmación -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">¿Estás seguro?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Quieres eliminar esta empresa?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Mensajes -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Información</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="messageModalBody">
                <!-- Aquí se mostrará el mensaje -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/empresa.js"></script>

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
