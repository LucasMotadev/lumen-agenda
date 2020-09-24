<?php 
       $router->group(["prefix" => "GrupoPermissions"], function () use ($router) {

            $router->get("/{id}",           "GrupoPermissionsController@show");
            $router->get("/" ,              "GrupoPermissionsController@showAll");
            $router->post("/",              "GrupoPermissionsController@create");
            $router->put("/",               "GrupoPermissionsController@update");
            $router->delete("/{id}",        "GrupoPermissionsController@update");
        
        });