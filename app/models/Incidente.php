<?php

namespace Models;


class Incidente
{
    private int $id;
    private string $descricao;
    private string $localizacao;
    private string $data_hora;
    private int $usuario_id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getLocalizacao(): string
    {
        return $this->localizacao;
    }

    public function setLocalizacao(string $localizacao): void
    {
        $this->localizacao = $localizacao;
    }

    public function getDataHora(): string
    {
        return $this->data_hora;
    }

    public function setDataHora(string $data_hora): void
    {
        $this->data_hora = $data_hora;
    }

    public function getUsuarioId(): int
    {
        return $this->usuario_id;
    }

    public function setUsuarioId(int $usuario_id): void
    {
        $this->usuario_id = $usuario_id;
    }
}