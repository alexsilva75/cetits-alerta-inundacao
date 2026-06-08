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

    public function createIncidente($incidente)
    {
        // Validação dos dados do incidente
        if (!$incidente->latitude || !$incidente->longitude) {
            throw new \Exception("Latitude e Longitude são obrigatórios.");
        }

       
        return $this->incidenteRepository->createIncidente($incidente);
    }

    public function getIncidentsInCitySince($city, $uf ,$days = 30){
        $date = new \DateTime();
        $date->modify("-$days days");
        $formattedDate = $date->format('Y-m-d H:i:s');
        //var_dump($formattedDate);
        return $this->incidenteRepository->findIncidentsInCitySince($formattedDate, $city, $uf);
    }
}