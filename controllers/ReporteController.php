<?php
session_start();
require_once '../models/mtoReporte.php';
// Respuesta por defecto
header('Content-Type: application/json');
// Capturar los datos del formulario
$response = ['status' => 'error', 'message' => ''];
$tipo_reporte = $_POST['tipo_reporte'] ?? null;
$descripcion_reporte = $_POST['descripcion_reporte'] ?? null;
$fecha_generacion = $_POST['fecha_generacion'] ?? null;
// Validar tipo de reporte
if (!$tipo_reporte) {
    echo json_encode(['status' => 'error', 'message' => 'Tipo de reporte no especificado.']);
    exit;
}

try {
    $reporteModel = new Reporte();
 // Si el tipo de reporte es válido, proceder a manejar la lógica
    switch ($tipo_reporte) {
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
    }// Guardar el reporte en la base de datos
    if ($descripcion_reporte && $fecha_generacion) {
        $reporteModel->guardarReporte($tipo_reporte, $descripcion_reporte, $fecha_generacion);
        $response['message'] = 'Reporte generado y registrado correctamente.';
    } else {
        // Si faltan datos para el registro, solo se genera el reporte
        $response['message'] = 'Reporte generado pero no se registró en la base de datos (datos incompletos).';
    }

    
} catch (Exception $e) {
    $response = ['status' => 'error', 'message' => $e->getMessage()];
}

echo json_encode($response);
?>
