<?php

namespace Controllers;

class IncidenteController
{
    public function index()
    {
        include __DIR__ . '/../views/list_incidentes.html';
    }

    public function create()
    {
        include __DIR__ . '/../views/create_incidente.html';
    }

    
}