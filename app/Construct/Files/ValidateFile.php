<?php

namespace App\Construct\Files;

use App\Construct\Orm\ImodelValidate;

class ValidateFile extends BaseFile implements IFile
{

    protected $filename;
    protected  $arrStringClass  = [];

  

    public function __construct(ImodelValidate $modelValidate, string $relativePath)
    {
        $this->modelValidate = $modelValidate;
        $this->relativePath = $relativePath;
    }

    public function updateRules(array $rules)
    {
        $updateRules = [];
        foreach ($rules as $column => $validate) {
            $updateRules[$column] = preg_replace('/(required\|)|(\|required)/', '',$validate);
        }
        return $updateRules;
    }
    
    public function arrayToStringArray($arr){
        $string = '';
        foreach ($arr as $key => $value) {
            $string .= "'$key' => '$value'," ;
        }
        return substr($string,0,-1);
    }


    public function writeClass()
    {
        foreach ($this->modelValidate->get() as $table => $value) {
            $this->namespace = $this->filePathToNamesape($this->relativePath);
            $this->className = $this->snakeCaseToPascalCase($table);
            $this->getCreateRules = $this->arrayToStringArray($value['validate']);
            $this->getUpdateRules = $this->arrayToStringArray($this->updateRules($value['validate']));
            $this->filename = base_path($this->relativePath) . "/{$this->className}Validate.php";

            array_push($this->arrStringClass, ['class' => $this->buildTemplate(), 'filename' => $this->filename]);
            // $this->createFile($this->filename, $this->getClass());
            $this->destroy();
        }

        return $this;
    }


    public function buildTemplate(): string
    {
        //         namespace
        // className
        // getCreateRules
        // getUpdateRules
        $file = __DIR__ . '\template\validate.txt';
        $template = file_get_contents($file);
        $template = preg_replace('/{{namespace}}/', $this->namespace, $template);
        $template = preg_replace('/{{className}}/', $this->className, $template);
        $template = preg_replace('/{{getCreateRules}}/', $this->getCreateRules, $template);
        $template = preg_replace('/{{getUpdateRules}}/', $this->getUpdateRules, $template);
 

        return $template;
    }

    public function destroy()
    {
        $this->table = '';
        $this->fillabe = '';
        $this->primaryKey = '';
        $this->hasMany = '';
        $this->belongsTo = '';
        $this->filename = '';
        $this->namespace = '';
    }
}
