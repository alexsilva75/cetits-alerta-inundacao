<?php

namespace Controllers;

class IncidenteController extends \Core\Controller
{
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


}