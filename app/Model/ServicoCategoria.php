<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class ServicoCategoria extends Model{
    protected $table = 'servicos_categorias';
    protected $fillable = [
        'descricao'
    ];
}