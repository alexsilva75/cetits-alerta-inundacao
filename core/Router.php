<?php

namespace Core;

class Router {

    private $routes = [];

    public function add($method, $route, $action)
    {
        $this->routes[$method][$route] = $action;
    }

    public function dispatch($url)
    {
        $method = $_SERVER['REQUEST_METHOD'];
       // echo "URL: $url, Method: $method<br>";
       $baseUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if(isset($this->routes[$method][$baseUrl])) {

            list($controller, $action) = explode('@', $this->routes[$method][$baseUrl]);

            $controllerClass = "Controllers\\" . $controller;


            $requestData = match ($method) {
                'GET' => $_GET,
                'POST' => $_POST,
                default => []
            };

            error_log("Rota encontrada: $controllerClass@$action");
            $controllerObj = new $controllerClass();
            $controllerObj->$action($requestData);

        } else {
            echo "Rota não encontrada";
        }
    }
}