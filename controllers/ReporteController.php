<?php
session_start();
require_once '../models/mtoReporte.php';

header('Content-Type: application/json');

$response = ['status' => 'error', 'message' => ''];
$tipoReporte = $_POST['tipoReporte'] ?? null;

if (!$tipoReporte) {
    echo json_encode(['status' => 'error', 'message' => 'Tipo de reporte no especificado.']);
    exit;
}

try {
    $reporteModel = new Reporte();

    switch ($tipoReporte) {
        case '1': // Ventas
            $data = $reporteModel->getVentas();
            $response = [
                'status' => 'success',
                'data' => [
                    'titulo' => 'Reporte de Ventas',
                    'contenido' => json_encode($data), // Convierte los datos en texto
                    'nombreArchivo' => 'Reporte_Ventas'
                ]
            ];
            break;

        case '2': // Casas
            $data = $reporteModel->getCasas();
            $response = [
                'status' => 'success',
                'data' => [
                    'titulo' => 'Reporte de Casas',
                    'contenido' => json_encode($data),
                    'nombreArchivo' => 'Reporte_Casas'
                ]
            ];
            break;

        case '3': // Proyectos
            $data = $reporteModel->getProyectos();
            $response = [
                'status' => 'success',
                'data' => [
                    'titulo' => 'Reporte de Proyectos',
                    'contenido' => json_encode($data),
                    'nombreArchivo' => 'Reporte_Proyectos'
                ]
            ];
            break;

        default:
            throw new Exception('Tipo de reporte no válido.');
    }
} catch (Exception $e) {
    $response = ['status' => 'error', 'message' => $e->getMessage()];
}

echo json_encode($response);
?>
