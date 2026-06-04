<?php
namespace Controllers;
use Services\IncidenteService;

class IndexController extends \Core\Controller{

    private $incidenteService;

    public function __construct(IncidenteService $incidenteService)
    {
       // parent::__construct();
        $this->incidenteService = $incidenteService;
    }
    

    public function index()
    {
        
        $lastWeeksIncidents = $this->incidenteService->getLastWeeksIncidents();
        // Aqui você pode passar os incidentes para a view, por exemplo, usando uma variável
        
        //require_once '../app/views/index.html';

        $this->view('index.html.twig', [
            'incidentes' => $lastWeeksIncidents
        ]);
    }
}