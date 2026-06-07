<?php

namespace Models;


class Incidente
{
    public int $id;
    public string $titulo;

    public string $descricao;
    public string $logradouro;
    public string $bairro;
    public string $cidade;
    public string $uf;
    public DateTime $data_hora;
    public int $usuario_id;
    public float $latitude;
    public float $longitude;
    public DateTime $criado_em;

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

    public function getLogradouro(): string
    {
        return $this->logradouro;
    }

    public function setLogradouro(string $logradouro): void
    {
        $this->logradouro = $logradouro;
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

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }

    public function setBairro(string $bairro){
        $this->bairro = $bairro;
    }

    public function getBairro(){
        return $this->bairro;
    }

    public function setCidade(string $cidade){
        $this->cidade = $cidade;
    }

    public function getCidade(){
        return $this->cidade;
    }

    public function setUf(string $uf){
        $this->uf = $uf;
    }

    public function getUf(){
        return $this->uf;
    }

}