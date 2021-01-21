<?php

namespace App\Construct\Files;

class Router extends Utils {

    private $routerGroup = '';


    public function setRouterGroup($prefix){

       $this->routerGroup =  '<?php 
       $router->group(["prefix" => "'.$prefix.'", "middleware" => "auth"], function () use ($router) {

            $router->get("/{id}",           ["uses" => "'.$prefix.'Controller@show"]);
            $router->get("/" ,              ["uses" => "'.$prefix.'Controller@index"]);
            $router->post("/",              ["uses" => "'.$prefix.'Controller@store"]);
            $router->put("/",               ["uses" => "'.$prefix.'Controller@update"]);
            $router->delete("/{id}",        ["uses" => "'.$prefix.'Controller@destroy"]);
        
        });';
    }

    public function getRouterGroup(){
        
        return $this->routerGroup;

    }
}