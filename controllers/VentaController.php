<?php

require_once '../models/mtoVenta.php';

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

    if ($action === 'create') {
        $result = $ventaModel->create($fecha_venta, $monto_venta, $nombre_cliente, $apellido_cliente, $correo_cliente, $telefono_cliente, $id_casa);

        if ($result['status']) {
            echo json_encode(['mensaje' => 'Venta registrada exitosamente.', 'status' => 'success']);
        } else {
            echo json_encode(['mensaje' => 'Error al registrar la venta.', 'status' => 'danger']);
        }
    }
}
