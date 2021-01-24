<?php

$router->group(['prefix' => 'construct'], function () use ($router) {

    $router->group(['prefix' => 'resorce'], function () use ($router) {

        $router->get('/',   'Created\\CreateModels@index');
        $router->get('/{table}',   'Created\\CreateModels@show');
        $router->post('/',   'Created\\CreateModels@store');
       // $router->get('router' ,   'Controller\\CreateRouter@showAll');
    
    });

    $router->group(['prefix' => 'table'], function () use ($router) {

        $router->get('/',   'Controller\\TableController@index');
        $router->post('/{table}',   'Controller\\TableController@createdResouce');
   
       // $router->get('router' ,   'Controller\\CreateRouter@showAll');
    });





});
