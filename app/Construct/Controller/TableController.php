<?php

namespace App\Construct\Controller;

use App\Construct\Model\Tables;
use App\Construct\Orm\Orm;
use Illuminate\Http\Request;

class TableController extends BaseController
{

    public function __construct(Request $request)
    {
        parent::__construct($request, new Tables());
    }

    public function createdResouce()
    {
        $this->validate(
            $this->request,
            [
                'table' => 'required',
                'pathModel' => 'required',
            ]
        );

       $orm = new Orm($this->request->table);
       $mysql = $orm->mysql();

       $arrContruct['model'] = $mysql
       ->getClassModel($this->request->pathModel);

       return response()->json($arrContruct);
    }
}
