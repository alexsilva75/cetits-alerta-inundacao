<?php

namespace Repositories;

use Core\Database;
use App\Models\Usuario;
use PDO;

class UsuarioRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function findAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM usuarios");

        return $stmt->fetchAll(PDO::FETCH_CLASS, Usuario::class);
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);

        return $stmt->fetchObject(Usuario::class);
    }

    public function save(Usuario $usuario)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO usuarios (nome, email) VALUES (?, ?)"
        );

        return $stmt->execute([$usuario->nome, $usuario->email]);
    }
}