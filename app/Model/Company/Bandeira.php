<?php

/*
|--------------------------------------------------------------------------
| Gerado altomaticamente  by Lucas Mota
|--------------------------------------------------------------------------
|
*/

namespace App\Model\Company;

use App\Model\BaseModel;

class Bandeira extends BaseModel
{

    protected $table = "bandeira";

    protected $fillabe = ['id','descricao'];

    protected $primaryKey = "id";


    

        
    public function empresas()
    {
        return $this->belongsTo(Empresas::class, 'bandeira_id', 'id');
    }
}

