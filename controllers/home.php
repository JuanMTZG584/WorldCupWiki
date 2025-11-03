<?php
use Core\Database;

$page = 'home';
$currentPage = $_SERVER['REQUEST_URI'];

$mundiales = [];
$filtros = [];

$mundiales_list = [];
$categorias_list = [];

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

    $filtrosResult = $db->callProcedure('sp_get_filtros_busqueda');
    if (!empty($filtrosResult)) {
        foreach ($filtrosResult as $row) {
            $filtros[] = [
                'categoria' => $row['categoria'] ?? null,
                'ano_mundial' => $row['ano_mundial'] ?? null,
                'pais_sede' => $row['pais_sede'] ?? null
            ];
        }
    }

    $results = $db->callProcedure('sp_obtener_mundiales_y_categorias');

    if (!empty($results)) {
        foreach ($results as $row) {
            if ($row['tipo'] === 'mundial') {
                $mundiales_list[] = [
                    'id' => $row['ID'],
                    'ano' => $row['ANO'],
                    'pais' => $row['PAIS']
                ];
            } elseif ($row['tipo'] === 'categoria') {
                $categorias_list[] = [
                    'id' => $row['ID'],
                    'nombre' => $row['NOMBRE']
                ];
            }
        }
    }

} catch (Exception $e) {
    error_log('Error fetching data: ' . $e->getMessage());
}

require 'views/index.view.php';
