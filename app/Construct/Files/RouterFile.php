<?php

namespace App\Construct\Files;

use Exception;

class RouterFile extends BaseFile implements IFile {

    protected $arrStringClass = [];

    public function __construct($tables, $pathController)
    {
        $this->tables = $tables;
        $this->pathController =  $pathController;
    }

    #O relativePathController dever estar apartir de app/Http/Controllers/  diretorio padrão do laravel.
    private function pathControllerToRelativePathController($relativePathController)
     {   
        
        $relativePath = preg_match('/(?<=Controllers\/).*/', $relativePathController, $arrRelativePath);
        if($relativePath){
            return $arrRelativePath[0];
        }
        throw new Exception('Error: Filename não informado, o file name dever estar em Controllers/');
    }
    public function writeClass(){
        $tables = explode(',', $this->tables);
        foreach ($tables as  $table) {
            $this->prefix =  $this->snakeCaseToCamelcase($table);
            $this->filename = base_path("routes/api/{$this->prefix}.php");
            $this->relativePathController = 
                $this->pathControllerToRelativePathController($this->pathController) . 
                '\\'.
               $this->snakeCaseToPascalCase($this->prefix) . 'Controller';
            array_push($this->arrStringClass, ['class' => $this->buildTemplate(), 'filename' => $this->filename]);
            $this->destroy();
        }
        return $this;
    }

    public function getArrStringClass(): array
    {
        return $this->arrStringClass;
    }

    public function buildTemplate():string
    {

        $file  = __DIR__ . '\template\router.txt';
        $template = file_get_contents($file);
        $template = preg_replace('/{{prefix}}/',$this->prefix, $template);
        $template = preg_replace('/{{relativePathController}}/',$this->relativePathController, $template);
        return $template;
    }

    public function destroy(){
        $this->prefix = '';
    }
}