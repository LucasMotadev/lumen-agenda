<?php

namespace App\Http\Controllers;

use App\Policies\Policy\IPolicy;
use App\Validate\IValidate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller;

abstract class  BaseController  extends  Controller
{

    public $model;
    public $request;

    public function __construct(Request $request, $model, IValidate $validate = null, array $policy = null)
    {

        $this->request = $request;
        $this->model =  $model;
        $this->validate = $validate;
        $this->policy = $policy;
        
    }

    public function show($id)
    {

        try {

            $response = $this->model::find($id);
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao retornar dados'], 400);
        }
    }

    public function index()
    {
        try {

            $this->checkPolicy('index');

            return response()->json($this->model::all(), 200);
        } catch (\Exception $e) {
            return $this->responseError($e, 'Erro ao consultar dados');
        }
    }

    public function store()
    {
        try {

            //validação de formulario
            $rules = $this->validate->getCreateRules() || [];
            $messagens = $this->validate->messagens() || [];

            $validate = Validator::make($this->request->all(), $rules, $messagens);
            if ($validate->fails()) return $validate->errors();
            // fim validação
        
            return  response()->json($this->model::create($this->request->all()), 201);
        } catch (\Exception $e) {
            return $this->responseError($e, 'Erro ao persistir dados');
        }
    }

    public function update($id)
    {
        try {
            $data = $this->model::find($id);
        
        } catch (\Exception $e) {
            return  response()->json(['error' => 'Erro ao atualizar dados'], 400);
        }
    }

    public function checkPolicy($method)
    {

        if (is_array($this->policy[$method])) {
            foreach ($this->policy[$method]  as $policy) {
                $policy->check($this->request);
            }

            return;
        }

        $this->policy[$method]->check($this->request);
    }

    public function responseError(Exception $e, string $message)
    {
        if (env('APP_ENV', 'local') == 'local') {
            return response()->json([
                'error' => $e->getMessage(),
                'file'  => $e->getFile(),
                'line'  => $e->getLine()
            ], 400);
        }

        return response()->json(['error' => $message], 400);
    }
}
