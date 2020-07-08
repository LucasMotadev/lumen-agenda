<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Funcao extends Model{
    protected $table = 'funcoes';
    protected $fillable = [
        'descricao'
    ];
}