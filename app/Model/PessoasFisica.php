<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class PessoasFisica extends Model{

    protected $fillable = [
        'pessoa_id','rg','sexo'
    ];

       
}