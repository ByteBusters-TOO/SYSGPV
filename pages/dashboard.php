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
                        <div class="card-body py-5">Empresas</div>
                        <div class="card-footer d-flex">
                        <a class="nav-link" href="Verempresas.php?action=ver">Ver detalles</a>
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
                            Grafica 1
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
                            Grafica 2
                        </div>
                        <div class="card-body">
                            <canvas id="chart" class="chart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <span><i class="bi bi-table me-2"></i></span> Data Table
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data-table"  class="table table-striped data-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                        </tr>
                                        <tr>
                                            <td>Garrett Winters</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>40</td>
                                            <td>2011/07/25</td>
                                            <td>$170,750</td>
                                        </tr>
                                        <tr>
                                            <td>Ashton Cox</td>
                                            <td>Junior Technical Author</td>
                                            <td>San Francisco</td>
                                            <td>20</td>
                                            <td>2009/01/12</td>
                                            <td>$86,000</td>
                                        </tr>
                                        
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>




    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/proyecto.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- Ejemplo de llenado de grafico con las edades -->
        <script>
            // Obtén datos de la tabla
// Función para extraer datos de la tabla
function getDataFromTable(tableId) {
    const table = document.getElementById(tableId);
    const labels = [];
    const data = [];

    // Itera sobre las filas del cuerpo de la tabla
    const rows = table.querySelectorAll("tbody tr");
    rows.forEach(row => {
        const cells = row.querySelectorAll("td");
        labels.push(cells[0].innerText); // Primera columna (Name) como etiquetas
        data.push(parseInt(cells[3].innerText)); // Cuarta columna (Age) como datos
    });

    return { labels, data };
}

// Función para generar el gráfico
function generateChart(chartId, labels, data) {
    const ctx = document.querySelector(`#${chartId}`).getContext('2d');
    new Chart(ctx, {
        type: 'bar', // Tipo de gráfico (puedes cambiarlo a 'line' o 'area')
        data: {
            labels: labels,
            datasets: [{
                label: 'Edades',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de las barras
                borderColor: 'rgba(54, 162, 235, 1)', // Borde de las barras
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true // Comenzar desde cero en el eje Y
                }
            }
        }
    });
}

// Ejecuta las funciones cuando la página cargue
document.addEventListener('DOMContentLoaded', () => {
    const tableData = getDataFromTable('data-table'); // Extrae los datos de la tabla
    generateChart('chart', tableData.labels, tableData.data); // Genera el gráfico
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