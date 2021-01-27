<?php

namespace App\Model;

use App\Model\BaseModel;

class Empresas extends BaseModel
{

    protected $table = "empresas";

    protected $fillabe = ['id', 'pessoa_juridica_id', 'apelido', 'created_at', 'updated_at', 'bandeira_id'];

    protected $primaryKey = "id";


    public function pessoasJuridicas()
    {
        return $this->hasMany(PessoasJuridicas::class, 'id', 'pessoa_juridica_id');
    }
    public function bandeira()
    {
        return $this->hasMany(Bandeira::class, 'id', 'bandeira_id');
    }


    public function centroCustos()
    {
        return $this->belongsTo(CentroCustos::class, 'empresa_id', 'id');
    }
}
