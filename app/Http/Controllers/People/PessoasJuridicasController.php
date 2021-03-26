<?php
/*
|--------------------------------------------------------------------------
| Gerado altomaticamente  by Lucas Mota
|--------------------------------------------------------------------------
|
*/
namespace App\Http\Controllers\People;

use App\Http\Controllers\BaseController;
use App\Model\People\PessoasJuridicas;
use Illuminate\Http\Request;

class PessoasJuridicasController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request, new PessoasJuridicas());
    }
}
