<?php
use Core\Database;
$page = 'world_cup';
$currentPage = $_SERVER['REQUEST_URI'];

//session_start();

$mundial = null;

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    try {
        $config = require './core/config.php';
        $db = new Database($config['db']['connection1']);


        $results = $db->callProcedure('sp_obtener_mundial_por_id', ['p_id_mundial' => $id]);


        if (!empty($results)) {
            $mundial = $results[0];
        }

    } catch (Exception $e) {
        error_log('Error fetching mundial: ' . $e->getMessage());
    }
}

require 'views/world_cup.view.php';