<?php 
       $router->group(["prefix" => "Emails"], function () use ($router) {

            $router->get("/{id}",           "EmailsController@show");
            $router->get("/" ,              "EmailsController@showAll");
            $router->post("/",              "EmailsController@create");
            $router->put("/",               "EmailsController@update");
            $router->delete("/{id}",        "EmailsController@update");
        
        });