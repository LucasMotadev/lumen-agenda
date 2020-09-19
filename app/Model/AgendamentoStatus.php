<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class AgendamentoStatus extends Model{
    protected $table = 'agendamentos_status';
    protected $fillable = [
        'descricao'
    ];
}