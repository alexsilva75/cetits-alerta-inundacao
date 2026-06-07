<?php

namespace Services;
use Repositories\IncidenteRepository;


class IncidenteService{

    private $incidenteRepository;


    public function __construct(IncidenteRepository $incidenteRepository)
    {
        $this->incidenteRepository = $incidenteRepository;
    }
    
    public function getLastWeeksIncidents($weeks = 4)
    {
        $date = new \DateTime();
        $date->modify("-$weeks weeks");
        $formattedDate = $date->format('Y-m-d H:i:s');

        return $this->incidenteRepository->findIncidentsSince($formattedDate);
    }

    public function getIncidentsByUserId($userId)
    {
        return $this->incidenteRepository->getIncidentesByUsuarioId($userId);
    }

    public function createIncidente($incidenteData)
    {
        // Validação dos dados do incidente
        if (empty($incidenteData['latitude']) || empty($incidenteData['longitude'])) {
            throw new \Exception("Latitude e Longitude são obrigatórios.");
        }

        // Criação do incidente
        $incidente = [
            'usuario_id' => $incidenteData['usuario_id'],
            'latitude' => $incidenteData['latitude'],
            'longitude' => $incidenteData['longitude'],
            'descricao' => $incidenteData['descricao'] ?? null,
            'criado_em' => date('Y-m-d H:i:s')
        ];

        return $this->incidenteRepository->createIncidente($incidente);
    }
}