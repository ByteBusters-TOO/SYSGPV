<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    require_once '../models/mtoVenta.php'; // Incluye el modelo de ventas
    require_once '../models/mtoEmpresaCompetencia.php';
    require_once '../models/mtoProyecto.php';
    

    // Crear una instancia del modelo
    $ventasModel = new Venta();
    $proyectosModel = new Proyecto();

    // Obtener el total 
    $totalVentas = $ventasModel->getTotalVentas();
    $totalProyectos = $proyectosModel->getTotalProyectos();

    // Obtener los datos de la tabla de empresas como antes
    $empresaModel = new EmpresaModel();
    $empresas = $empresaModel->readAll();
?>



    <!-- offcanvas -->
    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h4>Dashboard</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body py-5">Historial de ventas</div>
                        <div class="card-footer d-flex">
                        <a class="nav-link" href="ventaH.php?action=ver">Ver detalles</a>
                            <span class="ms-auto">
                                <i class="bi bi-chevron-right"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-body py-5">Todos los proyectos</div>
                        <div class="card-footer d-flex">
                        <a class="nav-link" href="proyectoVer.php?action=ver">Ver detalles</a>
                            <span class="ms-auto">
                                <i class="bi bi-chevron-right"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body py-5">Empresas de la competencias</div>
                        <div class="card-footer d-flex">
                        <a class="nav-link" href="empresas.php?action=ver">Ver detalles</a>
                            <span class="ms-auto">
                                <i class="bi bi-chevron-right"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-danger text-white h-100">
                        <div class="card-body py-5">Reportes</div>
                        <div class="card-footer d-flex">
                        <a class="nav-link" href="reportesH.php?action=ver">Ver detalles</a>
                            <span class="ms-auto">
                                <i class="bi bi-chevron-right"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <div class="card-header">
                            <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                            Empresas competencias vs Mi empresa (Venta)
                        </div>
                        <div class="card-body">
                            <canvas id="chart"  class="chart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <div class="card-header">
                            <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                            Empresas competencias vs Mi empresa (Proyectos)
                        </div>
                        <div class="card-body">
                            <canvas id="chart2" class="chart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <span><i class="bi bi-table me-2"></i></span> Empresas competencias
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                               <!-- Tabla de Empresas -->
    <table id="empresaTable" class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre de Empresa</th>
                <th>Ventas</th>
                <th>Proyectos</th>
                
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>




    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/empresa.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- Ejemplo de llenado de grafico con las edades -->
    <script>
// Función para extraer los datos de la tabla de empresas (para ventas)
function getDataFromTableVentas(empresaTable) {
    const table = document.getElementById(empresaTable);
    const labels = [];
    const data = [];

    // Itera sobre las filas de la tabla
    const rows = table.querySelectorAll("tbody tr");
    rows.forEach(row => {
        const cells = row.querySelectorAll("td");
        labels.push(cells[1].innerText); // Segunda columna (Nombre de la Empresa) como etiquetas
        data.push(parseFloat(cells[2].innerText)); // Tercera columna (Ventas) como datos
    });

    return { labels, data };
}

// Función para generar el gráfico de ventas
function generateChartVentas(chartId, labels, data, totalVentas) {
    const ctx = document.querySelector(`#${chartId}`).getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels.concat("Construyendo futuros"), // Añadimos "Mi Empresa" al final de las etiquetas
            datasets: [
                {
                    label: 'Ventas de Empresas',
                    data: data.concat(totalVentas), // Añadimos el total de ventas a los datos
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de las barras
                    borderColor: 'rgba(54, 162, 235, 1)', // Borde de las barras
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Función para extraer los datos de la tabla de proyectos (para proyectos)
function getDataFromTableProyectos(empresaTable) {
    const table = document.getElementById(empresaTable);
    const labels = [];
    const data = [];

    // Itera sobre las filas de la tabla
    const rows = table.querySelectorAll("tbody tr");
    rows.forEach(row => {
        const cells = row.querySelectorAll("td");
        labels.push(cells[1].innerText); // Segunda columna (Nombre de la Empresa) como etiquetas
        data.push(parseFloat(cells[3].innerText)); // Cuarta columna (Proyectos) como datos
    });

    return { labels, data };
}

// Función para generar el gráfico de proyectos
function generateChartProyectos(chartId, labels, data, totalProyectos) {
    const ctx = document.querySelector(`#${chartId}`).getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels.concat("Mi Empresa"), // Añadimos "Mi Empresa" al final de las etiquetas
            datasets: [
                {
                    label: 'Proyectos de Empresas',
                    data: data.concat(totalProyectos), // Añadimos el total de proyectos a los datos
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Color de las barras
                    borderColor: 'rgba(75, 192, 192, 1)', // Borde de las barras
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Ejecuta las funciones cuando la página cargue
document.addEventListener('DOMContentLoaded', () => {
    const tableDataVentas = getDataFromTableVentas('empresaTable'); // Extrae los datos de la tabla de ventas
    const tableDataProyectos = getDataFromTableProyectos('empresaTable'); // Extrae los datos de la tabla de proyectos

    const totalVentas = <?php echo $totalVentas; ?>; // Pasa el total de ventas desde PHP
    const totalProyectos = <?php echo $totalProyectos; ?>; // Pasa el total de proyectos desde PHP

    generateChartVentas('chart', tableDataVentas.labels, tableDataVentas.data, totalVentas); // Genera el gráfico de ventas
    generateChartProyectos('chart2', tableDataProyectos.labels, tableDataProyectos.data, totalProyectos); // Genera el gráfico de proyectos
});
</script>





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