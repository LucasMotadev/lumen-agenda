<?php
/*
|--------------------------------------------------------------------------
| Gerado altomaticamente  by Lucas Mota
|--------------------------------------------------------------------------
|
*/
namespace App\Http\Controllers\People;

use App\Http\Controllers\BaseController;
use App\Model\People\PessoasFisicas;
use App\Validate\People\PessoasFisicasValidate;
use Illuminate\Http\Request;

class PessoasFisicasController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request, new PessoasFisicas(), new PessoasFisicasValidate());
    }
}
