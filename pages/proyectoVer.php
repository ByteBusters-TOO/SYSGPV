
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
        
        <?php
    // Conexión a la base de datos y consulta (igual que en el ejemplo anterior)
    
    // Conexión a la base de datos (ajusta los datos según tu configuración)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sysgpv_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Consulta SQL para obtener los datos
    $sql = "SELECT * FROM proyecto";
    $result = $conn->query($sql);

    // Crear la tabla HTML
    echo "<table class='table table-striped'>";
    echo "<tr>
    <th>Nombre</th>
    <th>Descripción</th>
    <th>Ubicación</th>
    <th>Inicio</th>
    <th>Fin</th>
    <th>Acciones</th>

    </tr>";

    // Recorrer los resultados y crear las filas
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["nombre_proyecto"] . "</td>";
            echo "<td>" . $row["descripcion_proyecto"] . "</td>";
            echo "<td>" . $row["ubicacion_proyecto"] . "</td>";
            echo "<td>" . $row["fecha_inicio"] . "</td>";
            echo "<td>" . $row["fecha_fin"] . "</td>";
            echo " <td>
            <!-- Redirige a la página de edición pasando el ID del proyecto -->
            <a href='proyectoEdit.php?id=$[id_proyecto]' class='btn btn-primary btn-sm'>Editar</a>

            
        </td>";

            // ... y así sucesivamente para las demás columnas
            echo "</tr>";
        }
    } else {
        echo "0 results";
    }

    echo "</table>";

    $conn->close();



    echo "</table>";
    ?>

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


</body>
</html>
