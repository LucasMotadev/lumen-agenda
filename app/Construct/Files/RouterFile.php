<?php

namespace App\Construct\Files;

use Exception;

class RouterFile extends BaseFile {

    private $routerGroup = '';

    #O filenameController dever estar apartir de app/Http/Controllers/  diretorio padrão do laravel.
    private function pathControllerToRelativePathController($filenameController)
     {    $relativePath = preg_match('/(?<=Controllers\/).*/', $filenameController, $arrRelativePath);
        if($relativePath){
            return $arrRelativePath[1];
        }
        throw new Exception('Error: Filename não informado, o file name dever estar em Controllers/');
    }
    public function createClass($prefix, $filename, $filenameController){

        $file =  $file = __DIR__ . '\template\router.txt';
        $template = file_get_contents($file);
        $template = preg_replace('/{{prefix}}/', $this->methodToCamelcase($prefix), $template);
        $template = preg_replace('/{{filename}}/', $this->pathControllerToRelativePathController($filenameController), $template);
        $this->routerGroup =  $template;
        $this->destroy();
    }

    public function getClass(){
        
        return $this->routerGroup;

    }

    public function destroy(){
        $this->routerGroup = '';
    }
}