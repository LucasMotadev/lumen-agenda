<?php

namespace App\Http\Controllers\Pessoas;

use App\Http\Controllers\BaseController;
use App\Model\Pessoa;
use App\Policies\PessoaPolicy;
use App\Validate\PessoaValidate;
use Illuminate\Http\Request;

class PessoaController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request, new Pessoa(), new PessoaValidate(), new PessoaPolicy);
    }
}
