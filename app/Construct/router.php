<?php

$router->group(['prefix' => 'construct'], function () use ($router) {

    $router->get('model',   'Controller\\CreateModels@create');
    $router->get('router' ,   'Controller\\CreateRouter@showAll');

});
