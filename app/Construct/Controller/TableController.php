<?php

namespace App\Construct\Controller;

use App\Construct\Model\Tables;
use App\Construct\Orm\Orm;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class TableController extends Controller
{
    public function createdResouce(Request $request)
    {
        $this->validate(
            $request,
            [
                'table' => 'required',
                'pathModel' => 'required',
            ]
        );

       $orm = new Orm($request->table);
       $mysql = $orm->mysql();

       $arrContruct['model'] = $mysql
       ->getClassModel($request->pathModel);

       return response()->json($arrContruct);
    }
}
