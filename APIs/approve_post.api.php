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

$idPublicacion = trim($_POST['id'] ?? '');

if (empty($idPublicacion)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'ID de publicación no proporcionado']);
    exit;
}

try {
    $db->callProcedure('sp_aprobar_publicacion', [
        'p_id' => $idPublicacion
    ]);

    echo json_encode(['success' => true, 'message' => 'Publicación aprobada correctamente']);

} catch (Exception $e) {
    $msg = $e->getMessage();

    if (strpos($msg, 'La publicación ya está aprobada') !== false) {
        http_response_code(409);
        echo json_encode(['success' => false, 'error' => 'La publicación ya fue aprobada']);
    } elseif (strpos($msg, 'No se encontró la publicación') !== false) {
        http_response_code(404);
        echo json_encode(['success' => false, 'error' => 'No se encontró la publicación']);
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'error' => 'Error al aprobar la publicación',
            'detalle' => $msg
        ]);
    }
}
