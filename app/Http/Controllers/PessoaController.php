<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Model\Pessoa;
use App\Validate\PessoaValidate;
use Illuminate\Http\Request;

class PessoaController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request, new Pessoa(),new PessoaValidate());
    }

}
