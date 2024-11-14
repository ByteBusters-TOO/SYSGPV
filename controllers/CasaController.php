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
}
?>