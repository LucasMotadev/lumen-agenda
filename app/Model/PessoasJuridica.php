<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class PessoasJuridica extends Model{

    protected $fillable=[
        'pessoa_id','nome_fantasia'
    ];
}