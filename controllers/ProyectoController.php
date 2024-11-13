<?php
session_start();
require_once '../models/mtoProyecto.php';

header('Content-Type: application/json');

$response = array();
$method = $_SERVER['REQUEST_METHOD'];

// Detectar si el método es PUT usando un campo en el formulario
if ($method == 'POST' && isset($_POST['_method']) && $_POST['_method'] == 'PUT') {
    $method = 'PUT';
}

try {
    $proyectoModel = new Proyecto();

    switch ($method) {
        case 'GET':
            if (isset($_GET['id'])) {
                // Obtener un proyecto específico
                $project = $proyectoModel->read($_GET['id']);
                if ($project) {
                    $response = ['status' => 'success', 'data' => $project];
                } else {
                    $response = ['status' => 'error', 'message' => 'Proyecto no encontrado'];
                }
            } else {
                // Obtener todos los proyectos
                $projects = $proyectoModel->readAll();
                $response = ['status' => 'success', 'data' => $projects];
            }
            break;

        case 'POST':
            // Crear un nuevo proyecto
            try {
                $nombre_proyecto = $_POST['nombre_proyecto'] ?? null;
                $descripcion_proyecto = $_POST['descripcion_proyecto'] ?? null;
                $ubicacion_proyecto = $_POST['ubicacion_proyecto'] ?? null;
                $fecha_inicio = $_POST['fecha_inicio'] ?? null;
                $fecha_fin = $_POST['fecha_fin'] ?? null;

                // Validación de campos obligatorios
                if (!$nombre_proyecto || !$descripcion_proyecto || !$fecha_inicio) {
                    throw new Exception('Datos incompletos al guardar');
                }
                if ($proyectoModel->existsByName($nombre_proyecto)) {
                    throw new Exception('Ya existe un proyecto con el mismo nombre');
                }

                if ($proyectoModel->create($nombre_proyecto, $descripcion_proyecto, $ubicacion_proyecto, $fecha_inicio, $fecha_fin)) {
                    $response = ['status' => 'success', 'message' => 'Proyecto creado con éxito'];
                } else {
                    throw new Exception('Error al crear el proyecto');
                }
            } catch (Exception $e) {
                $response = ['status' => 'error', 'message' => $e->getMessage()];
            }
            break;

        case 'PUT':
            // Actualizar un proyecto
            try {
                $id_proyecto = $_POST['id_proyecto'] ?? null;
                $nombre_proyecto = $_POST['nombre_proyecto'] ?? null;
                $descripcion_proyecto = $_POST['descripcion_proyecto'] ?? null;
                $ubicacion_proyecto = $_POST['ubicacion_proyecto'] ?? null;
                $fecha_inicio = $_POST['fecha_inicio'] ?? null;
                $fecha_fin = $_POST['fecha_fin'] ?? null;

                // Validación de campos obligatorios
                if (!$id_proyecto || !$nombre_proyecto || !$descripcion_proyecto || !$fecha_inicio) {
                    throw new Exception('Datos incompletos para actualizar');
                }

                if ($proyectoModel->update($id_proyecto, $nombre_proyecto, $descripcion_proyecto, $ubicacion_proyecto, $fecha_inicio, $fecha_fin)) {
                    $response = ['status' => 'success', 'message' => 'Proyecto actualizado con éxito'];
                } else {
                    throw new Exception('Error al actualizar el proyecto');
                }
            } catch (Exception $e) {
                $response = ['status' => 'error', 'message' => $e->getMessage()];
            }
            break;

        case 'DELETE':
            // Eliminar un proyecto
            $data = json_decode(file_get_contents("php://input"), true);
            if (!isset($data['id_proyecto'])) {
                throw new Exception('Datos incompletos para eliminar');
            }
            if ($proyectoModel->delete($data['id_proyecto'])) {
                $response = ['status' => 'success', 'message' => 'Proyecto eliminado con éxito'];
            } else {
                throw new Exception('Error al eliminar el proyecto');
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
