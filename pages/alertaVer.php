<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Alarmas</title>
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
        <h2>Alarmas</h2>
        
        <table class='table table-striped'>
            <tr>
                <th>Tipo de alerta</th>
                <th>Fecha de alerta</th>
                <th>Asunto de alerta</th>
                <th>Estado de alerta</th>
                <th>Casa</th>
                <th>Proyecto</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
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
