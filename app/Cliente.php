<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model{

    protected $fillable = [
        'pessoa_id','limite_credito'
    ];

       
}