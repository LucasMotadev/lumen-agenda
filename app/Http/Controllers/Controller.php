<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{

    private $class;

    public function __construct($model)
    {   
        $this->class = new $model();
    }

    public function show($id){
    
      $response = $this->class::where($this->class->getPrimaryKey(), $id)->get();
      return response()->json($response , 200);

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
