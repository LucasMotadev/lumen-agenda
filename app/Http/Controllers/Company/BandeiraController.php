<?php
/*
|--------------------------------------------------------------------------
| Gerado altomaticamente  by Lucas Mota
|--------------------------------------------------------------------------
|
*/
namespace App\Http\Controllers\Company;

use App\Http\Controllers\BaseController;
use App\Model\Company\Bandeira;
use Illuminate\Http\Request;

class BandeiraController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request, new Bandeira());
    }
}
