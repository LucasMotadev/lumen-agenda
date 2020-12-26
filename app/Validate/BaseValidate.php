<?php

namespace App\Validate;

use App\Utils\Regex;

Class BaseValidate  {

    protected $regex;

    public function __construct()
    {
        $this->regex = $regex = new Regex();
    }

    public function messagens() {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'unique'   => 'O campo :attribute já existe',
            'regex' => 'O :attribute não é valido'
        ];
    }

    protected function regexEmail(){

        return 'regex:' . $this->regex->email('.com.br')->get('im');

    }

}