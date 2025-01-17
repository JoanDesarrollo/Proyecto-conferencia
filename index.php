<?php

require_once './app/Controller/UserController.php';

// Procesar la solicitud
$controller = new UserController();
$controller->handleRequest();

// Configuración para mostrar errores en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
