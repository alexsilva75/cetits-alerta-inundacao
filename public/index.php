<?php
require_once '../vendor/autoload.php';

use \Core\Router;

$router = new Router();

$router->add('GET', '/index', 'IndexController@index');


$url = $_GET['url'] ?? '/index';
$router->dispatch($url);