<?php

/*
|--------------------------------------------------------------------------
| Gerado altomaticamente  by Lucas Mota
|--------------------------------------------------------------------------
|
*/

namespace App\Model\People;

use App\Model\BaseModel;
use App\Validate\People\PessoasJuridicasValidate;

class PessoasJuridicas extends BaseModel
{
    use PessoasJuridicasValidate;
    protected $table = "pessoas_juridicas";

    protected $fillable = ['id','pessoa_id','razao_social','inscricao_estadual','nome_fantazia','status_id','created_at','updated_at'];

    protected $primaryKey = "id";

    public $timestamps = false;

        
    public function pessoas()
    {
        return $this->hasMany(Pessoas::class, 'id', 'pessoa_id');
    }

    public function empresas()
    {
        return $this->belongsTo(Empresas::class, 'pessoa_juridica_id', 'id');
    }
}

