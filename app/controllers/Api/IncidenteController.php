<?php

namespace Controllers\Api;

use Core\Request;
use Core\Response;  
use Services\IncidenteService;

class IncidenteController extends \Core\Controller
{
    private $incidenteService;

    public function __construct(IncidenteService $incidenteService)
    {
        $this->incidenteService = $incidenteService;
    }

    public function index()
    {
        $this->view('list_incidentes.html.twig');
    }

    public function create()
    {
        $this->view('create_incidente.html.twig');
    }

    public function fetch($request)
    {
        $id = $request->route('id');
        // Aqui você pode buscar o incidente pelo ID e passar os dados para a view
        //$this->view('incidente_detail.html.twig', ['id' => $id]);

        echo "Detalhes do incidente com ID: $id";
    }

    public function lastWeekIncidents(Request $request, Response $response)
    {
        try {
            $incidentes = $this->incidenteService->getLastWeeksIncidents();
            return $response->json($incidentes);
        } catch (\Exception $e) {
            return $response->json(['error' => 'Erro ao buscar incidentes: ' . $e->getMessage()], 500);
        }
    }

}