<?php

namespace App\Construct\Files;

class ModelFile extends BaseFile implements IFile
{
    private $table = '';
    private $fillabe = '';
    private $primaryKey = '';
    private $timestamps = '';
    private $hasMany = '';
    private $belongsTo = '';

    public function setTable(string $table)
    {
        $this->table = 'protected $table = "' .  strtolower($table) . '";';
    }

    public function setFillable(array $column)
    {
        $this->fillabe =  'protected $fillabe = ["' . strtolower(implode('","', $column)) . '"];';
    }

    public function setPrimaryKey(string $column)
    {

        $this->primaryKey = 'protected $primaryKey = "' . strtolower($column) . '";';
    }


    public function setTimesTemp(string $column)
    {
        if ($column != 'created_at' || $column != 'updated_at') $this->timestamps = 'public $timestamps = "false"';
    }

    // um para muitos ou passar o parametro where  , um use pode ter varios telefones
    public function setHasMany(array $hasMany)
    {
        foreach ($hasMany as $key => $value) {

            $this->hasMany .= 'public function ' . $this->methodToCamelcase($value['table'])  . '()
            {
                return $this->hasMany(' . $this->classToCamelcase($value['table']) . '::class, "' . strtolower($value['local_key']) . '","' . strtolower($value['foreign_key']) . '");
            }
                          
        ';
        }
    }

    // um para um ou um para muitos inverso, acessar o dono do telefone
    public function setBelongsTo(array $belongsTo)
    {
        foreach ($belongsTo as $key => $value) {

            $this->hasMany .= 'public function ' . $this->methodToCamelcase($value['table'])  . '()
            {
                return $this->belongsTo(' . $this->classToCamelcase($value['table']) . '::class, "' . strtolower($value['local_key']) . '","' . strtolower($value['foreign_key']) . '");
            }
                          
        ';
        }
    }

    public function setClass(array $modelsTabels, string $namespace)
    {




        foreach ($modelsTabels as $table => $value) {
            $this->namespace = $this->filePathToNamesape($namespace);
            $this->nameClass = $this->classToCamelcase($table);
            $this->filename = base_path($namespace) . "/{$this->nameClass}.php";
            $this->setTable($table);
            $this->setFillable($value['fillable']);
            $this->setPrimaryKey($value['primaryKey']);
            $this->setHasMany($value['hasMany']);
            $this->setBelongsTo($value['belongsTo']);

            $this->createFile($this->filename, $this->getClass());
            $this->destroy();
        }
    }

    public function getClass(): string
    {

        return "<?php
        
namespace {$this->namespace};

use Illuminate\Database\Eloquent\Model;

class {$this->nameClass} extends Model 
{

    {$this->table}
    
    {$this->fillabe}
    
    {$this->primaryKey}


    
    {$this->hasMany}
    
    {$this->belongsTo}
                   
}
        
";
    }

    public function destroy()
    {

        $this->table = '';
        $this->fillabe = '';
        $this->primaryKey = '';
        $this->timestamps = '';
        $this->hasMany = '';
        $this->belongsTo = '';
        $this->filename = '';
        $this->namespace = '';
    }
}
