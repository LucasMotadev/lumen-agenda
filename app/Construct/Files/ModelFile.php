<?php

namespace App\Construct\Files;

use App\Construct\Orm\ImodelValidate;

class ModelFile extends BaseFile implements IFile
{
    private  $namespace = '';
    private  $classNameModel = "";
    private  $table = "";
    private  $fillable = "";
    private  $primaryKey = "";
    private  $hasMany = '';
    private  $belongsTo = '';
    protected $filename;
    protected $stringClass  = [];

    public function __construct($modelValidate, string $filename)
    {
        $this->modelValidate = $modelValidate;
        $this->filename = $filename;
    }

    private function table()
    {
        $this->table = strtolower($this->modelValidate->table);
    }

    private function fillable()
    {
        $this->fillable =  "'" .  strtolower(implode("','", $this->modelValidate->fillable)) . "'";
    }

    private function primaryKey()
    {
        $this->primaryKey = strtolower($this->modelValidate->primaryKey);
    }

    // um para muitos ou passar o parametro where  , um user pode ter varios telefones
    private function hasMany()
    {
        foreach ($this->modelValidate->hasMany as $key => $value) {

            $file =  $file = __DIR__ . '\template\hasMay.txt';

            $template = file_get_contents($file);
            $template = preg_replace('/{{nameMethod}}/', $this->snakeCaseToCamelcase($value['table']), $template);
            $template = preg_replace('/{{nameClassFk}}/', $this->snakeCaseToPascalCase($value['table']), $template);
            $template = preg_replace('/{{localkey}}/', strtolower($value['local_key']), $template);
            $template = preg_replace('/{{foreignKey}}/', strtolower($value['foreign_key']), $template);

            $this->hasMany .= $template;
        }
    }

    // um para um ou um para muitos inverso, acessar o dono do telefone
    private function belongsTo()
    {
        foreach ($this->modelValidate->belongsTo as $key => $value) {

            $file =  $file = __DIR__ . '\template\belongsTo.txt';

            $template = file_get_contents($file);
            $template = preg_replace('/{{nameMethod}}/', $this->snakeCaseToCamelcase($value['table']), $template);
            $template = preg_replace('/{{nameClassFk}}/', $this->snakeCaseToPascalCase($value['table']), $template);
            $template = preg_replace('/{{localkey}}/', strtolower($value['local_key']), $template);
            $template = preg_replace('/{{foreignKey}}/', strtolower($value['foreign_key']), $template);

            $this->belongsTo .= $template;
        }
    }

    public function writeClass()
    {
        $this->namespace = $this->filePathToNamesape($this->filename);
        $this->classNameModel = $this->snakeCaseToPascalCase($this->modelValidate->table);
        $this->table();
        $this->fillable();
        $this->primaryKey();
        $this->hasMany();
        $this->belongsTo();
        
        $this->stringClass = ['class' => $this->buildTemplate(), 'filename' => $this->filename];

        return $this;
    }

    public function buildTemplate(): string
    {
        $file = __DIR__ . '\template\model.txt';
        $template = file_get_contents($file);
        $template = preg_replace('/{{namespace}}/', $this->namespace, $template);
        $template = preg_replace('/{{classNameModel}}/', $this->classNameModel, $template);
        $template = preg_replace('/{{table}}/', $this->table, $template);
        $template = preg_replace('/{{fillable}}/', $this->fillable, $template);
        $template = preg_replace('/{{primaryKey}}/', $this->primaryKey, $template);
        $template = preg_replace('/{{hasMany}}/', $this->hasMany, $template);
        $template = preg_replace('/{{belongsTo}}/', $this->belongsTo, $template);

        return $template;
    }
}
