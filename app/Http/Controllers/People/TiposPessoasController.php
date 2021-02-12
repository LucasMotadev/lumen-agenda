<?php
/*
|--------------------------------------------------------------------------
| Gerado altomaticamente  by Lucas Mota
|--------------------------------------------------------------------------
|
*/
namespace App\Http\Controllers\People;

use App\Http\Controllers\BaseController;
use App\Model\People\TiposPessoas;
use App\Validate\People\TiposPessoasValidate;
use Illuminate\Http\Request;

class TiposPessoasController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request, new TiposPessoas(), new TiposPessoasValidate());
    }
}
