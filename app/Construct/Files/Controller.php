<?php

namespace App\Construct\Files;


use Illuminate\Http\Client\Request;

class Controller {
    public function createControler(string $model = null)
    {
        
    }

    public function __contruct(Request $request)
    {
        parent::__contruct($request);
    }
}