<?php

namespace Controllers;

use Services\IncidenteService;

class DashboardController extends \Core\Controller
{

    private $incidenteService;

    public function __construct(IncidenteService $incidenteService)
    {
        
        $this->incidenteService = $incidenteService;
    }

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

        $userIncidents = $this->incidenteService->getIncidentsByUserId($_SESSION['user_id']);

        $this->view('dashboard.html.twig', ['incidents' => $userIncidents]);
    }
}
