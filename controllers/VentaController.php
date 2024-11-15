<?php

require_once '../models/mtoVenta.php';
require_once '../models/mtoCasa.php';  // Incluir el modelo Casa

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $fecha_venta = $_POST['fecha_venta'];
    $monto_venta = $_POST['monto_venta'];
    $nombre_cliente = $_POST['nombre_cliente'];
    $apellido_cliente = $_POST['apellido_cliente'];
    $correo_cliente = $_POST['correo_cliente'];
    $telefono_cliente = $_POST['telefono_cliente'];
    $id_casa = $_POST['id_casa'];

    $ventaModel = new Venta();
    $casaModel = new Casa();  // Crear una instancia del modelo Casa

    if ($action === 'create') {
        $result = $ventaModel->create($fecha_venta, $monto_venta, $nombre_cliente, $apellido_cliente, $correo_cliente, $telefono_cliente, $id_casa);

         // Si la venta se registra correctamente, actualizar el estado de la casa
         if ($result['status']) {
            // Actualizar el estado de la casa a "Vendida"
            $updateResult = $casaModel->actualizarEstadoVendido($id_casa);

            if ($updateResult['status']) {
                echo json_encode(['mensaje' => 'Venta registrada y estado de la casa actualizado a "Vendida".', 'status' => 'success']);
            } else {
                echo json_encode(['mensaje' => 'Venta registrada, pero no se pudo actualizar el estado de la casa.', 'status' => 'danger']);
            }
        } else {
            echo json_encode(['mensaje' => 'Error al registrar la venta.', 'status' => 'danger']);
        
    }
}
}