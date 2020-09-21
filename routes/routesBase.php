<?php

use App\Utils\Url;

$router->group(['prefix' => 'base'], function () use ($router) {
  $route = Url::uriToMethod($_SERVER['REQUEST_URI']);

  $router->get($route .    '/{id}',    "BaseController@show");
  $router->put($route .    '/{id}',    "BaseController@update");
  $router->delete($route . '/{id}',    "BaseController@delete");
  $router->get($route .    '/',        "BaseController@showAll");
  $router->post($route .   '/',        "BaseController@create");
  
});
