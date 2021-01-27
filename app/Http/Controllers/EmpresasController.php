<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Model\Empresas;
use App\Validate\EmpresasValidate;
use Illuminate\Http\Request;

class EmpresasController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request, new Empresas(), new EmpresasValidate());
    }
}
