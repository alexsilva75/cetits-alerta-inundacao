<?php

namespace Core;

class Request
{

    private array $body = [];
    private array $query = [];
    private array $files = [];
    private array $cookies = [];
    private array $headers = [];
    private array $server = [];
    private array $routeParams = [];


    public function __construct()
    {
        $this->body = $_POST;
        $this->query = $_GET;
        $this->files = $_FILES;
        $this->cookies = $_COOKIE;
        $this->headers = getallheaders();
        $this->server = $_SERVER;
    }

    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    public function method()
    {
        return $this->server['REQUEST_METHOD']; //strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function body()
    {
        return $this->body;
    }

    public function query()
    {
        return $this->query;
    }

    public function uri(): string
    {
        return parse_url(
            $this->server['REQUEST_URI'],
            PHP_URL_PATH
        );
    }

    public function files()
    {
        return $this->files;
    }

    public function cookies()
    {
        return $this->cookies;
    }

    public function headers()
    {
        return $this->headers;
    }

    public function server()
    {
        return $this->server;
    }

    public function input($key, $default = null)
    {
        return $this->body[$key] ?? $this->query[$key] ?? $default;
    }

    public function all()
    {
        return array_merge($this->query, $this->body);
    }

    public function header($key, $default = null)
    {
        return $this->headers[$key] ?? $default;
    }

    public function cookie($key, $default = null)
    {
        return $this->cookies[$key] ?? $default;
    }

    public function file($key, $default = null)
    {
        return $this->files[$key] ?? $default;
    }

    public function serverParam($key, $default = null)
    {
        return $this->server[$key] ?? $default;
    }

    public function isAjax()
    {
        return $this->header('X-Requested-With') === 'XMLHttpRequest';
    }

    public function isJson()
    {
        return strpos($this->header('Content-Type', ''), 'application/json') !== false;
    }

    public function isGet()
    {
        return $this->method() === 'GET';
    }

    public function isPost()
    {
        return $this->method() === 'POST';
    }

    public function setRouteParams(
        array $params
    ): void
    {
        error_log("Definindo parâmetros de rota: " . json_encode($params));
        $this->routeParams = $params;
    }

    public function route(
        string $key,
        mixed $default = null
    ): mixed
    {
        return $this->routeParams[$key]
            ?? $default;
    }
}