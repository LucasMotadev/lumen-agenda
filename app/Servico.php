<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model{
    protected $table = 'servicos';
    protected $fillable = [
        'descricao','tempo_execulcao','tempo_ocioso','valor','categoria_id'
    ];
}