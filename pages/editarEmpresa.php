<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empresa</title>
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

?>

<div class="container mt-5">
        <h2>Editar Empresa</h2>

        <div class="mensaje mb-3"></div>

        <form id="editarEmpresaForm">
            <!-- Campo oculto para almacenar el ID del empresa -->
            <input type="hidden" id="id_empresa" name="id_empresa">
            <div class="mb-3">
                <label for="nombre_empresa" class="form-label">Nombre de la empresa</label>
                <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" >
            </div>
            <div class="mb-3">
                <label for="ventas_empresa" class="form-label">Ventas</label>
                <textarea class="form-control" id="ventas_empresa" name="ventas_empresa" ></textarea>
            </div>
            <div class="mb-3">
                <label for="proyectos_empresa" class="form-label">Proyectos</label>
                <textarea class="form-control" id="proyectos_empresa" name="proyectos_empresa" ></textarea>
            </div>
            
            <button type="button" class="btn btn-primary" id="updateEmpresaButton">Actualizar empresa</button>
        </form>
    </div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/empresaE.js"></script>

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
