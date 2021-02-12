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
    protected  $arrStringClass  = [];

    public function __construct(ImodelValidate $modelValidate, string $relativePath)
    {
       $this->modelValidate = $modelValidate; 
       $this->relativePath = $relativePath;
    }

    public function setTable(string $table)
    {
        $this->table = strtolower($table);
    }

    public function setFillable(array $column)
    {
        $this->fillable =  "'" .  strtolower(implode("','", $column)) . "'";
    }

    public function setPrimaryKey(string $column)
    {
        $this->primaryKey = strtolower($column);
    }

    // um para muitos ou passar o parametro where  , um use pode ter varios telefones
    public function setHasMany(array $hasMany)
    {
        foreach ($hasMany as $key => $value) {

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
    public function setBelongsTo(array $belongsTo)
    {
        foreach ($belongsTo as $key => $value) {

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
        foreach ($this->modelValidate->get() as $table => $value) {
            $this->namespace = $this->filePathToNamesape($this->relativePath);
            $this->classNameModel = $this->snakeCaseToPascalCase($table);
            $this->filename = base_path($this->relativePath) . "/{$this->classNameModel}.php";
            $this->setTable($table);
            $this->setFillable($value['fillable']);
            $this->setPrimaryKey($value['primaryKey']);
            $this->setHasMany($value['hasMany']);
            $this->setBelongsTo($value['belongsTo']);
            array_push($this->arrStringClass, ['class'=>$this->buildTemplate(), 'filename'=> $this->filename]);
            // $this->createFile($this->filename, $this->getClass());
            $this->destroy();
        }

        return $this;
    }

    public function getArrStringClass(): array
    {
        return $this->arrStringClass;
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

    public function destroy()
    {
        $this->table = '';
        $this->fillable = '';
        $this->primaryKey = '';
        $this->hasMany = '';
        $this->belongsTo = '';
        $this->filename = '';
        $this->namespace = '';
    }
}
