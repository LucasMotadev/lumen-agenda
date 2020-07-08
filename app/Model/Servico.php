<?php
namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator ;

class Servico extends Model{
    protected $table = 'servicos';
    protected $fillable = [
        'descricao','tempo_execulcao','tempo_ocioso','valor','categoria_id'
    ];

    public function servicoCategoria(){
        $this->hasOne(ServicoCategoria::class, 'categoria_id','id');
    }


}