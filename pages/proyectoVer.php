<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <style>
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
        <h2>Proyectos</h2>
        
        <!-- Contenedor de mensaje -->
        <div class="mensaje mb-3"></div>

        <!-- Tabla de proyectos -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre del Proyecto</th>
                    <th>Descripción</th>
                    <th>Ubicación</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Finalización</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="proyectosList">
                <!-- Los datos de los proyectos serán insertados aquí mediante JavaScript -->
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/proyecto.js"></script> <!-- Referencia al archivo JS externo -->
    
    <footer class="footer py-4  ">
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
        // Ejemplo de cómo se podrían cargar los proyectos con JavaScript
        $(document).ready(function() {
            // Simulación de datos de proyectos
            const proyectos = [
                { id: 1, nombre: "Proyecto 1", descripcion: "Descripción del proyecto 1", ubicacion: "Ubicación 1", fechaInicio: "2024-01-01", fechaFin: "2024-12-31" },
                { id: 2, nombre: "Proyecto 2", descripcion: "Descripción del proyecto 2", ubicacion: "Ubicación 2", fechaInicio: "2024-02-15", fechaFin: "2024-11-30" }
            ];

            // Llenamos la tabla con los datos de los proyectos
            const proyectosList = $('#proyectosList');
            proyectos.forEach(proyecto => {
                proyectosList.append(`
                    <tr>
                        <td>${proyecto.nombre}</td>
                        <td>${proyecto.descripcion}</td>
                        <td>${proyecto.ubicacion}</td>
                        <td>${proyecto.fechaInicio}</td>
                        <td>${proyecto.fechaFin}</td>
                        <td>
                            <!-- Redirige a la página de edición pasando el ID del proyecto -->
                            <a href="proyectoEdit.php?id=${proyecto.id}" class="btn btn-primary btn-sm">Editar</a>

                            <!-- Formulario para eliminar el proyecto -->
                            <form action="eliminar-proyecto.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="${proyecto.id}">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este proyecto?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                `);
            });
        });
    </script>
</body>
</html>
