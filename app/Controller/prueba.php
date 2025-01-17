

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Plataforma</title>
    <link rel="stylesheet" href="../../public/css/login.css">
    <script src="../../public/js/login.js" defer></script>
</head>
  <!-- Contenedor para el mensaje de error -->
  <div id="errorContainer" class="error-message" style="display: none;"></div>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1>Bienvenido sdfsdfsdfsdfs👋</h1>
            <p class="subtext">conectadoooo ph</p>
            <form id="loginForm">
                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" placeholder="Ingresa tu correo" required>
                </div>
                <button type="button" id="sendOtpBtn" class="btn-submit">Enviar OTP</button>
            </form>
            <div class="separator">
                <hr>
            </div>
            <p class="footer-text">¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>
        </div>
    </div>

    <!-- Modal para validar OTP -->
    <div id="otpModal" class="modal" style="display: none;">
    <div class="modal-content">
        <h2>Verificar OTP</h2>
        <p>Hemos enviado un código OTP a tu correo. Por favor, ingrésalo a continuación:</p>
        <input type="text" id="otp" placeholder="123456">
        <button type="button" id="verifyOtpBtn" class="btn-submit">Validar OTP</button>
        <button type="button" id="closeModalBtn" class="btn-cancel">Cerrar</button>
    </div>
</div>


    <footer>
        <p>© 2024 - Financiera Progressa</p>
    </footer>
</body>
</html>
