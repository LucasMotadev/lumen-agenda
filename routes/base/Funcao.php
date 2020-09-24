<?php 
       $router->group(["prefix" => "Funcao"], function () use ($router) {

            $router->get("/{id}",           "FuncaoController@show");
            $router->get("/" ,              "FuncaoController@showAll");
            $router->post("/",              "FuncaoController@create");
            $router->put("/",               "FuncaoController@update");
            $router->delete("/{id}",        "FuncaoController@update");
        
        });