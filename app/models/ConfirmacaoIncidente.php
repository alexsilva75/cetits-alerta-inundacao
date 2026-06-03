<?php

namespace Models;

class ConfirmacaoIncidente
{
    private int $id;
    private int $incidente_id;
    private int $usuario_id;
    private string $data_hora;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getIncidenteId(): int
    {
        return $this->incidente_id;
    }

    public function setIncidenteId(int $incidente_id): void
    {
        $this->incidente_id = $incidente_id;
    }

    public function getUsuarioId(): int
    {
        return $this->usuario_id;
    }

    public function setUsuarioId(int $usuario_id): void
    {
        $this->usuario_id = $usuario_id;
    }

    public function getDataHora(): string
    {
        return $this->data_hora;
    }

    public function setDataHora(string $data_hora): void
    {
        $this->data_hora = $data_hora;
    }
}