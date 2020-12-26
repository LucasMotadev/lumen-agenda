<?php

namespace App\Model;

use Exception;


class Pessoa extends BaseModel
{

    protected $fillable = [
        'id', 'codigo', 'tipo_pessoa_id'
    ];
    protected $primaryKey = 'id';


}
