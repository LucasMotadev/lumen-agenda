<?php

/*
|--------------------------------------------------------------------------
| Gerado altomaticamente  by Lucas Mota
|--------------------------------------------------------------------------
|
*/

namespace App\Model\People;

use App\Model\BaseModel;
use App\Validate\People\TiposPessoasValidate;

class TiposPessoas extends BaseModel
{
    use TiposPessoasValidate;

    protected $table = "tipos_pessoas";

    protected $fillable = ['id','descricao'];

    protected $primaryKey = "id";

    public $timestamps = false;

        
    public function pessoas()
    {
        return $this->belongsTo(Pessoas::class, 'tipo_pessoa_id', 'id');
    }
}

