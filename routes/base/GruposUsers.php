<?php 
       $router->group(["prefix" => "GruposUsers"], function () use ($router) {

            $router->get("/{id}",           "GruposUsersController@show");
            $router->get("/" ,              "GruposUsersController@showAll");
            $router->post("/",              "GruposUsersController@create");
            $router->put("/",               "GruposUsersController@update");
            $router->delete("/{id}",        "GruposUsersController@update");
        
        });