<?php

namespace App\Policies\User;

use App\Policies\IPolicy;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserPolicy implements IPolicy{

    public function check($request){

        dd(Auth::user());
    }

}