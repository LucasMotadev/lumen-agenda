<?php

$router->group(['prefix' => 'construct'], function () use ($router) {

    $router->group(['prefix' => 'table'], function () use ($router) {
    
        $router->get('/',   'Controller\\TableController@index');
        
        $router->group(['prefix' => 'created'], function () use ($router) {
            $router->post('/',   'Controller\\TableController@createdsResouces');
            $router->post('/{table}',   'Controller\\TableController@createdResouce');
        });
 
    });


});
