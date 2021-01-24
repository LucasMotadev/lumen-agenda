<?php

namespace App\Model;


use Exception;


class Pessoa extends BaseModel
{

    protected $fillable = [
        'tipo_pessoa_id','codigo', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'id';

    public function setCodigoAttribute($value){
        
        $value = preg_replace('/D/', '', $value);

        $count = strlen($value);

        if($count == 11)  $this->attributes['tipo_pessoa_id'] = 1;

        if($count == 14)  $this->attributes['tipo_pessoa_id'] = 2;

        $this->attributes['codigo'] = $value;
        
    }
}
