<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model{
    protected $table = 'colaboradores';
    protected $fillable=[
        'pessoas_fisica_id','centro_custo_id','funcao_id'
    ];
}