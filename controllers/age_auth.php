<?php
$page = 'verify_age';
$currentPage = $_SERVER['REQUEST_URI'];

session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fechaNacimiento = $_POST['fecha_nacimiento'];

    try {
        $nacimiento = new DateTime($fechaNacimiento);
        $hoy = new DateTime();

        $edad = $hoy->diff($nacimiento)->y;

        $_SESSION['edad'] = $edad;
        setcookie('edad', $edad, time() + (86400 * 30), "/");

        if ($edad < 12) {
            $error = "Debes tener al menos 12 años para continuar.";
        } else {
            header("Location: /");
            exit();
        }

    } catch (Exception $e) {
        $error = "Por favor, ingresa una fecha válida.";
    }
}

require 'views/age_auth.view.php';
