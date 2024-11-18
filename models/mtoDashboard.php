<?php
// Conexión a la base de datos (ajusta según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sysgpv_db";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta SQL
$sql = "SELECT 
            e.nombre_empresa, 
            e.ventas_empresa, 
            e.proyectos_empresa, 
            (SELECT SUM(v.monto_venta) FROM ventas v) AS total_monto_vendido
        FROM empresacompetencia e";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar los datos en la tabla
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["nombre"] . "</td>
                <td>" . $row["venta"] . "</td>
                <td>" . $row["proyecto"] . "</td>
                <td>" . $row["total_monto_vendido"] . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No hay datos disponibles</td></tr>";
}

$conn->close();
?>
