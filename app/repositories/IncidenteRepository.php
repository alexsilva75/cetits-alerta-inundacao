<?php

namespace Repositories;

class IncidenteRepository extends Repository
{
 
public function createIncidente($incidente){
    // Lógica para salvar o incidente no banco de dados 
}

public function getIncidentes(){
    // Lógica para recuperar os incidentes do banco de dados

}


public function getIncidenteById($id){
    // Lógica para recuperar um incidente específico do banco de dados      

}

public function updateIncidente($id, $incidente){
    // Lógica para atualizar um incidente específico no banco de dados

}

public function deleteIncidente($id){
    // Lógica para deletar um incidente específico do banco de dados

}

public function getIncidentesByUsuarioId($usuarioId){
    // Lógica para recuperar os incidentes de um usuário específico do banco de dados

}

public function getIncidentesByLocalizacao($latitude, $longitude, $radius){
    // Lógica para recuperar os incidentes próximos a uma localização específica do banco de dados

}

public function getIncidentesByData($data){
    // Lógica para recuperar os incidentes de uma data específica do banco de dados

}


public function getIncidentesByPeriodo($dataInicio, $dataFim){
    // Lógica para recuperar os incidentes de um período específico do banco de dados
    $stmt = $this->pdo->prepare("SELECT * FROM incidente WHERE criado_em BETWEEN ? AND ?");
    $stmt->execute([$dataInicio, $dataFim]);
    return $stmt->fetchAll();

}

public function findIncidentsSince($data){
    // Lógica para recuperar os incidentes desde uma data específica do banco de dados
    $stmt = $this->pdo->prepare("SELECT * FROM incidente WHERE criado_em >= ?");
    $stmt->execute([$data]);
    return $stmt->fetchAll();

}

}