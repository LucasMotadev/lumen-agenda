<?php 
       $router->group(["prefix" => "Pessoas"], function () use ($router) {

            $router->get("/{id}",           "PessoasController@show");
            $router->get("/" ,              "PessoasController@showAll");
            $router->post("/",              "PessoasController@create");
            $router->put("/",               "PessoasController@update");
            $router->delete("/{id}",        "PessoasController@update");
        
        });