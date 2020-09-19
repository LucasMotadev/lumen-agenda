<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model{
    protected $table = 'agendamentos';
    protected $fillable = [
        'servico_id',
        'cliente_id',
        'colaborador_id',
        'agendamentos_status_id',
        'descricao',
        'data_marcada',
        'data_inico',
        'data_termino'
    ];
}