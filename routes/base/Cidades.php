<?php 
       $router->group(["prefix" => "Cidades"], function () use ($router) {

            $router->get("/{id}",           "CidadesController@show");
            $router->get("/" ,              "CidadesController@showAll");
            $router->post("/",              "CidadesController@create");
            $router->put("/",               "CidadesController@update");
            $router->delete("/{id}",        "CidadesController@update");
        
        });