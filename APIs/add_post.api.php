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

if (empty($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Usuario no autenticado']);
    exit;
}

try {
    $idUsuario = $_SESSION['user_id'];
    $idMundial = $_POST['id_mundial'] ?? null;
    $idCategoria = $_POST['id_categoria'] ?? null;
    $seleccion = $_POST['seleccion'] ?? null;

    if (empty($idMundial) || empty($idCategoria)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Faltan campos obligatorios']);
        exit;
    }

    // Validar selección como país válido
    if (!empty($seleccion)) {
        $apiUrl = "https://restcountries.com/v3.1/all?fields=name,translations";
        $response = @file_get_contents($apiUrl);
        $countries = $response ? json_decode($response, true) : [];

        $validCountries = [];
        foreach ($countries as $c) {
            $nameSpa = $c['translations']['spa']['common'] ?? $c['name']['common'];
            $validCountries[] = $nameSpa;
        }

        if (!in_array($seleccion, $validCountries, true)) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'error' => "La selección '$seleccion' no es válida. Debe ser un país real."
            ]);
            exit;
        }
    }

    $multimedia = null;
    if (isset($_FILES['multimedia']) && $_FILES['multimedia']['error'] === 0) {
        $multimedia = file_get_contents($_FILES['multimedia']['tmp_name']);
    }

    $db->callProcedure('sp_insert_publicacion', [
        'p_id_usuario' => $idUsuario,
        'p_id_mundial' => $idMundial,
        'p_id_categoria' => $idCategoria,
        'p_seleccion' => $seleccion,
        'p_multimedia' => $multimedia
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Publicación creada y pendiente de aprobación'
    ]);

} catch (PDOException $e) {
    $mensaje = $e->errorInfo[2] ?? $e->getMessage();
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Error al registrar la publicación',
        'detalle' => $mensaje
    ]);
}
