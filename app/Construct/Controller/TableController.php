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

    public function createdResouce($table)
    {
        $this->validate(
            $this->request,
            [
                'path' => 'required',
            ]
        );

        $created = new CreateModels();
        $created->createdModelValidate($this->request->path, $table);
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
}
