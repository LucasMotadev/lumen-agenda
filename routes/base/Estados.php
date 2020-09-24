<?php 
       $router->group(["prefix" => "Estados"], function () use ($router) {

            $router->get("/{id}",           "EstadosController@show");
            $router->get("/" ,              "EstadosController@showAll");
            $router->post("/",              "EstadosController@create");
            $router->put("/",               "EstadosController@update");
            $router->delete("/{id}",        "EstadosController@update");
        
        });