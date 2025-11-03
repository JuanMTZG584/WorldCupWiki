<?php
use Core\Database;
$page = 'world_cup';
$currentPage = $_SERVER['REQUEST_URI'];

session_start();

$mundial = null;
$filtros = [];

$mundiales_list = [];
$categorias_list = [];

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    try {
        $config = require './core/config.php';
        $db = new Database($config['db']['connection1']);


        $results = $db->callProcedure('sp_obtener_mundial_por_id', ['p_id_mundial' => $id]);
        if (!empty($results)) {
            $mundial = $results[0];
        }

        $filtrosResult = $db->callProcedure('sp_get_filtros_busqueda');
        if (!empty($filtrosResult)) {
            foreach ($filtrosResult as $row) {
                $filtros[] = [
                    'categoria' => $row['categoria'] ?? null
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
        error_log('Error fetching mundial: ' . $e->getMessage());
    }
}

require 'views/world_cup.view.php';