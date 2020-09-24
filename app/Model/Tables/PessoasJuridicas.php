<?php

namespace App\Model\Tables;

use Illuminate\Database\Eloquent\Model;

class PessoasJuridicas extends Model
{

    protected $table = "pessoas_juridicas";

    protected $fillabe = ["id", "pessoa_id", "razao_social", "cnpj", "inscricao_estadual", "nome_fantazia", "status_id", "created_at", "updated_at"];

    protected $primaryKey = "id";



    public function setPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function empresas()
    {
        return $this->hasMany("App\Models\Tables", "pessoa_juridica_id", "id");
    }



    public function pessoas()
    {
        return $this->belongsTo("App\Model\Tabels", "pessoa_id", "id");
    }
}
