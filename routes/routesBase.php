<?php

use App\Utils\Url;

$router->group(['prefix' => 'base'], function () use ($router) {

    $route = Url::uriToMethod($_SERVER['REQUEST_URI']);
    $method = ucfirst($route);

    $router->get($route .    '/{id}',    "{$method}Controller@show");
    $router->put($route .    '/{id}',    "{$method}Controller@update");
    $router->delete($route . '/{id}',    "{$method}Controller@delete");
    $router->get($route .    '/',        "{$method}Controller@showAll");
    $router->post($route .   '/',        "{$method}Controller@create");  
    
});

