<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request, new User());
    }
}
