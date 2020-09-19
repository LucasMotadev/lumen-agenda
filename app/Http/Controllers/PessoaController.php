<?php

namespace App\Http\Controllers;

use App\Model\Pessoa;

class PessoaController extends Controller
{
    public function __construct()
    {
        parent::__construct(Pessoa::class);
    }
  
}
