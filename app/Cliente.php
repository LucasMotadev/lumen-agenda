<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model{

    protected $fillable = [
        'pessoa_id','limite_credito'
    ];   
    
    public function pessoa(){
        $this->hasOne(Pessoa::class);
    }
}