<?php 
       $router->group(["prefix" => "Colaboradores"], function () use ($router) {

            $router->get("/{id}",           "ColaboradoresController@show");
            $router->get("/" ,              "ColaboradoresController@showAll");
            $router->post("/",              "ColaboradoresController@create");
            $router->put("/",               "ColaboradoresController@update");
            $router->delete("/{id}",        "ColaboradoresController@update");
        
        });