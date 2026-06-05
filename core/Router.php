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

        if (!$this->resolveUnparameterizedRoute($url, $method)) {
            //echo "Rota não encontrada";
           // http_response_code(404);
            //echo "404 Not Found";

            $this->resolveParameterizedRoute($url, $method);
        }
        
    }

    private function resolveUnparameterizedRoute($url, $method)
    {
        // echo "URL: $url, Method: $method<br>";
        error_log("IN ROUTER URL: $url, Method: $method");
        $baseUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        error_log("Processando rota: $baseUrl, Método: $method");

        $baseUrl = $baseUrl == '/' || $baseUrl == '' ? '/index' : $baseUrl;

        if (isset($this->routes[$method][$baseUrl])) {

            list($controller, $action) = explode('@', $this->routes[$method][$baseUrl]);

            $controllerClass = "Controllers\\" . $controller;


            /*$requestData = match ($method) {
                'GET' => $_GET,
                'POST' => $_POST,
                default => []
            };*/

            $request = new Request();

            $container = new Container();
            error_log("Rota encontrada: $controllerClass->$action, Dados da requisição: " . json_encode($request->all()));
            
            $controllerObj = $container->make($controllerClass);//new $controllerClass();
          
            $controllerObj->$action($request);
            return true;
        } else {
            //echo "Rota não encontrada";

            return false;
        }
    }

    private function resolveParameterizedRoute($url, $method)
    {
        error_log("IN ROUTER URL: $url, Method: $method");
        $baseUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        error_log("Processando rota: $baseUrl, Método: $method");

        $baseUrl = $baseUrl == '/' || $baseUrl == '' ? '/index' : $baseUrl;

        foreach ($this->routes[$method] as $route => $handler) {

            if(preg_match('/\{[^}]+\}/', $route) === 0){
                continue; // Pula rotas sem parâmetros
            }

            $pattern = preg_replace(
                '/\{[^}]+\}/',
                '([^/]+)',
                $route
            );

            $pattern = '#^' . $pattern . '$#';
            //echo("Pattern: $pattern, URL: $url<br>");

            if (preg_match(
                $pattern,
                $url,
                $matches
            )) {


                $value = array_shift($matches);      
        
                
                preg_match_all(
                        '/\{([^}]+)\}/',
                        $route,
                        $paramNames
                    );

                    // parâmetros encontrados
                    
                    $params = array_combine(
                            $paramNames[1],
                            $matches
                        );
                        
                    list($controller, $action) = explode('@', $this->routes[$method][$route]);

                $controllerClass = "Controllers\\" . $controller;


                /*$requestData = match ($method) {
                    'GET' => $_GET,
                    'POST' => $_POST,
                    default => []
                };*/

                $request = new Request();

                $request->setRouteParams($params);

                $container = new Container();
                error_log("Rota encontrada: $controllerClass->$action, Dados da requisição: " . json_encode($request->all()));
                
                $controllerObj = $container->make($controllerClass);//new $controllerClass();
            
                $controllerObj->$action($request);
                return true;

            } else{
                continue;
            }
        }

        echo "Rota não encontrada";
        return false;
    }
}
