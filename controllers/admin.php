<?php
use Core\Database;

$page = 'admin';
$currentPage = $_SERVER['REQUEST_URI'];

$mundiales = [];
$categorias = [];
$publicaciones = [];

try {
    $config = require './core/config.php';
    $db = new Database($config['db']['connection1']);

    $results = $db->callProcedure('sp_obtener_mundiales_y_categorias');

    if (!empty($results)) {
        foreach ($results as $row) {
            if ($row['tipo'] === 'mundial') {
                $mundiales[] = [
                    'id' => $row['ID'],
                    'ano' => $row['ANO'],
                    'pais' => $row['PAIS']
                ];
            } elseif ($row['tipo'] === 'categoria') {
                $categorias[] = [
                    'id' => $row['ID'],
                    'nombre' => $row['NOMBRE']
                ];
            }
        }
    }

    $publicaciones = $db->callProcedure('sp_obtener_publicaciones_pendientes');

} catch (Exception $e) {
    error_log('Error fetching data: ' . $e->getMessage());
}

require 'views/admin.view.php';
