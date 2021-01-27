<?php

namespace App\Construct\Files;


use Illuminate\Http\Client\Request;

class ControllerFile extends BaseFile
{

    private  $namespace;
    private  $classNameController;
    private  $objectModel;
    private  $useModel;
    private  $objectValidate;
    private  $useValidate;



    public function setNamespace($name): void
    {
        $this->namespace = $name;
    }

    public function setModel($model): void
    {
        $this->model = $model;
    }

    public function setValidate($validate): void
    {
        $this->validate = $validate;
    }

    public function createClass(array $modelFile, string $pathController, $pathModel, $pathValidate)
    {
        foreach ($modelFile as $table => $value) {
            $this->classNameController = $this->classToCamelcase($table) . "Controller";

            $this->filename = base_path($pathController) . "/{$this->classNameController}.php";
            $this->namespace    =  $this->filePathToNamesape($pathController);
            $this->objectModel = $this->classToCamelcase($table);
            $this->useModel     =  $this->filePathToNamesape($pathModel . '/')  . "{$this->objectModel}";
            $this->objectValidate = $this->classToCamelcase($table) . "Validate";
            $this->useValidate  =   $this->filePathToNamesape($pathValidate . '/') . "{$this->objectValidate}";
            $this->createFile($this->filename, $this->getClass());
            $this->destroy();
        }
    }

    public function getClass(): string
    {

        // useModel
        // useValidate
        // classNameController
        // objectModel
        // objectValidate
        $file = __DIR__ . '\template\Controlle.txt';
        $template = file_get_contents($file);
        $template = preg_replace('/{{namespace}}/', $this->namespace, $template);
        $template = preg_replace('/{{useModel}}/', $this->useModel, $template);
        $template = preg_replace('/{{useValidate}}/', $this->useValidate, $template);
        $template = preg_replace('/{{classNameController}}/', $this->classNameController, $template);
        $template = preg_replace('/{{objectModel}}/', $this->objectModel, $template);
        $template = preg_replace('/{{objectValidate}}/', $this->objectValidate, $template);

        return $template;
    
    }

    private function destroy()
    {
        $this->namespace    = '';
        $this->objectModel = '';
        $this->useModel     =  '';
        $this->objectValidate = '';
        $this->useValidate  =   '';
    }
}
