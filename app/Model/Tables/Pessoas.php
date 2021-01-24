<?php

namespace App\Model\Tables;

use Illuminate\Database\Eloquent\Model;

class Pessoas extends Model
{

    protected $table = "pessoas";

    protected $fillabe = ["id", "tipo_pessoa_id", "created_at", "updated_at", "codigo"];

    protected $primaryKey = "";



    public function tiposPessoas()
    {
        return $this->hasMany("tiposPessoas::class", "id", "tipo_pessoa_id");
    }
}
