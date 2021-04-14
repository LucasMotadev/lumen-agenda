<?php

/*
|--------------------------------------------------------------------------
| Gerado altomaticamente por engenharia reversa by @Lucas Mota
|--------------------------------------------------------------------------
|
*/

namespace App\Model\Empresa;

use App\Model\BaseModel;
use App\User;

class Empresas extends BaseModel
{

    protected $table = "empresas";

    protected $fillable = ['id','pessoa_juridica_id','apelido','created_at','updated_at','marca_id','bandeira_id'];

    protected $primaryKey = "id";

    public $timestamps = false;
   
    public function pessoasJuridicas()
    {
        return $this->hasMany(PessoasJuridicas::class, 'id', 'pessoa_juridica_id');
    }
    
    public function marcas()
    {
        return $this->hasMany(Marcas::class, 'id', 'marca_id');
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

