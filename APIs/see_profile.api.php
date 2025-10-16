<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

use Core\Database;

$config = require './core/config.php';
$db = new Database($config['db']['connection1']);

$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Usuario no autenticado']);
    exit;
}

try {
    $result = $db->callProcedure('sp_get_usuario_perfil', [
        'p_id' => $userId
    ]);

    if (empty($result)) {
        http_response_code(404);
        echo json_encode(['success' => false, 'error' => 'Usuario no encontrado']);
        exit;
    }

    if (!empty($result[0]['FOTO'])) {
        $result[0]['FOTO'] = 'data:image/jpeg;base64,' . base64_encode($result[0]['FOTO']);
    }

    echo json_encode(['success' => true, 'data' => $result[0]]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
