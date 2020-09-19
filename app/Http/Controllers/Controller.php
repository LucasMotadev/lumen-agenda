<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    private $id;
    private $class;

    public function __construct($model)
    {   
        $this->id = $model->primaryKey;
        $this->class = $model->class;
    }


    public function show(){
        return $this->class::all();
    }
}
