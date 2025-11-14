<?php

require_once __DIR__ . '../vendor/autoload.php'; // carga de Composer

use Dotenv\Dotenv;

// Cargar las variables desde .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Crear la conexión
$conn = new mysqli(
    $_ENV['DB_HOST'],
    $_ENV['DB_USER'],
    $_ENV['DB_PASS'],
    $_ENV['DB_NAME']
);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
