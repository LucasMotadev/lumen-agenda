<?php

$files = scandir(__DIR__);

foreach ($files as  $value) {
   if(  $value != 'index.php' && 
        $value != '.' && 
        $value != '..' &&
        $value != 'base'
        ){
        require __DIR__. "/$value";
    } 
}