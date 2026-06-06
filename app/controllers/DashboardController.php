<?php

namespace Controllers;

class DashboardController extends \Core\Controller
{
    public function showDashboard()
    {

        error_log("Acessando DashboardController@showDashboard");
        // Verificar se o usuário está autenticado
        if (!isset($_SESSION['user_id'])) {
            error_log("Usuário não autenticado. Redirecionando para login.");
            echo "Acesso negado. Por favor, faça login.";

            header('Location: /login');
            exit();
        }

        // Carregar a view do dashboard
        //require __DIR__ . '/../views/dashboard.php';
        //var_dump($_SESSION['user']);
        $this->view('dashboard.html.twig');
    }
}
