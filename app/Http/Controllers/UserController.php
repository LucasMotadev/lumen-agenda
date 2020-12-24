<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Policies\User\UserPolicy;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{

    public function __construct(Request $request)
    {
        $policy = [
            'index' => new UserPolicy()
        ];

        parent::__construct($request, new User(), null, $policy);
    }

    public function store()
    {
        try {

            $this->model->email = $this->request->email;
            $this->model->password = Hash::make($this->request->password);
            $this->model->apelido = $this->request->apelido;
            $reponse = $this->model->save();

            return response()->json(['success' => $reponse], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao persistir dados',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
