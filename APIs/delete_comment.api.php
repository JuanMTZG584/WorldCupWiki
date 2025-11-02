<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use Core\Database;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json; charset=utf-8');

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'No has iniciado sesión']);
    exit;
}

try {
    $config = require './core/config.php';
    $db = new Database($config['db']['connection1']);

    $input = json_decode(file_get_contents('php://input'), true);

    if (empty($input['id_comentario'])) {
        throw new Exception("Debe proporcionarse el ID del comentario.");
    }

    $params = [
        'p_id_comentario' => $input['id_comentario'],
        'p_id_usuario' => $_SESSION['user_id']
    ];

    $result = $db->callProcedure('sp_eliminar_comentario', $params);

    echo json_encode([
        'status' => 'success',
        'message' => 'Comentario eliminado correctamente'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
