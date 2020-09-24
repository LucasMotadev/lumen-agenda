<?php

namespace App\Construct\Files;

class Router extends Utils {

    private $routerGroup = '';


    public function setRouterGroup($prefix){

       $this->routerGroup =  '<?php 
       $router->group(["prefix" => "'.$prefix.'"], function () use ($router) {

            $router->get("/{id}",           "'.$prefix.'Controller@show");
            $router->get("/" ,              "'.$prefix.'Controller@showAll");
            $router->post("/",              "'.$prefix.'Controller@create");
            $router->put("/",               "'.$prefix.'Controller@update");
            $router->delete("/{id}",        "'.$prefix.'Controller@update");
        
        });';
    }

    public function getRouterGroup(){
        
        return $this->routerGroup;

    }
}