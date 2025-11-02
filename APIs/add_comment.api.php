<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

try {
    $config = require './core/config.php';
    $db = new Database($config['db']['connection1']);

    $input = $_POST;
    if (empty($input)) {
        $raw = file_get_contents('php://input');
        $json = json_decode($raw, true);
        if (is_array($json)) {
            $input = $json;
        }
    }

    $id_usuario = $input['id_usuario'] ?? null;
    $id_publicacion = $input['id_publicacion'] ?? null;
    $contenido = $input['contenido'] ?? null;

    if (!$id_usuario || !$id_publicacion || !$contenido) {
        throw new Exception('Faltan parámetros obligatorios: usuario, publicacion o contenido');
    }

    $params = [
        'p_id_usuario' => $id_usuario,
        'p_id_publicacion' => $id_publicacion,
        'p_contenido' => $contenido
    ];

    $db->callProcedure('sp_agregar_comentario', $params);

    echo json_encode([
        'status' => 'success',
        'message' => 'Comentario agregado correctamente'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
