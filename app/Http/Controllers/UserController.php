<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Policies\User\UserPolicy;
use App\User;
use App\Validate\UserValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{

    public function __construct(Request $request)
    {
        $policy = [
            'index' => new UserPolicy()
        ];

        parent::__construct($request, new User(), new UserValidate(), $policy);
    }

}
