<?php

namespace App\Utils;

class Url {
   
    public static function uriToMethod($uri){

        preg_match('/(?<=base\/).*(?=\/)|(?<=base\/).*/', $uri , $routers );

        if(isset($routers[0]) && !empty($routers[0])){
            
        return $routers[0];

        }
    }
}