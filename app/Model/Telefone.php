<?php
namespace App\Model;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model{
    protected $table = 'telefones';
    protected $fillable = [
        'pessoa_id','numero'
    ];

    public function setNumeroAttribute($value){

        $numero = preg_replace('/\W/', '', $value);
        if( strlen($numero) != 11 && strlen($numero) != 10 ) throw new Exception('Telefone invalido!');
        $this->attributes['numero'] = $numero;

        
    }
}