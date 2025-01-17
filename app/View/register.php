<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/styles.css">
</head>
<body>
    <div class="container">
        <!-- Encabezado -->
        <header>
            <h1>Financiera Progressa</h1>
            <p>Avanzamos contigo</p>
        </header>
        <!-- Mensajes -->
        <?php if (isset($_GET['error'])): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
        <?php endif; ?>
        <?php if (isset($_GET['message'])): ?>
                <div class="success-message">
                    <?php echo htmlspecialchars($_GET['message']); ?>
                </div>
        <?php endif; ?>

        <!-- Formulario -->
        <form id="registroForm" action="../../index.php" method="POST" enctype="multipart/form-data">
            <h1>Formulario de Registro</h1>

            <!-- Campos del Formulario -->
            <div>
                <label for="nombres">Nombres:</label>
                <input type="text" id="nombres" name="nombres" placeholder="Ingresa tus nombres" required>
            </div>
            <div>
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" placeholder="Ingresa tus apellidos" required>
            </div>
            <div>
                <label for="tipo_documento">Tipo de Documento:</label>
                <select id="tipo_documento" name="tipo_documento" required>
                    <option value="CC">Cédula de Ciudadanía</option>
                    <option value="TI">Tarjeta de Identidad</option>
                    <option value="CE">Cédula de Extranjería</option>
                </select>
            </div>
            <div>
                <label for="numero_cedula">Número de Documento:</label>
                <input type="text" id="numero_cedula" name="numero_cedula" placeholder="Número de documento" required>
            </div>
            <div>
                <label for="ciudad">Ciudad:</label>
                <input type="text" id="ciudad" name="ciudad" placeholder="Ejemplo: Bogotá" required>
            </div>
            <div>
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" placeholder="Ejemplo: Calle 123 #45-67" required>
            </div>
            <div>
                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" placeholder="ejemplo@correo.com" required>
            </div>
            <div>
                <label for="celular">Celular:</label>
                <input type="tel" id="celular" name="celular" placeholder="Ejemplo: 3001234567" required>
            </div>

            <!-- Foto de la Persona -->
            <div id="foto_persona_div">
                <label for="foto_persona">Foto de la Persona:</label>
                <input type="file" id="foto_persona" name="foto_persona" accept="image/*" capture="environment">
                <small>Sube una foto clara de tu rostro en formato PNG o JPG.</small>
                <button type="button" id="open_camera_persona" class="styled-button" style="display: none;">Abrir Cámara</button>
                <video id="camera_preview_persona" autoplay style="display: none; width: 100%;"></video>
                <button type="button" id="capture_photo_persona" class="capture-button" style="display: none;">Capturar Foto</button>
                <canvas id="photo_canvas_persona" style="display: none;"></canvas>
                <input type="hidden" id="photo_data_persona" name="photo_data_persona">
            </div>

            <!-- Cédula Frontal -->
            <div id="cedula_frontal_div">
                <label for="cedula_frontal">Cédula (Frontal):</label>
                <input type="file" id="cedula_frontal" name="cedula_frontal" accept="image/*" capture="environment">
                <small>Sube una foto clara de la parte frontal de tu cédula en formato PNG o JPG.</small>
                <button type="button" id="open_camera_frontal" class="styled-button" style="display: none;">Abrir Cámara</button>
                <video id="camera_preview_frontal" autoplay style="display: none; width: 100%;"></video>
                <button type="button" id="capture_photo_frontal" class="capture-button" style="display: none;">Capturar Foto</button>
                <canvas id="photo_canvas_frontal" style="display: none;"></canvas>
                <input type="hidden" id="photo_data_frontal" name="photo_data_frontal">
            </div>

            <!-- Cédula Posterior -->
            <div id="cedula_posterior_div">
                <label for="cedula_posterior">Cédula (Posterior):</label>
                <input type="file" id="cedula_posterior" name="cedula_posterior" accept="image/*" capture="environment">
                <small>Sube una foto clara de la parte posterior de tu cédula en formato PNG o JPG.</small>
                <button type="button" id="open_camera_posterior" class="styled-button" style="display: none;">Abrir Cámara</button>
                <video id="camera_preview_posterior" autoplay style="display: none; width: 100%;"></video>
                <button type="button" id="capture_photo_posterior" class="capture-button" style="display: none;">Capturar Foto</button>
                <canvas id="photo_canvas_posterior" style="display: none;"></canvas>
                <input type="hidden" id="photo_data_posterior" name="photo_data_posterior">
            </div>

            <button type="button" id="registrarBtn" class="button-unified">Registrar</button>
        </form>

        <!-- Modal para validar OTP -->
        <div id="otpModal" class="modal" style="display: none;">
            <div class="modal-content">
                <h2>Validación OTP</h2>
                <p>Se ha enviado un código OTP a tu correo. Por favor, ingrésalo a continuación:</p>
                <input type="text" id="otp" placeholder="123456">
                <button type="button" id="validarOtpBtn" class="button-unified">Validar OTP</button>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            &copy; 2024 - Financiera Progressa
        </footer>
    </div>
    <script src="../../public/js/script.js"></script>
</body>
</html>
