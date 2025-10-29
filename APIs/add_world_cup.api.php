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

try {
    // Datos recibidos del formulario
    $ano = $_POST['ano'] ?? null;
    $pais = $_POST['pais'] ?? null;
    $campeon = $_POST['campeon'] ?? null;
    $golesCampeon = $_POST['goles_campeon'] ?? null;
    $penalesCampeon = $_POST['penales_campeon'] ?? null;
    $penalesSubcampeon = $_POST['penales_subcampeon'] ?? null;
    $subcampeon = $_POST['subcampeon'] ?? null;
    $golesSubcampeon = $_POST['goles_subcampeon'] ?? null;
    $descripcion = $_POST['descripcion'] ?? null;
    $sedes = $_POST['sedes'] ?? '[]'; // JSON con las sedes

    // Validación básica
    if (empty($ano) || empty($pais) || empty($campeon) || empty($subcampeon)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Faltan campos obligatorios']);
        exit;
    }

    // Archivos (pueden ser opcionales)
    $logo = isset($_FILES['logo']) && $_FILES['logo']['error'] === 0 ? file_get_contents($_FILES['logo']['tmp_name']) : null;
    $imagen = isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0 ? file_get_contents($_FILES['imagen']['tmp_name']) : null;
    $balon = isset($_FILES['balon']) && $_FILES['balon']['error'] === 0 ? file_get_contents($_FILES['balon']['tmp_name']) : null;
    $poster = isset($_FILES['poster']) && $_FILES['poster']['error'] === 0 ? file_get_contents($_FILES['poster']['tmp_name']) : null;

    // Ejecutar el procedimiento almacenado
    $db->callProcedure('sp_insert_mundial', [
        'p_logo' => $logo,
        'p_imagen' => $imagen,
        'p_ano' => $ano,
        'p_pais' => $pais,
        'p_balon' => $balon,
        'p_poster' => $poster,
        'p_campeon' => $campeon,
        'p_goles_campeon' => $golesCampeon,
        'p_penales_campeon' => $penalesCampeon,
        'p_penales_subcampeon' => $penalesSubcampeon,
        'p_subcampeon' => $subcampeon,
        'p_goles_subcampeon' => $golesSubcampeon,
        'p_descripcion' => $descripcion,
        'p_sedes_json' => $sedes
    ]);

    echo json_encode(['success' => true, 'message' => 'Mundial y sedes registrados correctamente']);
} catch (Exception $e) {
    // Si MySQL lanza SIGNAL, capturamos el mensaje
    if (strpos($e->getMessage(), 'Ya existe un mundial registrado') !== false) {
        http_response_code(409);
        echo json_encode(['success' => false, 'error' => 'Ya existe un mundial registrado para ese año']);
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'error' => 'Error al registrar el mundial',
            'detalle' => $e->getMessage()
        ]);
    }
}
