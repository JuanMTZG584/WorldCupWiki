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

    $params = [
        'p_paises' => $input['p_paises'] ?? null,
        'p_anos' => $input['p_anos'] ?? null,
        'p_categorias' => $input['p_categorias'] ?? null,
        'p_usuarios' => $input['p_usuarios'] ?? null,
        'p_orden' => $input['p_orden'] ?? 'fecha'
    ];

    $pubResults = $db->callProcedure('sp_obtener_publicaciones_activas', $params);
    $publicaciones = [];

    if (!empty($pubResults)) {
        foreach ($pubResults as $row) {
            $mimeMultimedia = null;
            if (!empty($row['multimedia'])) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeMultimedia = finfo_buffer($finfo, $row['multimedia']);
                finfo_close($finfo);
            }

            $mimeFoto = null;
            if (!empty($row['foto_usuario'])) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeFoto = finfo_buffer($finfo, $row['foto_usuario']);
                finfo_close($finfo);
            }

            $publicaciones[] = [
                'id' => $row['id_publicacion'] ?? null,
                'usuario' => $row['nombre_usuario'] ?? null,
                'foto' => !empty($row['foto_usuario']) ? base64_encode($row['foto_usuario']) : null,
                'mime_foto' => $mimeFoto ?? 'image/jpeg',
                'fecha' => $row['fecha_publicacion'] ?? null,
                'categoria' => $row['categoria'] ?? null,
                'mundial' => $row['mundial'] ?? null,
                'seleccion' => $row['seleccion'] ?? null,
                'multimedia' => !empty($row['multimedia']) ? base64_encode($row['multimedia']) : null,
                'mime_multimedia' => $mimeMultimedia ?? 'image/jpeg',
                'likes' => $row['total_likes'] ?? 0,
                'comentarios' => $row['total_comentarios'] ?? 0
            ];
        }
    }

    echo json_encode([
        'status' => 'success',
        'count' => count($publicaciones),
        'data' => $publicaciones
    ]);

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
