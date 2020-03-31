<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Empresas extends Model{
    protected $table = 'empresas';
    protected $fillable = [
        'pessoas_juridica_id', 'apelido','matriz_id'
    ];
}