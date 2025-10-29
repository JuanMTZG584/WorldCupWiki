<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

use Core\Database;

$config = require './core/config.php';
$db = new Database($config['db']['connection1']);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}


$nombre = trim($_POST['nombre'] ?? '');
if (empty($nombre)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'El nombre de la categoría es obligatorio']);
    exit;
}

try {
    $result = $db->callProcedure('sp_insert_categoria', [
        'p_nombre' => $nombre
    ]);

    echo json_encode(['success' => true, 'message' => 'Categoría registrada correctamente']);

} catch (Exception $e) {
    $msg = $e->getMessage();

    if (strpos($msg, 'Ya existe una categoría activa con ese nombre') !== false) {
        http_response_code(409);
        echo json_encode(['success' => false, 'error' => 'Ya existe una categoría activa con ese nombre']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Error al registrar la categoría', 'detalle' => $msg]);
    }
}
