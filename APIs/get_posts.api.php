<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use Core\Database;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json; charset=utf-8');

session_start();
$userId = $_SESSION['user_id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
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
        'p_id_usuario' => $userId,
        'p_paises' => $input['p_paises'] ?? '',
        'p_anos' => $input['p_anos'] ?? '',
        'p_categorias' => $input['p_categorias'] ?? '',
        'p_usuarios' => $input['p_usuarios'] ?? '',
        'p_orden' => $input['p_orden'] ?? 'fecha',
        'p_limit' => isset($input['p_limit']) ? (int) $input['p_limit'] : 2,
        'p_offset' => isset($input['p_offset']) ? (int) $input['p_offset'] : 0
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
                'liked_by_user' => $row['liked_by_user'] ?? 0,
                'comentarios' => $row['total_comentarios'] ?? 0,
                'vistas' => $row['total_vistas'] ?? 0
            ];
        }
    }
    $countParams = [
        'p_paises' => $params['p_paises'],
        'p_anos' => $params['p_anos'],
        'p_categorias' => $params['p_categorias'],
        'p_usuarios' => $params['p_usuarios']
    ];
    $countResult = $db->callProcedure('sp_count_publicaciones', $countParams);
    $totalPublicaciones = $countResult[0]['total'] ?? 0;


    echo json_encode([
        'status' => 'success',
        'total' => (int) $totalPublicaciones,
        'count' => count($publicaciones),
        'limit' => $params['p_limit'],
        'offset' => $params['p_offset'],
        'data' => $publicaciones
    ]);

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
