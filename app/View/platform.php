<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_email'])) {
    header("Location: http://localhost/Proyecto-conferencia/app/View/login.php");
    exit;
}

// Ruta absoluta directa a la carpeta de documentos
$documentsPath = '../../public/documents';

// Verificar si la carpeta existe y es válida
if (!$documentsPath || !is_dir($documentsPath)) {
    die("La carpeta de documentos no existe o la ruta es incorrecta.");
}

// Obtener los documentos
$documents = array_diff(scandir($documentsPath), array('.', '..'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma del Asociado</title>
    <link rel="stylesheet" href="../../public/css/platform.css">
    <script src="../../public/js/platform.js" defer></script>
</head>
<body>
    <div class="container">
        <!-- Encabezado -->
        <header>
            <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['user_email']); ?> 🎉</h1>
            <p>Estamos felices de que formes parte de nuestra comunidad.</p>
        </header>

        <!-- Contador -->
        <section class="contador">
            <h2>Tiempo restante para la reunión:</h2>
            <p id="tiempo">00:00:00</p>
            <div id="linkReunion" style="display:none;">
                <a href="https://example.com/reunion" target="_blank" class="btn">Ingresar a la reunión</a>
            </div>
        </section>

        <!-- Documentos -->
        <section class="documentos">
            <h2>Documentos importantes 📄</h2>
            <?php if (empty($documents)): ?>
                <p>No hay documentos disponibles en este momento.</p>
            <?php else: ?>
                <div class="document-grid">
                    <?php foreach ($documents as $document): ?>
                        <div class="document-card">
                            <div class="document-icon">📄</div>
                            <div class="document-info">
                                <p class="document-name" data-fullname="<?php echo htmlspecialchars($document); ?>">
                                    <?php echo htmlspecialchars($document); ?>
                                </p>
                                <a href="/Proyecto-conferencia/public/documents/<?php echo htmlspecialchars($document); ?>" class="btn-download" download>
                                    Descargar
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>
