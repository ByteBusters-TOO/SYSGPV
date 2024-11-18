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

<?php
    include '../partials/navbar.html';
    require_once '../models/mtoEmpresaCompetencia.php';

    // Crear una instancia del modelo
    $empresaModel = new EmpresaModel();

    // Obtener todas las empresas
    $empresas = $empresaModel->readAll();
?>

<div class="container mt-5">
    <h2>Empresas</h2>

    <!-- Contenedor de mensaje -->
    <div class="mensaje mb-3"></div>

    <!-- Formulario de crear nueva empresa -->
<form id="crearEmpresaForm">
    <div class="mb-3">
        <label for="nombre_empresa" class="form-label">Nombre de la Empresa</label>
        <input type="text" class="form-control" id="nombre_empresa" required>
    </div>

    <div class="mb-3">
        <label for="ventas_empresa" class="form-label">Ventas</label>
        <textarea class="form-control" id="ventas_empresa" required></textarea>
    </div>

    <div class="mb-3">
        <label for="proyectos_empresa" class="form-label">Proyectos</label>
        <textarea class="form-control" id="proyectos_empresa" rows="4" required></textarea>
    </div>

    <button type="button" class="btn btn-primary" id="guardarEmpresa">Guardar</button>
</form>


</div>

<div class="modal" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Mensaje</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="messageModalBody">
                <!-- El mensaje se insertará aquí -->
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
