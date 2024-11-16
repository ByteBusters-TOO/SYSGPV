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
    ?>


<div class="container mt-5">
        <h2>Empresa</h2>
        
        <!-- Contenedor de mensaje -->
        <div class="mensaje mb-3"></div>

        <form id="crearProyectoForm">
            <div class="mb-3">
                <label for="nombre_proyecto" class="form-label">Nombre</label>
                <input type="text" class="form-control" required>
            </div>
           
            <div class="mb-3">
                <label for="ubicacion_proyecto" class="form-label">Ventas</label>
                <textarea class="form-control"></textarea>
            </div>
           
            <div class="mb-3">
                <label for="descripcion_proyecto" class="form-label">Proyectos</label>
                <textarea class="form-control" id="descripcion_proyecto" name="descripcion_proyecto" rows="4" required></textarea>
            </div>
            <button type="button" class="btn btn-primary">Guardar   </button>
        </form>



        <table class='table table-striped'>
            <tr>
                <th>Nombre</th>
                <th>Ventas</th>
                <th>Proyecto</th>
                <th>Acciones</th>
            </tr>



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