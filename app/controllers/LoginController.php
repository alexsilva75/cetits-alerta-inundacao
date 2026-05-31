<?php

namespace Controllers;
use Services\AuthService;


class LoginController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function showRegistrar($data)
    {
        $error = $data['error'] ?? null;

        if ($error) {
            $errorMessage = urldecode($error);
            //passar $errorMessage para a view


        }
        require_once '../app/views/auth/registrar.php';
    }

    public function showLogin($data)
    {
        $error = $data['error'] ?? null;

        if ($error) {
            $errorMessage = urldecode($error);
            //passar $errorMessage para a view


        }
        require_once '../app/views/auth/login.php';
    }


    public function autenticar($data)
    {
        $usuario = $this->authService->autenticar($data['email'], $data['senha']);

        error_log("Resultado da autenticação: " . ($usuario ? "Sucesso" : "Falha") . "<br>");
        if ($usuario) {
            // login bem-sucedido
            error_log("Login bem-sucedido para o usuário: " . $usuario->getNomeUsuario() . "<br>".
            "ID: ".$usuario->getId());

         
             $_SESSION['user_id'] = $usuario->getId();

            header('Location: /dashboard');
        } else {
            // falha no login  
            header('Location: /login?error='.urlencode("Email ou senha inválidos")); 
        }
    }

        public function registrar($data)
        {
            try {
                $this->authService->registrar($data);
                header('Location: /login');
            } catch (\Exception $e) {
                header('Location: /showRegistrar?error=' . urlencode($e->getMessage()));
            }
        }
}