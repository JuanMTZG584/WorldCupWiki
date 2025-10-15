<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

// Permitir solo método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}


$input = json_decode(file_get_contents('php://input'), true);
$username = $input['username'] ?? ($_POST['username'] ?? '');
$password = $input['password'] ?? ($_POST['password'] ?? '');

//EJEMPLO DE USO
if ($username === 'admin' && $password === 'password') {
    $_SESSION['user_id'] = 1;
    echo json_encode([
        'success' => true,
        'message' => 'Inicio de sesión exitoso'
    ]);
} else {
    http_response_code(401);
    echo json_encode([
        'success' => false,
        'error' => 'Credenciales inválidas'
    ]);
}
