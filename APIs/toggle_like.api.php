<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

use Core\Database;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
    exit;
}

if (empty($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
    exit;
}

try {
    $config = require './core/config.php';
    $db = new Database($config['db']['connection1']);

    $input = json_decode(file_get_contents('php://input'), true);
    $id_publicacion = $input['id_publicacion'] ?? null;

    if (empty($id_publicacion)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Falta el ID de la publicación']);
        exit;
    }

    $id_usuario = $_SESSION['user_id'];

    $params = [
        'p_id_usuario' => $id_usuario,
        'p_id_publicacion' => $id_publicacion
    ];

    $result = $db->callProcedure('sp_toggle_like', $params);

    echo json_encode([
        'status' => 'success',
        'message' => 'Like actualizado correctamente',
        'data' => [
            'id_publicacion' => $id_publicacion,
            'id_usuario' => $id_usuario
        ]
    ]);

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
