<?php 
       $router->group(["prefix" => "Ruas"], function () use ($router) {

            $router->get("/{id}",           "RuasController@show");
            $router->get("/" ,              "RuasController@showAll");
            $router->post("/",              "RuasController@create");
            $router->put("/",               "RuasController@update");
            $router->delete("/{id}",        "RuasController@update");
        
        });