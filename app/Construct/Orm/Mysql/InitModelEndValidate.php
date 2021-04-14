<?php

namespace App\Construct\Orm\Mysql;

use App\Construct\Model\Columns;


class InitModelEndValidate
{
    public $table;
    
    public function __construct(string $table)
    {
        $this->table = $table;
        $this->init();
    }

    public function init()
    {
        $columns = Columns::featColumnsAndTypeTable($this->table);
        if(empty($columns)) exit('Table not exist');

        $validate = new ConstructValidate();
        $primaryKey = new ConstructPrimaryKey();
        $fillable = new ConstructFillable();
        $belongsTo = new ConstructBelongsTo();
        $hasMany = new ConstructHasMany();

        foreach ($columns as $value) {
            $validate->convert($value);
            $primaryKey->convert($value);
            $fillable->convert($value);
            $belongsTo->convert($value);
            $hasMany->convert($value);
        }

        $this->validate = $validate->get();
        $this->primaryKey = $primaryKey->get();
        $this->fillable = $fillable->get();
        $this->belongsTo = $belongsTo->get();
        $this->hasMany = $hasMany->get();
    }
}
