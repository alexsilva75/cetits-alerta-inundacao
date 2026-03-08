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

        if(isset($this->routes[$method][$url])) {

            list($controller, $action) = explode('@', $this->routes[$method][$url]);

            $controllerClass = "Controllers\\" . $controller;

            $controllerObj = new $controllerClass();
            $controllerObj->$action();

        } else {
            echo "Rota não encontrada";
        }
    }
}