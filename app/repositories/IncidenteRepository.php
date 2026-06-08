<?php

namespace Repositories;

class IncidenteRepository extends Repository
{
 
public function createIncidente($incidente){
    // Lógica para salvar o incidente no banco de dados 
    $query = <<<SQL
                INSERT INTO incidente
                 (titulo,usuario_id, logradouro, bairro, cidade, uf, latitude, longitude, descricao, data_hora, criado_em) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    SQL;

    $stmt = $this->pdo->prepare($query);
    $stmt->execute([
        $incidente->titulo,
        $incidente->usuario_id,
        $incidente->logradouro,
        $incidente->bairro,
        $incidente->cidade,
        $incidente->uf,
        $incidente->latitude,
        $incidente->longitude,
        $incidente->descricao,
        $incidente->data_hora ?? date('Y-m-d H:i:s'),
        $incidente->criado_em ?? date('Y-m-d H:i:s')
    ]);
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
    $stmt = $this->pdo->prepare("SELECT * FROM incidente WHERE id = ?");
    $stmt->execute([$usuarioId]);
    return $stmt->fetchAll();
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

public function findIncidentsInCitySince($data, $city, $uf){
    // Lógica para recuperar os incidentes desde uma data específica do banco de dados
    //echo $data;
    //var_dump($city);
    //echo $uf;
    $query = <<<SQL
        SELECT * FROM incidente WHERE criado_em >= ? AND cidade = ? AND uf = ?
    SQL;
    $stmt = $this->pdo->prepare($query);
    $stmt->execute([$data, $city, $uf]);
    return $stmt->fetchAll();

}

public function save($incidente){
    // Lógica para salvar ou atualizar um incidente no banco de dados
    if (isset($incidente['id'])) {
        return $this->updateIncidente($incidente['id'], $incidente);
    } else {
        return $this->createIncidente($incidente);
    }
}

}