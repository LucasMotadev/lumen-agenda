<?php

$router->group(['prefix' => 'construct'], function () use ($router) {

    $router->group(['prefix' => 'table'], function () use ($router) {
    
        
        $router->group(['prefix' => 'created'], function () use ($router) {
            $router->post('/all',   'Controller\\TableController@createdsResouces');
            $router->post('/',      'Controller\\TableController@createdResouce');
        });

        $router->get('/{table}',   'Controller\\TableController@getModelValidate');
        $router->get('/',   'Controller\\TableController@index');
    });


});
