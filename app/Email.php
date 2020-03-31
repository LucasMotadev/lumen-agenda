<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Email extends Model{
    protected $table = 'emails';
    protected $fillable = [
        'pessoa_id','email','ddd'
    ];
}