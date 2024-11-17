<?php
session_start();// Inicia una nueva sesión o reanuda la sesión existente
// Incluye el archivo que contiene la definición de la clase 'TipoUsuario'
require_once '../models/mtoRolesUsuario.php';
// Establece el tipo de contenido de la respuesta como JSON
header('Content-Type: application/json');
// Inicializa un array para almacenar la respuesta
$response = array();
// Obtiene el método HTTP de la solicitud actual (GET, POST, PUT, DELETE)
$method = $_SERVER['REQUEST_METHOD'];
// Detectar si el método es PUT usando un campo en el formulario
if ($method == 'POST' && isset($_POST['_method']) && $_POST['_method'] == 'PUT') {
    $method = 'PUT';
}

try {
    $tipoUsuarioModel = new RoleModel();// Crea una instancia del modelo de 'Tipo Usuario'

    switch ($method) {// Verifica el método HTTP de la solicitud y actúa en consecuencia
        case 'GET':
            // Si la solicitud es GET y se pasa un parámetro 'id', lee un tipo de usuario específico
            if (isset($_GET['id'])) { 
                $response = $tipoUsuarioModel->read($_GET['id']);
            } else {
                // Si no se pasa 'id', lee todos los tipos de usuarios
                $response = $tipoUsuarioModel->getAllRoles();
            }
            break;

        case 'POST':
            try {
                $tipo_usuario = $_POST['tipo_usuario'] ?? null;
                $descripcion_usuario = $_POST['descripcion_usuario'] ?? null;

                // Validación de campos obligatorios
                if (!$tipo_usuario || !$descripcion_usuario) {
                    throw new Exception('Datos incompletos.');
                }
                if ($tipoUsuarioModel->roleNameExists($tipo_usuario)) {
                    throw new Exception('Ya existe un rol con el mismo nombre.');
                }

                if ($tipoUsuarioModel->createRole($tipo_usuario, $descripcion_usuario)) {
                    $response = ['status' => 'success', 'message' => 'Rol creado con éxito'];
                }  else {
                    throw new Exception('Error al crear el rol.');
                }
            } catch (Exception $e) {
                $response = ['status' => 'error', 'message' => $e->getMessage()];
            }
            break;

        case 'PUT':
            $data = json_decode(file_get_contents("php://input"), true);
            if (!isset($data['id']) || !isset($data['tipo_usuario']) || !isset($data['descripcion_usuario'])) {
                throw new Exception('Datos incompletos.');
            }
            $tipoUsuarioModel->updateRole($data['id'], $data['tipo_usuario'], $data['descripcion_usuario']);
            $response = ['status' => 'success', 'message' => 'Tipo de usuario actualizado con éxito.'];
            break;

        case 'DELETE':
            $data = json_decode(file_get_contents("php://input"), true);
            if (!isset($data['id'])) {
                throw new Exception('Datos incompletos.');
            }
            $tipoUsuarioModel->deleteRole($data['id']);
            $response = ['status' => 'success', 'message' => 'Rol de usuario eliminado con éxito.'];
            break;

        default:
            throw new Exception('Método no permitido.');
    }
} catch (Exception $e) {
    $response = ['status' => 'error', 'message' => $e->getMessage()];
}

echo json_encode($response);
?>