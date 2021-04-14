<?php

namespace App\Construct\Orm;

use App\Construct\Files\ControllerFile;
use App\Construct\Files\ModelFile;
use App\Construct\Files\RouterFile;
use App\Construct\Files\ValidateFile;
use App\Construct\Orm\Mysql\InitModelEndValidate;
class Orm
{
    private $modelEndValidate;
    public function __construct($table)
    {
        $this->table = $table;
    }
    public function mysql()
    {
        $this->modelEndValidate = new InitModelEndValidate($this->table);
        return $this;
    }

    public function getClassModel($filename){

        $modelFile = new ModelFile($this->modelEndValidate, $filename);
        $class = $modelFile->writeClass();
        $class->create();
        return $class->get();

    }

    public function getClassValidate($relativePath){
        $validateFile = new ValidateFile($this->modelValidate, $relativePath);
        $class = $validateFile->writeClass();
        $class->create();
        return $class->get();
    }

    public function getClassController($relativePath, $namespaceModel, $namespaceValidate = null){
        $controllerFile = new ControllerFile($this->table, $relativePath, $namespaceModel, $namespaceValidate);
        $class = $controllerFile->writeClass();
        $class->create();
        return $class->get();
    }

    public function getRouter($relativePathController){
        $router = new RouterFile($this->table, $relativePathController);
        $class = $router->writeClass();
        $class->create();
        return $class->get();
    }

    public function getModelValidate(){
        return $this->modelValidate->get();
    }

}
