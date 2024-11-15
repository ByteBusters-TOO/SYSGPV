<?php

require_once '../models/mtoCasa.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $numero_casa = $_POST['numero_casa'];
    $estado_casa = $_POST['estado_casa'];
    $precio_casa = $_POST['precio_casa'];
    $id_proyecto = $_POST['id_proyecto'];

    $casaModel = new Casa();

    if ($action === 'create') {
        $result = $casaModel->create($numero_casa, $estado_casa, $precio_casa, $id_proyecto);
        echo json_encode(['mensaje' => $result['mensaje']]);
    }
    // Actualizar estado de la casa (para cambiar a "Vendida")
    if ($action === 'updateStatus' && $id_casa && $nuevo_estado) {
        $result = $casaModel->actualizarEstadoVendido($id_casa, $nuevo_estado);
        echo json_encode(['status' => $result['status'], 'mensaje' => $result['mensaje']]);
    }

     // Verificar que es una solicitud para actualizar
     if ($action === 'update') {
        $id_casa = $_POST['id_casa'];
        $numero_casa = $_POST['numero_casa'];
        $estado_casa = $_POST['estado_casa'];
        $precio_casa = $_POST['precio_casa'];
        $id_proyecto = $_POST['id_proyecto'];

        $casaModel = new Casa();
        $result = $casaModel->actualizarCasa($id_casa, $numero_casa, $estado_casa, $precio_casa, $id_proyecto);

        echo json_encode(['status' => $result['status'], 'mensaje' => $result['mensaje']]);
    }
}
?>