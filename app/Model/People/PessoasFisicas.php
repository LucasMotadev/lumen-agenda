<?php

/*
|--------------------------------------------------------------------------
| Gerado altomaticamente  by Lucas Mota
|--------------------------------------------------------------------------
|
*/

namespace App\Model\People;

use App\Model\BaseModel;

class PessoasFisicas extends BaseModel
{

    protected $table = "pessoas_fisicas";

    protected $fillable = ['id','rg','nome','sexo','created_at','updated_at','pessoa_id'];

    protected $primaryKey = "id";

    public $timestamps = false;


        
    public function pessoas()
    {
        return $this->hasMany(Pessoas::class, 'id', 'pessoa_id');
    }


        
    public function colaboradores()
    {
        return $this->belongsTo(Colaboradores::class, 'pessoa_fisica_id', 'id');
    }
}

