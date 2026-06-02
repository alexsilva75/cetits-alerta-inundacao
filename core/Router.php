<?php

namespace Core;

class Router
{

    private $routes = [];

    public function add($method, $route, $action)
    {
        $this->routes[$method][$route] = $action;
    }

    public function dispatch($url)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        // echo "URL: $url, Method: $method<br>";
        error_log("IN ROUTER URL: $url, Method: $method");
        $baseUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        error_log("Processando rota: $baseUrl, Método: $method");

        $baseUrl = $baseUrl == '/' || $baseUrl == '' ? '/index' : $baseUrl;

        if (isset($this->routes[$method][$baseUrl])) {

            list($controller, $action) = explode('@', $this->routes[$method][$baseUrl]);

            $controllerClass = "Controllers\\" . $controller;


            $requestData = match ($method) {
                'GET' => $_GET,
                'POST' => $_POST,
                default => []
            };

            error_log("Rota encontrada: $controllerClass->$action, Dados da requisição: " . json_encode($requestData));
            $controllerObj = new $controllerClass();

            ///loginController->showLogin($_GET);
            $controllerObj->$action($requestData);
        } else {
            echo "Rota não encontrada";
        }
    }
}
