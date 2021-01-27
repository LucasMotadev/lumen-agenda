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
        return $this->hasMany(PessoasJuridicas::class, "id", "pessoa_juridica_id");
    }

    public function bandeira()
    {
        return $this->hasMany(Bandeira::class, "id", "bandeira_id");
    }
}
