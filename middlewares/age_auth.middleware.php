<?php
session_start();

if (isset($_SESSION['edad'])) {
    $edad = (int) $_SESSION['edad'];
} else {

    if (isset($_COOKIE['edad'])) {
        $edad = (int) $_COOKIE['edad'];
        $_SESSION['edad'] = $edad;
    } else {
        header("Location: /verify_age");
        exit();
    }
}

if ($edad < 12) {
    header("Location: /verify_age");
    exit();
}
