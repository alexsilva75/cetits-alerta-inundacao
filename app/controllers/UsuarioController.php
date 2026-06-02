<?php

namespace Controllers;

class UsuarioController
{
    private $usuarioRepository;

    public function __construct()
    {
        $this->usuarioRepository = new \Repositories\UsuarioRepository();
    }

    public function index()
    {
        $usuarios = $this->usuarioRepository->findAll();
        require_once '../app/views/usuarios/index.php';
    }

    public function show($id)
    {
        $usuario = $this->usuarioRepository->findById($id);
        require_once '../app/views/usuarios/show.php';
    }

    public function create()
    {
        require_once '../app/views/usuarios/create.php';
    }

    public function store($data)
    {
        $usuario = new \Models\Usuario();
        $usuario->setNome($data['nome']);
        $usuario->setEmail($data['email']);
        $this->usuarioRepository->save($usuario);
        header('Location: /usuarios');
    }
}