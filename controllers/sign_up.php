<?php
$page ='sign_up';

$currentPage=$_SERVER['REQUEST_URI'];


// Consumo de API para combobox de paises
$apiUrl = "https://restcountries.com/v3.1/all?fields=name,cca2";

$response = file_get_contents($apiUrl);
$countries = json_decode($response, true);

usort($countries, function($a, $b) {
    return strcmp($a['name']['common'], $b['name']['common']);
});


require 'views/sign_up.view.php';