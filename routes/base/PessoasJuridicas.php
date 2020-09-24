<?php 
       $router->group(["prefix" => "PessoasJuridicas"], function () use ($router) {

            $router->get("/{id}",           "PessoasJuridicasController@show");
            $router->get("/" ,              "PessoasJuridicasController@showAll");
            $router->post("/",              "PessoasJuridicasController@create");
            $router->put("/",               "PessoasJuridicasController@update");
            $router->delete("/{id}",        "PessoasJuridicasController@update");
        
        });