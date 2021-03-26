<?php
/*
|--------------------------------------------------------------------------
| Gerado altomaticamente  by Lucas Mota
|--------------------------------------------------------------------------
|
*/
namespace App\Http\Controllers\Company;

use App\Http\Controllers\BaseController;
use App\Model\Company\Empresas;
use Illuminate\Http\Request;

class EmpresasController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request, new Empresas());
    }
}
