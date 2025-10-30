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
    $ano = $_POST['ano'] ?? null;
    $pais = $_POST['pais'] ?? null;
    $campeon = $_POST['campeon'] ?? null;
    $golesCampeon = $_POST['goles_campeon'] ?? null;
    $penalesCampeon = $_POST['penales_campeon'] ?? null;
    $penalesSubcampeon = $_POST['penales_subcampeon'] ?? null;
    $subcampeon = $_POST['subcampeon'] ?? null;
    $golesSubcampeon = $_POST['goles_subcampeon'] ?? null;
    $descripcion = $_POST['descripcion'] ?? null;
    $sedes = json_decode($_POST['sedes'] ?? '[]', true);

    if (empty($ano) || empty($pais) || empty($campeon) || empty($subcampeon)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Faltan campos obligatorios']);
        exit;
    }

    $apiUrl = "https://restcountries.com/v3.1/all?fields=name,cca2,translations";
    $response = file_get_contents($apiUrl);
    $countries = json_decode($response, true);

    $countriesMap = [];
    foreach ($countries as $c) {
        $nameSpa = $c['translations']['spa']['common'] ?? $c['name']['common'];
        $nameEng = $c['name']['common'];
        $countriesMap[$nameSpa] = $nameEng; // clave = español, valor = inglés
    }

    $checkCountries = [$pais, $campeon, $subcampeon];
    foreach ($checkCountries as $c) {
        if (!array_key_exists($c, $countriesMap)) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'error' => "El país '$c' no es válido. Debe ser un país real."
            ]);
            exit;
        }
    }

    // === Validar ciudades (sedes) ===
    if (!empty($sedes)) {
        $paisEnIngles = $countriesMap[$pais]; // el nombre inglés del país
        $cityApiUrl = "https://countriesnow.space/api/v0.1/countries/cities";
        $cityResponse = file_get_contents($cityApiUrl, false, stream_context_create([
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-Type: application/json',
                'content' => json_encode(['country' => $paisEnIngles])
            ]
        ]));

        $cityData = json_decode($cityResponse, true);
        $cityList = $cityData['data'] ?? [];

        foreach ($sedes as $sede) {
            if (!isset($sede['ciudad'])) continue;
            $ciudad = $sede['ciudad'];

            $match = false;
            foreach ($cityList as $city) {
                if (strcasecmp($city, $ciudad) === 0) {
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'error' => "La ciudad '$ciudad' no se encontró en el país '$pais'."
                ]);
                exit;
            }
        }
    }

    if (!is_numeric($golesCampeon) || $golesCampeon < 0 || !is_numeric($golesSubcampeon) || $golesSubcampeon < 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Los goles deben ser números enteros positivos']);
        exit;
    }
    if (
        $penalesCampeon !== null && (!is_numeric($penalesCampeon) || $penalesCampeon < 0 || $penalesCampeon > 20) ||
        $penalesSubcampeon !== null && (!is_numeric($penalesSubcampeon) || $penalesSubcampeon < 0 || $penalesSubcampeon > 20)
    ) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Los penales deben ser números enteros entre 0 y 20']);
        exit;
    }

    if ($golesCampeon < $golesSubcampeon) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'El campeón no puede tener menos goles que el subcampeón']);
        exit;
    }

    if ($golesCampeon == $golesSubcampeon) {
        if ($penalesCampeon === null || $penalesSubcampeon === null) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Si los goles están empatados, los penales deben estar definidos']);
            exit;
        }
        if ($penalesCampeon <= $penalesSubcampeon) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'El campeón debe tener más penales que el subcampeón en caso de empate en goles']);
            exit;
        }
    }

    $logo = isset($_FILES['logo']) && $_FILES['logo']['error'] === 0 ? file_get_contents($_FILES['logo']['tmp_name']) : null;
    $imagen = isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0 ? file_get_contents($_FILES['imagen']['tmp_name']) : null;
    $balon = isset($_FILES['balon']) && $_FILES['balon']['error'] === 0 ? file_get_contents($_FILES['balon']['tmp_name']) : null;
    $poster = isset($_FILES['poster']) && $_FILES['poster']['error'] === 0 ? file_get_contents($_FILES['poster']['tmp_name']) : null;

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
        'p_sedes_json' => json_encode($sedes)
    ]);

    echo json_encode(['success' => true, 'message' => 'Mundial y sedes registrados correctamente']);

} catch (PDOException $e) {
    $mensaje = $e->errorInfo[2] ?? $e->getMessage();

    if (strpos($mensaje, 'Ya existe un mundial registrado') !== false) {
        http_response_code(409);
        echo json_encode(['success' => false, 'error' => $mensaje]);
    } elseif (strpos($mensaje, 'No hubo') !== false) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => $mensaje]);
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'error' => 'Error al registrar el mundial',
            'detalle' => $mensaje
        ]);
    }
}
