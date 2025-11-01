<?php
use Core\Database;

$page = 'home';
$currentPage = $_SERVER['REQUEST_URI'];

$mundiales = [];

try {
    $config = require './core/config.php';
    $db = new Database($config['db']['connection1']);

    $results = $db->callProcedure('sp_obtener_mundiales');

    if (!empty($results)) {
        foreach ($results as $row) {
            $mundiales[] = [
                'id' => $row['ID'],
                'nombre' => $row['NOMBRE'],
                'imagen' => $row['IMAGEN_COMPLEMENTARIA']
            ];
        }
    }
} catch (Exception $e) {
    error_log('Error fetching mundiales: ' . $e->getMessage());
}

require 'views/index.view.php';
