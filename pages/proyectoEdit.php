<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proyecto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Estilo adicional para la marca de copyright */
        .copyright {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: right;
            padding: 10px 10px;
            color: #6c757d; /* Color del texto */
        }
    </style>
</head>
<body>
    <?php include '../partials/navbar.html'; ?>

    <div class="container mt-5">
        <h2>Editar Proyecto</h2>
        
        <!-- Contenedor de mensaje -->
        <div class="mensaje mb-3"></div>

        <form id="editarProyectoForm">
            <div class="mb-3">
                <label for="nombre_proyecto" class="form-label">Nombre del Proyecto</label>
                <input type="text" class="form-control" id="nombre_proyecto" name="nombre_proyecto" required>
            </div>
            <div class="mb-3">
                <label for="descripcion_proyecto" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion_proyecto" name="descripcion_proyecto" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="ubicacion_proyecto" class="form-label">Ubicación</label>
                <textarea class="form-control" id="ubicacion_proyecto" name="ubicacion_proyecto" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
            </div>
            <div class="mb-3">
                <label for="fecha_fin" class="form-label">Fecha de Finalización</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
            </div>
            <button type="button" class="btn btn-primary" id="updateProyectoButton">Actualizar Proyecto</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/proyecto.js"></script> <!-- Referencia al archivo JS externo -->
    
    <!-- Div de copyright -->
    <div class="copyright">
        © 2024 | BYTE BUSTERS
    </div>

    <script>
        // Ejemplo de cómo se podrían cargar los datos del proyecto a editar con JavaScript
        $(document).ready(function() {
            // Simulación de datos de un proyecto cargado desde la base de datos o API
            const proyecto = {
                nombre: "Proyecto Ejemplo",
                descripcion: "Descripción del proyecto ejemplo",
                ubicacion: "Ubicación ejemplo",
                fechaInicio: "2024-01-01",
                fechaFin: "2024-12-31"
            };

            // Poblamos el formulario con los datos del proyecto
            $('#nombre_proyecto').val(proyecto.nombre);
            $('#descripcion_proyecto').val(proyecto.descripcion);
            $('#ubicacion_proyecto').val(proyecto.ubicacion);
            $('#fecha_inicio').val(proyecto.fechaInicio);
            $('#fecha_fin').val(proyecto.fechaFin);

            // Aquí puedes añadir el código para actualizar el proyecto al hacer clic en "Actualizar Proyecto"
            $('#updateProyectoButton').on('click', function() {
                // Aquí iría la lógica para enviar los datos actualizados a la base de datos o API
                alert('Proyecto actualizado con éxito.');
            });
        });
    </script>
</body>
</html>
