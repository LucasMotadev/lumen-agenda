<?php

namespace App\Model\Tables;

use Illuminate\Database\Eloquent\Model;

class TiposPessoas extends Model
{

    protected $table = "tipos_pessoas";

    protected $fillabe = ["id", "descricao"];

    protected $primaryKey = "primary";



    public function setPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function pessoas()
    {
        return $this->hasMany("App\Models\Tables", "tipo_pessoa_id", "id");
    }
}
