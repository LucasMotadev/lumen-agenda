<?php

namespace App\Construct\Orm;

use App\Construct\Files\ControllerFile;
use App\Construct\Model\Columns;
use App\Construct\Model\keys;

use App\Construct\Files\ModelFile;
use App\Construct\Files\RouterFile;
use App\Construct\Files\ValidateFile;
use App\Construct\Orm\Mysql\InitModelValidate;
use App\Construct\Orm\Mysql\ModelValidateKeys;
use Illuminate\Http\Request;


class Orm
{
    private $modelValidate;
    public function __construct($table = null)
    {
        $this->table = $table;
    }
    public function mysql()
    {
        $this->modelValidate = new ModelValidateKeys(new InitModelValidate($this->table));
        return $this;
    }

    #caminho relativo apartir da  /
    #exemplo app/model/empresas
    public function getClassModel($relativePath){
        $modelFile = new ModelFile($this->modelValidate, $relativePath);
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
