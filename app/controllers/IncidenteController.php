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


}