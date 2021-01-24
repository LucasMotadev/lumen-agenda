<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{

    protected $table = "empresas";

    protected $fillabe = ["id", "pessoa_juridica_id", "apelido", "created_at", "updated_at", "bandeira_id"];

    protected $primaryKey = "id";



    public function pessoasJuridicas()
    {
        return $this->hasMany("pessoasJuridicas::class", "id", "pessoa_juridica_id");
    }

    public function bandeira()
    {
        return $this->hasMany("bandeira::class", "id", "bandeira_id");
    }
}
