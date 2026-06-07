<?php
require_once '../vendor/autoload.php';
session_start();



use \Core\Router;
use Core\View;

$router = new Router();

View::init();

$router->add('GET', '/index', 'IndexController@index');
$router->add('GET', '/usuarios', 'UsuarioController@index');
$router->add('GET', '/usuarios/create', 'UsuarioController@create');

$router->add('POST', '/usuarios/store', 'UsuarioController@store');
$router->add('GET', '/login', 'LoginController@showLogin');
$router->add('POST', '/login', 'LoginController@autenticar');
$router->add('GET', '/dashboard', 'DashboardController@showDashboard');
$router->add('GET', '/showRegistrar', 'LoginController@showRegistrar');
$router->add('POST', '/registrar', 'LoginController@registrar');

$router->add('GET', '/list-incidents', 'IncidenteController@index');
$router->add('GET', '/create-incident', 'IncidenteController@create');
$router->add('POST', '/incidentes/store', 'IncidenteController@store');
$router->add('GET', '/usuarios/{id}/edit', 'UsuarioController@edit');
$router->add('GET', '/incidentes/{id}', 'IncidenteController@fetch');
$router->add('GET', '/api/incidentes/last-week', 'Api\IncidenteController@lastWeekIncidents');


error_log("URL:".$_SERVER['REQUEST_URI']);

$url = $_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '' ? '/index' : $_SERVER['REQUEST_URI'];

error_log("Requisição recebida: URL: $url, Método: {$_SERVER['REQUEST_METHOD']}");  
$router->dispatch($url);