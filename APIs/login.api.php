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


$input = json_decode(file_get_contents('php://input'), true);
$correo = $input['correo'] ?? ($_POST['correo'] ?? '');
$password = $input['password'] ?? ($_POST['password'] ?? '');

if (empty($correo) || empty($password)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Correo y contraseña requeridos']);
    exit;
}

try {

    $result = $db->callProcedure('sp_get_usuario_por_correo', ['p_correo' => $correo]);
    $usuario = $result[0] ?? null;

    if ($usuario && $usuario['ESTATUS']) {
        if (password_verify($password, $usuario['PASSWORD'])) {
            
            $fechaNacimiento = new DateTime($usuario['FECHA_NACIMIENTO']);
            $hoy = new DateTime();
            $edad = $hoy->diff($fechaNacimiento)->y;

            $_SESSION['user_id'] = $usuario['ID'];
            $_SESSION['user_name'] = $usuario['NOMBRE'];
            $_SESSION['user_photo'] = base64_encode($usuario['FOTO']);
            $_SESSION['is_admin'] = ($usuario['ID'] == 1);
            $_SESSION['edad'] = $edad;

            echo json_encode([
                'success' => true,
                'message' => 'Inicio de sesión exitoso',
                'user_id' => $usuario['ID'],
                'photo' => base64_encode($usuario['FOTO']),
                'edad' => $edad
            ]);
        } else {
            http_response_code(401);
            echo json_encode(['success' => false, 'error' => 'Contraseña incorrecta']);
        }
    } else {
        http_response_code(401);
        echo json_encode(['success' => false, 'error' => 'Correo no existe o inactivo']);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Error en la conexión a la base de datos']);
}
