<?php
require_once '../Model/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (isset($data['email']) && !empty($data['email'])) {
        $email = trim($data['email']);

        // Verificar si el correo está registrado
        $userModel = new User();
        $isRegistered = $userModel->isEmailRegistered($email);

        if ($isRegistered) {
            session_start();
            $_SESSION['user_email'] = $email;
            echo json_encode(['message' => 'Login exitoso']);
            exit;
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'El correo no está registrado.']);
            exit;
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Por favor, ingresa un correo electrónico válido.']);
        exit;
    }
}
?>
