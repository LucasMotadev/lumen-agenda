<?php

namespace App\Construct\Files;

use App\Construct\Orm\ImodelValidate;
use Illuminate\Http\Client\Request;

class ControllerFile extends BaseFile
{

    private  $namespace;
    private  $classNameController;
    private  $objectModel;
    private  $useModel;
    private  $objectValidate;
    private  $useValidate;
    protected $filename;  
    protected  $arrStringClass = [];

    public function __construct($tables, string $relativePath, string $namespaceModel, $nameSpaceValidate = null)
    {
        $this->tables = $tables;
        $this->relativePath = $relativePath;
        $this->namespaceModel = $namespaceModel;
        $this->nameSpaceValidate =  $nameSpaceValidate;
    }
    public function writeClass()
    {
        $tables = explode(',', $this->tables);

        foreach ($tables as $table) {
            $this->classNameController = $this->snakeCaseToPascalCase($table) . "Controller";

            $this->filename         = base_path($this->relativePath) . "/{$this->classNameController}.php";
            $this->namespace        = $this->filePathToNamesape($this->relativePath);
            $this->objectModel      = $this->snakeCaseToPascalCase($table);
            $this->useModel         = $this->filePathToNamesape($this->namespaceModel . '/')  . "{$this->objectModel}";
            $this->objectValidate   = $this->snakeCaseToPascalCase($table) . "Validate";
            $this->useValidate      = $this->filePathToNamesape($this->nameSpaceValidate . '/') . "{$this->objectValidate}";
            array_push($this->arrStringClass, ['class' => $this->buildTemplate(), 'filename' => $this->filename]);
            //$this->createFile($this->filename, $this->getClass());
            $this->destroy();
        }
        return $this;
    }

    public function buildTemplate(): string
    {

        $file = __DIR__ . '\template\controlle.txt';
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
