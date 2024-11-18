<?php
session_start();
require_once '../models/mtoEmpresaCompetencia.php';

header('Content-Type: application/json');
$response = array();
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST' && isset($_POST['_method']) && $_POST['_method'] == 'PUT') {
    $method = 'PUT';
}

try {
    $empresaModel = new EmpresaModel();

    switch ($method) {
        case 'GET':
            if (isset($_GET['id'])) {
                // Obtener un proyecto específico
                $empresa = $empresaModel->read($_GET['id']);
                if ($empresa) {
                    $response = ['status' => 'success', 'data' => $empresa];
                } else {
                    $response = ['status' => 'error', 'message' => 'Proyecto no encontrado'];
                }
            } else {
                // Obtener todos los proyectos
                $empresas = $empresaModel->readAll();
                $response = ['status' => 'success', 'data' => $empresas];
            }
            break;

        case 'POST':
            try {
                // Depuración: Verifica los datos recibidos
                error_log(print_r($_POST, true)); // Registra los datos recibidos en el log de errores
                $nombre_empresa = filter_var($_POST['nombre_empresa'], FILTER_SANITIZE_STRING);
                $ventas_empresa = filter_var($_POST['ventas_empresa'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); // Decimales permitidos
                $proyectos_empresa = filter_var($_POST['proyectos_empresa'], FILTER_SANITIZE_NUMBER_INT); // Solo enteros

                if (!$nombre_empresa || !$ventas_empresa || !$proyectos_empresa) {
                    throw new Exception('Datos inválidos o incompletos.');
                }

                if ($empresaModel->empresaNameExists($nombre_empresa)) {
                    throw new Exception('Ya existe una empresa con el mismo nombre.');
                }

                $result = $empresaModel->createEmpresa($nombre_empresa, $ventas_empresa, $proyectos_empresa);
                if ($result) {
                    $response = ['status' => 'success', 'message' => 'Empresa creada con éxito.'];
                } else {
                    throw new Exception('Error al crear la empresa.');
                }
            } catch (Exception $e) {
                $response = ['status' => 'error', 'message' => $e->getMessage()];
            }
            break;

        case 'PUT':
            if (isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
                error_log("Datos recibidos en la actualización: " . print_r($_POST, true)); // Depuración
                $id = intval($_POST['id_empresa']);
                $nombre_empresa = filter_var($_POST['nombre_empresa'], FILTER_SANITIZE_STRING);
                $ventas_empresa = filter_var($_POST['ventas_empresa'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $proyectos_empresa = filter_var($_POST['proyectos_empresa'], FILTER_SANITIZE_NUMBER_INT);
        
                if ($id && $nombre_empresa && $ventas_empresa && $proyectos_empresa) {
                    $result = $empresaModel->updateEmpresa($id, $nombre_empresa, $ventas_empresa, $proyectos_empresa);
                    if ($result) {
                        $response = ['status' => 'success', 'message' => 'Empresa actualizada con éxito.'];
                    } else {
                        error_log("Error al actualizar en la base de datos.");
                        $response = ['status' => 'error', 'message' => 'No se pudo actualizar la empresa.'];
                    }
                } else {
                    error_log("Datos inválidos o incompletos: " . print_r($_POST, true));
                    $response = ['status' => 'error', 'message' => 'Datos inválidos o incompletos.'];
                }
            } else {
                error_log("Método no permitido o incorrecto.");
                $response = ['status' => 'error', 'message' => 'Método no permitido o incorrecto.'];
            }
            break;

        case 'DELETE':
           // Leer los datos JSON del cuerpo de la solicitud
    $data = json_decode(file_get_contents('php://input'), true); // Obtén los datos JSON enviados en la solicitud
    if (isset($data['id_empresa'])) {
        $id_empresa = $data['id_empresa']; // Obtener el id de la empresa que se quiere eliminar

        // Intentar eliminar la empresa con el ID proporcionado
        $result = $empresaModel->deleteEmpresa($id_empresa);

        if ($result['success']) {
            $response = ['status' => 'success', 'message' => $result['message']];
        } else {
            $response = ['status' => 'error', 'message' => $result['message']];
        }
    } else {
        $response = ['status' => 'error', 'message' => 'No se ha proporcionado el ID de la empresa.'];
    }
            break;

        default:
            throw new Exception('Método no permitido.');
    }
} catch (Exception $e) {
    $response = ['status' => 'error', 'message' => $e->getMessage()];
}

echo json_encode($response);
?>