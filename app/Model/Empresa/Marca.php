<?php

/*
|--------------------------------------------------------------------------
| Gerado altomaticamente por engenharia reversa by @Lucas Mota
|--------------------------------------------------------------------------
|
*/

namespace App\Model\Empresa;

use App\Model\BaseModel;

class Marcas extends BaseModel
{

    protected $table = "marcas";

    protected $fillable = ['id','descricao'];

    protected $primaryKey = "id";

    public $timestamps = false;

    public function empresas()
    {
        return $this->belongsTo(Empresas::class, 'marca_id', 'id');
    }    
    public function produtos()
    {
        return $this->belongsTo(Produtos::class, 'marca_id', 'id');
    }
}

