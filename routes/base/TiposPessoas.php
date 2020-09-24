<?php 
       $router->group(["prefix" => "TiposPessoas"], function () use ($router) {

            $router->get("/{id}",           "TiposPessoasController@show");
            $router->get("/" ,              "TiposPessoasController@showAll");
            $router->post("/",              "TiposPessoasController@create");
            $router->put("/",               "TiposPessoasController@update");
            $router->delete("/{id}",        "TiposPessoasController@update");
        
        });