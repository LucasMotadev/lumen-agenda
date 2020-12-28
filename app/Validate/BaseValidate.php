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
            'regex' => 'O campo :attribute não é valido',
            'in' => 'O campo :attribute é invalido',
            'min' => 'O campo :attribute de ter no minimo :min caracteres',
            'max' => 'O campo :attribute de ter no minimo :max caracteres'

        ];
    }

    protected function regexEmail(){

        return 'regex:' . $this->regex->email('defalt')->get('im');

    }

}