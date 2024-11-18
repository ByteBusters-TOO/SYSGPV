<?php
session_start();
require_once '../models/mtoAlerta.php';

header('Content-Type: application/json');

$response = array();
$method = $_SERVER['REQUEST_METHOD'];

// Detectar si el método es PUT usando un campo en el formulario
if ($method == 'POST' && isset($_POST['_method']) && $_POST['_method'] == 'PUT') {
    $method = 'PUT';
}

try {
    $alertaModel = new Alerta();

    switch ($method) {
        case 'GET':
            if (isset($_GET['type'])) {
                switch ($_GET['type']) {
                    case 'proyecto':
                        $data = $alertaModel->getProyectos();
                        break;
                    case 'usuario':
                        $data = $alertaModel->getUsuarios();
                        break;
                    default:
                        throw new Exception('Tipo de datos no válido.');
                }
                $response = ['status' => 'success', 'data' => $data];
            } else {
                // Obtener todas las alertas o una específica
                $alertas = $alertaModel->readAll();
                $response = ['status' => 'success', 'data' => $alertas];
            }
            break;
        

        case 'POST':
            // Crear una nueva alerta
            try {
                $estado_alerta = $_POST['estado_alerta'] ?? null;
                $asunto_alerta = $_POST['asunto_alerta'] ?? null;
                $fecha_alerta = $_POST['fecha_alerta'] ?? null;
                $tipo_alerta = $_POST['tipo_alerta'] ?? null;
                $id_proyecto = $_POST['id_proyecto'] ?? null; 
                $id_usuario = $_POST['id_usuario'] ?? null;              

                // Validación de campos obligatorios
                if (!$tipo_alerta || !$fecha_alerta || !$asunto_alerta || !$estado_alerta) {
                    throw new Exception('Datos incompletos al guardar.');
                }
                
                if ($alertaModel->create($estado_alerta, $asunto_alerta, $fecha_alerta, $tipo_alerta, $id_proyecto, $id_usuario )) {
                    $response = ['status' => 'success', 'message' => 'Alerta creada con éxito.'];
                }  else {
                    throw new Exception('Error al crear la alerta.');
                }
            } catch (Exception $e) {
                $response = ['status' => 'error', 'message' => $e->getMessage()];
            }
            break;

        case 'PUT':
            // Actualizar una alerta
            try {
                $id_alerta = $_POST['id_alerta'] ?? null;
                $estado_alerta = $_POST['estado_alerta'] ?? null;
                $asunto_alerta = $_POST['asunto_alerta'] ?? null;
                $fecha_alerta = $_POST['fecha_alerta'] ?? null;
                $tipo_alerta = $_POST['tipo_alerta'] ?? null;
                $id_proyecto = $_POST['id_proyecto'] ?? null;
                $id_usuario = $_POST['id_usuario'] ?? null;

                // Validación de campos obligatorios
                if (!$tipo_alerta || !$fecha_alerta || !$asunto_alerta || !$estado_alerta) {
                    throw new Exception('Datos incompletos al actualizar.');
                }

                if ($alertaModel->update($id_alerta, $tipo_alerta, $fecha_alerta, $asunto_alerta, $estado_alerta, $id_proyecto, $id_usuario)) {
                    $response = ['status' => 'success', 'message' => 'Alerta actualizada con éxito.'];
                } else {
                    throw new Exception('Error al actualizar la alerta.');
                }
            } catch (Exception $e) {
                $response = ['status' => 'error', 'message' => $e->getMessage()];
            }
            break;

        case 'DELETE':
            // Eliminar una alerta
            $data = json_decode(file_get_contents("php://input"), true);
            if (!isset($data['id_alerta'])) {
                throw new Exception('Datos incompletos para eliminar.');
            }
            if ($alertaModel->delete($data['id_alerta'])) {
                $response = ['status' => 'success', 'message' => 'Alerta eliminada con éxito.'];
            } else {
                throw new Exception('Error al eliminar la alerta.');
            }
            break;

        default:
            throw new Exception('Método no permitido');
    }
} catch (Exception $e) {
    $response = ['status' => 'error', 'message' => $e->getMessage()];
}

echo json_encode($response);
?>
