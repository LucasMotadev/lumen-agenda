<?php

namespace App\Model\Tables;

use Illuminate\Database\Eloquent\Model;

class PessoasFisicas extends Model
{

    protected $table = "pessoas_fisicas";

    protected $fillabe = ["id", "cpf", "rg", "nome", "sexo", "created_at", "updated_at", "pessoa_id", "data_nascimento"];

    protected $primaryKey = "";



    public function pessoas()
    {
        return $this->hasMany("pessoas::class", "id", "pessoa_id");
    }
}
