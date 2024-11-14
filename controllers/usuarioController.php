<?php
session_start();// Inicia una nueva sesión o reanuda la sesión existente
require_once '../models/mtoUsuario.php';// Incluye el archivo que contiene la definición de la clase 'Usuario'

header('Content-Type: application/json');// Establece el tipo de contenido de la respuesta como JSON

$response = array();// Inicializa un array para almacenar la respuesta
$method = $_SERVER['REQUEST_METHOD'];// Obtiene el método HTTP de la solicitud actual (GET, POST, PUT, DELETE)

try {
    $usuarioModel = new Usuario();// Crea una instancia del modelo de 'Usuario'

    switch ($method) {// Verifica el método HTTP de la solicitud y actúa en consecuencia
        case 'GET':
            if (isset($_GET['rol_usuario'])) {// Si la solicitud es GET y se pasa un parámetro 'tipo_usuario', cargara todos los roles del sistema
                $response = $usuarioModel->getRolesUsuario();
            } else if (isset($_GET['id'])) {// Si la solicitud es GET y se pasa un parámetro 'id', lee un usuario específico
                $response = $usuarioModel->read($_GET['id']);
            } else {// Si no se pasa ningun parametro lee todos los datos de la tabla
                $response = $usuarioModel->readTable();
            }
            break;

        case 'POST':
            // Decodifica el cuerpo de la solicitud JSON en un array asociativo
            $data = json_decode(file_get_contents("php://input"), true);
            // Verifica que se haya pasado los campos requeridos
            if (!isset($data['nombre_usuario']) || !isset($data['correo_usuario']) ||  !isset($data['id_rol']) || !isset($data['password'])) {
                throw new Exception('Datos incompletos.');// Si no, lanza una excepción indicando datos incompletos
            }
            // Llama al método create del modelo para crear un nuevo Usuario
            $usuarioModel->create($data['nombre_usuario'], $data['correo_usuario'], $data['id_rol'], $data['password']);
            $response = ['status' => 'success', 'message' => 'Usuario creado con éxito.'];
            break;

        case 'PUT':
            $data = json_decode(file_get_contents("php://input"), true);
            if (!isset($data['id']) || !isset($data['nombre_usuario']) || !isset($data['correo_usuario']) || !isset($data['id_rol']) || !isset($data['password'])) {
                throw new Exception('Datos incompletos');// Si no, lanza una excepción indicando datos incompletos
            }
            $usuarioModel->update($data['id'], $data['nombre_usuario'], $data['correo_usuario'], $data['id_rol'], $data['password']);
            $response = ['status' => 'success', 'message' => 'Usuario actualizado con éxito.'];
            break;

        case 'DELETE':
            $data = json_decode(file_get_contents("php://input"), true);
            if (!isset($data['id']) || !isset($data['estado_usuario'])) {
                throw new Exception('Datos incompletos.');// Si no, lanza una excepción indicando datos incompletos
            }
            //$usuarioModel->deshabilitar($data['id'],$data['estado_usuario']);
            $response = ['status' => 'success', 'message' => 'Usuario deshabilitado con éxito.'];
            break;

        default:
            throw new Exception('Método no permitido.');
    }
} catch (Exception $e) {
    $response = ['status' => 'error', 'message' => $e->getMessage()];
}

echo json_encode($response);
?>