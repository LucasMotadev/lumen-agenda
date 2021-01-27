<?php

namespace App\Construct\Controller;

use App\Construct\Created\CreateModels;
use App\Construct\Model\Tables;
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
                'pathValidate' => 'required',
                'pathController' => 'required'
            ]
        );

        $created = new CreateModels();
        $created->createdModelValidate($this->request);
    }

    public function createdsResouces()
    {
        try {
            $this->validate(
                $this->request,
                [
                    'path' => 'required',
                ]
            );

            $created = new CreateModels();
            $classCreated =  $created->createdModelValidate($this->request->path);

            return response()->json($classCreated, 201);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            );
        }
    }

    public function getModelValidate($table)
    {

        try {

            $created = new CreateModels();
            $jsonModel =  $created->getModelValidate($table);

            return response()->json($jsonModel, 201);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            );
        }
    }
}
