<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use Core\Database;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
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

    if (empty($input['id_publicacion'])) {
        throw new Exception("Debe proporcionarse el ID de la publicación.");
    }

    $params = [
        'p_id_publicacion' => $input['id_publicacion']
    ];

    $comentResults = $db->callProcedure('sp_get_comentarios_por_publicacion', $params);
    $comentarios = [];

    if (!empty($comentResults)) {
        foreach ($comentResults as $row) {
            $mimeFoto = null;
            if (!empty($row['usuario_foto'])) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeFoto = finfo_buffer($finfo, $row['usuario_foto']);
                finfo_close($finfo);
            }

            $comentarios[] = [
                'comentario_id' => $row['comentario_id'],
                'id_publicacion' => $row['ID_PUBLICACION'],
                'contenido' => $row['CONTENIDO'],
                'fecha_creacion' => $row['FECHA_CREACION'],
                'usuario_id' => $row['usuario_id'],
                'usuario_nombre' => $row['usuario_nombre'],
                'usuario_foto' => !empty($row['usuario_foto']) ? base64_encode($row['usuario_foto']) : null,
                'mime_foto' => $mimeFoto ?? 'image/jpeg'
            ];
        }
    }

    echo json_encode([
        'status' => 'success',
        'count' => count($comentarios),
        'data' => $comentarios
    ]);

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
