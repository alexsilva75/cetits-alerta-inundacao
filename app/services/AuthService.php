<?php

namespace Services;

use Repositories\UsuarioRepository;
use Models\Usuario;

class AuthService
{
    private UsuarioRepository $usuarios;

    public function __construct()
    {
        $this->usuarios = new UsuarioRepository();
    }

    public function registrar(array $dados)
    {
        // verificar email duplicado

        $usuario = $this->usuarios->findByEmailOrNomeUsuario($dados['email'], $dados['nome_usuario']);

        if ($usuario) {
            throw new \Exception("Email ou nome de usuário já existe");
        }

         $usuario = new Usuario();
         $usuario->setNome($dados['nome']);
         $usuario->setSobrenome($dados['sobrenome']);
         $usuario->setEmail($dados['email']);
         $usuario->setNomeUsuario($dados['nome_usuario']);
         $usuario->setCriadoEm(date('Y-m-d H:i:s'));
        // gerar hash da senha

        $usuario->setSenha(password_hash($dados['senha'], PASSWORD_BCRYPT));
            
        // salvar usuário
        $this->usuarios->save($usuario);

        
    }

    public function autenticar(string $email, string $senha)
    {
        error_log("Autenticando usuário com email: $email<br>");
        error_log("Senha fornecida: $senha<br>");
        // buscar usuário
        $usuario = $this->usuarios->findByEmailOrNomeUsuario($email, $email);

        error_log("Usuário encontrado: " . ($usuario ? $usuario->getEmail() : "Nenhum") . "<br>");
        // validar senha
        if ($usuario && password_verify($senha, $usuario->getSenha())) {
            error_log("Senha verificada com sucesso para o usuário: " . $usuario->getEmail() . "<br>");
            // retornar usuário
            return $usuario;
        }

        return false;
    }
}