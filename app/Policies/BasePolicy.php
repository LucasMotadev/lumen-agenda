<?php

namespace App\Policies;

use Illuminate\Support\Facades\Auth;

class BasePolicy {

    protected $auth;
    protected $classPolicy;

    public function __construct($classPolicy)
    {
        $this->auth = Auth::user();
        $this->classPolicy = $classPolicy;
    }

    public function authorize(string $method, $recurso){
        if(method_exists($this->classPolicy, $method)){
            $stringClass = $this->classPolicy;
            $class = new $stringClass();

             return $class->$method($recurso);
        }

        return false;

    }
}