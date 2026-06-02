<?php

namespace Repositories;

use Core\Database;
use Models\Usuario;
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
        $stmt = $this->pdo->query("SELECT * FROM usuario");

        return $stmt->fetchAll(PDO::FETCH_CLASS, Usuario::class);
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE id = ?");
        $stmt->execute([$id]);

        return $stmt->fetchObject(Usuario::class);
    }

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE email = ?");
        $stmt->execute([$email]);

        return $stmt->fetchObject(Usuario::class);
    }

    public function findByNomeUsuario($nome_usuario)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE nome_usuario = ?");
        $stmt->execute([$nome_usuario]);

        return $stmt->fetchObject(Usuario::class);
    }


    public function save(Usuario $usuario)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO usuario (nome, email, senha, nome_usuario, criado_em) VALUES (?, ?, ?, ?, ?)"
        );

        return $stmt->execute([
            $usuario->nome,
            $usuario->email,
            $usuario->senha,
            $usuario->nome_usuario,
            $usuario->criado_em
        ]);
    }

     public function findByEmailOrNomeUsuario($email, $nome_usuario)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE email = ? OR nome_usuario = ?");
        $stmt->execute([$email, $nome_usuario]);

        return $stmt->fetchObject(Usuario::class);
    }   
}