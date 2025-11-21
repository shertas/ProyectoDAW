<?php

require_once __DIR__ . '/../src/BD/BD.php';
require_once __DIR__ . '/../src/BD/UsuarioPDO.php';
require_once __DIR__ . '/../src/BD/Usuario.php';
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
} catch (PDOException $e) {
    echo "❌ Error de conexión: " . $e->getMessage() . "<br>";
    die;
}

// Navegador de botones

$usuarioBD = new UsuarioPDO($pdo);
echo "estoy aqui";

//Si la sesión está iniciada:
if (isset($_SESSION['usuario'])) {
    $nombre = $_SESSION['usuario'];
    $pass = $_SESSION['pass'];
    // Verificar que el usuario sigue existiendo en la base de datos
    if ($usuarioBD->verificarUsuario($nombre, $pass)) {
        header("Location: bienvenida.html");
        exit;
    } else {
        // El usuario no existe en la BD, destruir la sesión
        session_unset();
        session_destroy();
        session_start();

        header("Location: login.html");
        exit;
    }
} else { //si no está iniciada la sesión, vamos a la página de login
    header("Location: login.html");
    exit;
}