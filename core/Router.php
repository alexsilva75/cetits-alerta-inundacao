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
        error_log("IN ROUTER URL: $url, Method: $method");
        $baseUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        error_log("Processando rota: $baseUrl, Método: $method");

        $baseUrl = $baseUrl == '/' || $baseUrl == '' ? '/index' : $baseUrl;

        if (!$this->resolveUnparameterizedRoute($baseUrl, $method) && !$this->resolveParameterizedRoute($url, $method)) {
            //echo "Rota não encontrada";
            http_response_code(404);
            echo "404 Not Found";
        }               
        
    }

    private function resolveUnparameterizedRoute($baseUrl, $method)
    {
        
        if (isset($this->routes[$method][$baseUrl])) {

            $this->doControllerAction($this->routes[$method][$baseUrl]);
           
            /*$requestData = match ($method) {
                'GET' => $_GET,
                'POST' => $_POST,
                default => []
            };*/

            
            return true;
        } else {
            //echo "Rota não encontrada";

            return false;
        }
    }

    private function resolveParameterizedRoute($url, $method)
    {        

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
                        
                $this->doControllerAction($this->routes[$method][$route], $params);
                
                return true;

            } else{
                continue;
            }
        }

        echo "Rota não encontrada";
        return false;
    }

    private function doControllerAction($handler, $params = [])
    {
        try {
            error_log("Resolvendo controlador: $handler, Parâmetros: " . json_encode($params));
            list($controller, $action) = explode('@', $handler);
            $controllerClass = "Controllers\\" . $controller;

            $container = new Container();

            $request = new Request();

            if (!empty($params)) {
                $request->setRouteParams($params);
            }

            error_log("Resolvendo controlador: $controllerClass->$action, Parâmetros: " . json_encode($params));
            
            $controllerObj = $container->make($controllerClass);//new $controllerClass();
            $controllerObj->$action($request);
        } catch (\Exception $e) {
            error_log("Erro ao resolver controlador: " . $e->getMessage());
            http_response_code(500);
            echo "500 Internal Server Error";
        }
       
    }
}
