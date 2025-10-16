<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

use Core\Database;

$config = require './core/config.php';
$db = new Database($config['db']['connection1']);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

$nombre = $_POST['nombre'] ?? '';
$correo = $_POST['correo'] ?? '';
$fecha = $_POST['fecha_nacimiento'] ?? '';
$pais = $_POST['pais'] ?? '';
$genero = $_POST['genero'] ?? '';
$password = $_POST['password'] ?? '';
$nacionalidades = $_POST['nacionalidad'] ?? '';
$photoData = null;

if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
    $photoData = file_get_contents($_FILES['photo']['tmp_name']);
}

if (empty($nombre) || empty($correo) || empty($fecha) || empty($pais) || empty($genero) || empty($password)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Todos los campos son obligatorios']);
    exit;
}

$errors = [];
if (!preg_match('/.{8,}/', $password))
    $errors[] = "La contraseña debe tener al menos 8 caracteres.";
if (!preg_match('/[A-Z]/', $password))
    $errors[] = "La contraseña debe contener al menos una mayúscula.";
if (!preg_match('/[a-z]/', $password))
    $errors[] = "La contraseña debe contener al menos una minúscula.";
if (!preg_match('/[0-9]/', $password))
    $errors[] = "La contraseña debe contener al menos un número.";
if (!preg_match('/[!@#$%^&*(),.?\":{}|<>]/', $password))
    $errors[] = "La contraseña debe contener al menos un carácter especial.";

if ($errors) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => implode(' ', $errors)]);
    exit;
}

$nacimiento = new DateTime($fecha);
$hoy = new DateTime();
$edad = $hoy->diff($nacimiento)->y;

if ($edad < 12) {
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'Debes tener al menos 12 años para registrarte']);
    exit;
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

try {
    $result = $db->callProcedure('sp_insert_usuario', [
        'p_nombre' => $nombre,
        'p_password' => $passwordHash,
        'p_genero' => $genero,
        'p_correo' => $correo,
        'p_fecha_nacimiento' => $fecha,
        'p_pais' => $pais,
        'p_nacionalidad' => $nacionalidades,
        'p_foto' => $photoData
    ]);

    $_SESSION['edad'] = $edad;

    echo json_encode(['success' => true, 'message' => 'Usuario registrado correctamente', 'edad' => $edad]);

} catch (Exception $e) {
    if (strpos($e->getMessage(), 'El correo ya está registrado') !== false) {
        http_response_code(409);
        echo json_encode(['success' => false, 'error' => 'El correo ya está registrado']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Error al registrar usuario']);
    }
}
