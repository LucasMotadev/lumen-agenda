<?php

namespace App\Construct;

class Model extends Utils
{
    public $table = '';
    public $fillabe = '';
    public $primaryKey = '';
    public $timestamps = '';
    public $hasMany = '';
    public $belongsTo = '';
    public $functionPk;



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

    public function setFunctionPk(){
        $this->functionPk = 'public function setPrimaryKey()
            { 
                return $this->primaryKey;
            }';
    }

    public function setTimesTemp(string $column)
    {
        if ($column != 'created_at' || $column != 'updated_at') $this->timestamps = 'public $timestamps = "false"';
    }

    // um para muitos ou passar o parametro where  , um use pode ter varios telefones
    public function setHasMany(string $table, string $namespace , string $columnLocal, string $columnPai)
    {
        $this->hasMany .= 'public function ' . $this->methodToCamelcase($table)  . '()
            {
                return $this->hasMany("'.$namespace.'", "' . strtolower($columnLocal) . '","' . strtolower($columnPai) . '");
            }
                          
        ';
    }


    // um para um ou um para muitos inverso, acessar o dono do telefone
    public function setBelongsTo(string $table, string $namespace , string $columnLocal, string $columnPai)
    {

        $this->belongsTo .= 'public function ' . $this->methodToCamelcase($table)  . '()
            {
                return $this->belongsTo("'.$namespace.'", "' . strtolower($columnLocal) . '","' . strtolower($columnPai) . '");
            }
                          
        ';
    }

    public function getClass(string $namespace, string $nameClass){

        return "<?php
        namespace $namespace;

        use Illuminate\Database\Eloquent\Model;

        class {$this->classToCamelcase($nameClass)} extends Model 
        {

            {$this->table}
    
            {$this->fillabe}
    
            {$this->primaryKey}

            {$this->functionPk}
    
            {$this->hasMany}
    
            {$this->belongsTo}
                   
        }
        
        ";

    }

    public function destroy(){
        
         $this->table = '';
         $this->fillabe = '';
         $this->primaryKey = '';
         $this->timestamps = '';
         $this->hasMany = '';
         $this->belongsTo = '';
         $this->functionPk = '';

    }

}
