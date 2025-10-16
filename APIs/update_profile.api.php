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

$usuarioId = $_SESSION['user_id'] ?? null;
$nombre = $_POST['nombre'] ?? '';
$fecha = $_POST['fecha_nacimiento'] ?? '';
$pais = $_POST['pais'] ?? '';
$genero = $_POST['genero'] ?? '';
$password = $_POST['password'] ?? '';
$nacionalidades = $_POST['nacionalidad'] ?? '';
$photoData = null;

if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
    $photoData = file_get_contents($_FILES['photo']['tmp_name']);
}

if (!$usuarioId) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'No estás autenticado']);
    exit;
}

$errors = [];
if (!empty($password)) {
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
}

if (!empty($fecha)) {
    $nacimiento = new DateTime($fecha);
    $hoy = new DateTime();
    $edad = $hoy->diff($nacimiento)->y;

    if ($edad < 12) {
        $errors[] = "Debes tener al menos 12 años para actualizar tu perfil";
    }
}

if ($errors) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => implode(' ', $errors)]);
    exit;
}

$passwordHash = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : null;

if (is_array($nacionalidades)) {
    $nacionalidades = implode(',', $nacionalidades);
}

try {
    $db->callProcedure('sp_update_usuario', [
        'p_id' => $usuarioId,
        'p_nombre' => $nombre,
        'p_password' => $passwordHash,
        'p_genero' => $genero,
        'p_fecha_nacimiento' => $fecha ?: null,
        'p_pais' => $pais,
        'p_nacionalidad' => $nacionalidades,
        'p_foto' => $photoData
    ]);

    if ($photoData) {
        $_SESSION['user_photo'] = base64_encode($photoData);
    }


    echo json_encode(['success' => true, 'message' => 'Perfil actualizado correctamente']);

} catch (Exception $e) {
    if (strpos($e->getMessage(), 'Usuario no encontrado') !== false) {
        http_response_code(404);
        echo json_encode(['success' => false, 'error' => 'Usuario no encontrado']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Error al actualizar perfil']);
    }
}
