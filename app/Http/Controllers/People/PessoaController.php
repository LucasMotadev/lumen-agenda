<?php

namespace App\Http\Controllers\People;

use App\Http\Controllers\BaseController;
use App\Model\People\Pessoa;
use App\Validate\People\PessoaValidate;
use Illuminate\Http\Request;

class PessoaController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request, new Pessoa());
    }
}
