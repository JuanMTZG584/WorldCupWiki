<?php

use Core\Database;

$page = 'profile';
$currentPage = $_SERVER['REQUEST_URI'];

// API CONSUMED: https://restcountries.com/
$apiUrl = "https://restcountries.com/v3.1/all?fields=name,cca2";
$response = @file_get_contents($apiUrl);
$countries = $response ? json_decode($response, true) : [];

usort($countries, function ($a, $b) {
    return strcmp($a['name']['common'], $b['name']['common']);
});

//GET USER INFO (TODO: CHANGE THIS TO CONSUME THE API INSTEAD OF THE NATIVE CONTROLLER)
$user = [];
$nacionalidades = [];
$foto = '../public/resources/64572.png';
$nombre = '';
$fecha_nac = '';
$pais = '';
$genero = '';
$correo = '--';
$publicaciones = 0;
$likes = 0;
$vistas = 0;

if (!empty($_SESSION['user_id'])) {
    try {
        $config = require './core/config.php';
        $db = new Database($config['db']['connection1']);

        $result = $db->callProcedure('sp_get_usuario_perfil', ['p_id' => (int)$_SESSION['user_id']]);
        if (!empty($result[0])) {
            $user = $result[0];

            if (!empty($user['FOTO'])) {
                $foto = 'data:image/jpeg;base64,' . base64_encode($user['FOTO']);
            }

            $nombre = $user['NOMBRE'] ?? '';
            $fecha_nac = $user['FECHA_NACIMIENTO'] ?? '';
            $pais = $user['PAIS'] ?? '';
            $genero = $user['GENERO'] ?? '';
            $correo = $user['CORREO'] ?? '--';
            $publicaciones = $user['PUBLICACIONESCUENTA'] ?? 0;
            $likes = $user['LIKESCUENTA'] ?? 0;
            $vistas = $user['VISTASCUENTA'] ?? 0;
            $nacionalidades = isset($user['NACIONALIDAD']) ? explode(',', $user['NACIONALIDAD']) : [];
        }
    } catch (Exception $e) {
        error_log('Error fetching profile: ' . $e->getMessage());
    }
} else {
    header('Location: /login');
    exit;
}

require 'views/profile.view.php';
