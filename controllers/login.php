<?php

$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if($requestMethod === 'GET'){
    $page = 'Login';

    $currentPage = $_SERVER['REQUEST_URI'];

    require 'views/login.view.php';
}


