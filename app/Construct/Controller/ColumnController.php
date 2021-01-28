<?php

namespace App\Construct\Controller;

use App\Construct\Model\Columns;
use Illuminate\Http\Request;

class ColumnController extends BaseController {
    public function __construct(Request $request)
    {
        parent::__construct($request, new Columns());
    }

    
}