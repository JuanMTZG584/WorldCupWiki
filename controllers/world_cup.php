<?php
$page ='world_cup';

$currentPage=$_SERVER['REQUEST_URI'];

session_start();

require 'views/world_cup.view.php';