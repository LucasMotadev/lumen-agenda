<?php

namespace App\Model;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{

    protected $fillable = [
        'id', 'codigo', 'tipo_pessoa_id'
    ];
    protected $primaryKey = 'id';

    public function getPrimaryKey(){
        return $this->primaryKey;
    }

}
