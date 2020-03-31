<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class PessoasFisica extends Model{

    protected $fillable = [
        'pessoa_id','rg','data_nascimento','sexo'
    ];

       
}