<?php

require_once __DIR__ . '/../Model/User.php';

class UserController
{
    public function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar si el OTP fue validado
            if (!isset($_POST['otp_verified']) || $_POST['otp_verified'] !== 'true') {
                error_log("OTP Verified: " . ($_POST['otp_verified'] ?? 'No recibido'));
                header("Location: /OficinaVirtual/Proyecto-conferencia/app/View/register.php?error=" . urlencode("Debes validar tu correo mediante el OTP antes de continuar."));
                exit;
            }

            $user = new User();

            // Validar y sanitizar los datos del formulario
            $data = [
                'nombres' => trim($_POST['nombres'] ?? ''),
                'apellidos' => trim($_POST['apellidos'] ?? ''),
                'tipo_documento' => trim($_POST['tipo_documento'] ?? ''),
                'numero_cedula' => trim($_POST['numero_cedula'] ?? ''),
                'ciudad' => trim($_POST['ciudad'] ?? ''),
                'direccion' => trim($_POST['direccion'] ?? ''),
                'correo' => trim($_POST['correo'] ?? ''),
                'celular' => trim($_POST['celular'] ?? ''),
                'imagen_persona' => $_POST['imagen_persona'] ?? null,
                'imagen_cedula_frontal' => $_POST['imagen_cedula_frontal'] ?? null,
                'imagen_cedula_posterior' => $_POST['imagen_cedula_posterior'] ?? null,
            ];

            // Validación básica
            foreach ($data as $key => $value) {
                if (empty($value) && $key !== 'imagen_persona' && $key !== 'imagen_cedula_frontal' && $key !== 'imagen_cedula_posterior') {
                    header("Location: http://localhost/Proyecto-conferencia/app/View/register.php?error=" . urlencode("El campo {$key} es obligatorio."));
                    // header("Location: https://servicioswebproasociado.progressa.coop//Proyecto-conferencia/app/View/register.php?error=" . urlencode("El campo {$key} es obligatorio."));
                    exit;
                }
            }

            try {
                // Intentar guardar el usuario
                if ($user->save($data)) {
                    // Configurar la sesión con el nombre del usuario
                    session_start();
                    $_SESSION['user_email'] = $data['correo'];

                    // Redirigir a la plataforma
                    header("Location: http://localhost/Proyecto-conferencia/app/view/platform.php");
                    // header("https://servicioswebproasociado.progressa.coop/OficinaVirtual/Proyecto-conferencia/app/view/platform.php");
                    exit;
                } else {
                    throw new Exception("Error al registrar el usuario.");
                }
            } catch (Exception $e) {
                // Redirigir con un mensaje de error
                header("Location: http://localhost/Proyecto-conferencia/app/View/register.php?error=" . urlencode($e->getMessage()));
                // header("Location: https://servicioswebproasociado.progressa.coop/OficinaVirtual/Proyecto-conferencia/app/View/register.php?error=" . urlencode($e->getMessage()));
                exit;
            }
        } else {
            // Método no permitido
            header("HTTP/1.0 405 Method Not Allowed");
            echo "Método no permitido.";
            exit;
        }
    }
}
