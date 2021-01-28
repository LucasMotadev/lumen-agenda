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

                //'table' => 'required',
                'pathModel' => 'required',
                'pathValidate' => 'required',
                'pathController' => 'required'
            ]
        );

       $orm = new Orm($this->request->table);
       $arrModelValidateController['model'] = $orm->mysql()
       ->getClassModel($this->request->pathModel);

       $arrModelValidateController['controller'] = $orm->mysql()
       ->getClassController(
            $this->request->pathController, 
            $this->request->pathModel, 
            $this->request->pathValidate
        );
       return response()->json($arrModelValidateController);
    }
}
