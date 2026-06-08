<?php

namespace Controllers;

use Core\Request;
use Core\Response;
use Models\Incidente;
use Services\IncidenteService;

class IncidenteController extends \Core\Controller
{
    private $incidenteService;
    public function __construct(IncidenteService $incidenteService){
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

    public function store(Request $request, Response $response){

        $user = $request->session('user');

        $incidente = new Incidente();
        $incidente->titulo = $request->input('titulo');
        $incidente->descricao = $request->input('descricao');
        $incidente->logradouro = $request->input('logradouro');
        $incidente->bairro = $request->input('bairro');
        $incidente->cidade = $request->input('cidade');
        $incidente->uf = $request->input('uf');
        $incidente->usuario_id = $user->id;
        $incidente->latitude = (float) $request->input('latitude');
        $incidente->longitude = (float) $request->input('longitude');

        $this->incidenteService->createIncidente($incidente);


        header('Location: /dashboard');
    }

    public function fetch($request)
    {
        $id = $request->route('id');
        // Aqui você pode buscar o incidente pelo ID e passar os dados para a view
        //$this->view('incidente_detail.html.twig', ['id' => $id]);

        echo "Detalhes do incidente com ID: $id";
    }

    public function lastIncidentsInLocation(Request $request, Response $response)
    {
        try {
            
            $city = $request->input('city');
            $uf = $request->input('uf');
            $incidentes = $this->incidenteService->getIncidentsInCitySince($city, $uf);
           
            $this->view('layouts/partials/_incidentes.html.twig', [
                'incidentes' => $incidentes
            ]);
        } catch (\Exception $e) {
            return $response->json(['error' => 'Erro ao buscar incidentes: ' . $e->getMessage()], 500);
        }
    }

}