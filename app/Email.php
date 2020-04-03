<?php
namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;


class Email extends Model{
    protected $table = 'emails';
    protected $fillable = [
        'pessoa_id','email','ddd'
    ];

    public function setEmailAttribute($value){
        if(empty($value)) throw new Exception('Email obrigatorio');
        $this->attributes['email'] = $value;
    }
}