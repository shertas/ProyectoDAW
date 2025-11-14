<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\BD\BD;

// Cargar las variables desde .env
$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// Crear la conexión usando la clase BD
try {
    $pdo = BD::getConexion(
        $_ENV['DB_HOST'],
        $_ENV['DB_PORT'],
        $_ENV['DB_NAME'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS']
    );
    
    echo "✅ Conexión exitosa a la base de datos<br>";
    
    // Obtener todos los usuarios
    $stmt = $pdo->query("SELECT * FROM usuarios");
    $usuarios = $stmt->fetchAll();
    
    echo "📋 Usuarios en la base de datos:<br>";
    echo "================================<br>";
    
    foreach ($usuarios as $u) {
        echo "ID: {$u['id_user']}<br>";
        echo "Nombre: {$u['name']}<br>";
        echo "Clave: {$u['pass']}<br><br>";
    }
    
} catch (PDOException $e) {
    echo "❌ Error de conexión: " . $e->getMessage() . "<br>";
    die;
}

