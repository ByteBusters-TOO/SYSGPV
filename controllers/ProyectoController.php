<?php
session_start();

require_once '../models/mtoProyecto.php';

header('Content-Type: application/json');

$response = array();
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST' && isset($_POST['_method']) && $_POST['_method'] == 'PUT') {
    $method = 'PUT';
}

try {
    $proyectoModel = new Proyecto();

    switch ($method) {
        case 'GET':
            if (isset($_GET['id'])) {
                $response = $proyectoModel->read($_GET['id']);
            } else {
                $response = $proyectoModel->readAll();
            }
            break;

        case 'POST':
            try {
                var_dump($_POST); // Depuración: Verificar datos recibidos en el servidor
                $nombre_proyecto = $_POST['nombre_proyecto'];
                $descripcion_proyecto = $_POST['descripcion_proyecto'];
                $ubicacion_proyecto = $_POST['ubicacion_proyecto'];
                $fecha_inicio = $_POST['fecha_inicio'];
                $fecha_fin = $_POST['fecha_fin'];

                if (!isset($nombre_proyecto) || !isset($descripcion_proyecto) || !isset($fecha_inicio)) {
                    throw new Exception('Datos incompletos al guardar');
                }

                $proyectoModel->create($nombre_proyecto, $descripcion_proyecto, $ubicacion_proyecto, $fecha_inicio, $fecha_fin);
                $response = ['status' => 'success', 'message' => 'Proyecto creado con éxito'];
            } catch (Exception $e) {
                $response = ['status' => 'error', 'message' => $e->getMessage()];
            }
            break;

        case 'PUT':
            try {
                var_dump($_POST); // Depuración: Verificar datos recibidos en el servidor para la actualización
                $id_proyecto = $_POST['id_proyecto'];
                $nombre_proyecto = $_POST['nombre_proyecto'];
                $descripcion_proyecto = $_POST['descripcion_proyecto'];
                $ubicacion_proyecto = $_POST['ubicacion_proyecto'];
                $fecha_inicio = $_POST['fecha_inicio'];
                $fecha_fin = $_POST['fecha_fin'];

                if (!isset($id_proyecto) || !isset($nombre_proyecto) || !isset($descripcion_proyecto) || !isset($fecha_inicio)) {
                    throw new Exception('Datos incompletos para actualizar');
                }

                $proyectoModel->update($id_proyecto, $nombre_proyecto, $descripcion_proyecto, $ubicacion_proyecto, $fecha_inicio, $fecha_fin);
                $response = ['status' => 'success', 'message' => 'Proyecto actualizado con éxito'];
            } catch (Exception $e) {
                $response = ['status' => 'error', 'message' => $e->getMessage()];
            }
            break;

        case 'DELETE':
            $data = json_decode(file_get_contents("php://input"), true);
            if (!isset($data['id_proyecto'])) {
                throw new Exception('Datos incompletos para eliminar');
            }
            $proyectoModel->delete($data['id_proyecto']);
            $response = ['status' => 'success', 'message' => 'Proyecto eliminado con éxito'];
            break;

        default:
            throw new Exception('Método no permitido');
    }
} catch (Exception $e) {
    $response = ['status' => 'error', 'message' => $e->getMessage()];
}

echo json_encode($response);
?>
