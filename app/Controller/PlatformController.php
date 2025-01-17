<?php

require_once '../Model/Platform.php';

class PlatformController
{
    public function showPlatform()
    {
        session_start();

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['user_email'])) {
            // header("https://servicioswebproasociado.progressa.coop/Proyecto-conferencia/app/View/login.php");
             header("http://localhost/Proyecto-conferencia/app/View/login.php");
            exit;
        }

        // Obtener documentos
        $platform = new Platform();
        $documents = $platform->getDocuments();

        // Cargar la vista de la plataforma
        require_once 'http://localhost/Proyecto-conferencia/app/View/platform.php';
        // require_once 'https://servicioswebproasociado.progressa.coop/Proyecto-conferencia/app/View/platform.php';
    }
}
