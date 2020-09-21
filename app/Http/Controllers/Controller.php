<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{

    private $class;

    public function __construct($model)
    {   
        $this->class = $model;
    }

    public function show($id){
        
        return response()->json($this->class::find($id), 200);

    }

    public function showAll(){
        return response()->json($this->class::all(), 200);
    }

    public function create($request = []){
        return $this->class::create($request);
    }

    public function update($id, $request = []){
         $model = $this->show($id)
          ->update($request);

          return $model;
    }
}
