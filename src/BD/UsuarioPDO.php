<?php

require_once __DIR__ . '/BD.php';

class UsuarioPDO {
    private PDO $bd;

    function __construct($bd) {
        $this->bd = $bd;
    }

    public function verificarUsuario(string $user, string $pass) : bool {
        $consulta = "SELECT * FROM usuarios WHERE name = :usuario AND pass = :pass";
        $stmt = $this->bd->prepare($consulta);
        $stmt->bindParam(':usuario', $user);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    public function crearUsuario (string $user, string $pass) : bool {
        $consulta = "INSERT INTO usuarios (name, pass) VALUES (:user, :pass)";
        $stmt = $this->bd->prepare($consulta);
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':pass', $pass);
        return $stmt->execute();
    }

    public function eliminarUsuario (Usuario $user) : bool {
        $consulta = "DELETE FROM usuarios WHERE name = :user";
        $stmt = $this->bd->prepare($consulta);
        $stmt->bindParam(':user', $user->getNombre());
        return $stmt->execute();
    }

    public function modificarUsuario (Usuario $user) : bool {
        $consulta = "UPDATE usuarios SET name = :user, pass = :pass WHERE id = :id";
        $stmt = $this->bd->prepare($consulta);
        $stmt->bindParam(':user', $user->getNombre());
        $stmt->bindParam(':pass', $user->getClave());
        $stmt->bindParam(':id', $user->getId());
        return $stmt->execute();
    }

}