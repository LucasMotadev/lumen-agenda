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
        $this->validate($this->request,
            [
                'path' => 'required',
            ]);

        $created = new CreateModels();
        $created->createdModelValidate($table, $this->request->path);
    }
}
