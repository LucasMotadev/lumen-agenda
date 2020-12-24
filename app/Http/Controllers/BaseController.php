<?php

namespace App\Http\Controllers;

use App\Policies\Policy\IPolicy;
use App\Validate\IValidate;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

abstract class  BaseController  extends  Controller
{

    public $model;
    public $request;

    public function __construct(Request $request, $model, IValidate $validate = null, array $policy = null )
    {
        $this->request = $request;
        $this->model =  $model;
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
        $this->checkPolicy('index');
        return response()->json($this->model::all(), 200);
    }

    public function store()
    {
        try {

            return  response()->json($this->model::create($this->request->all()), 201);
    
        } catch (\Exception $e) {
            return  response()->json(['error' => 'Erro ao persistir dados'], 400);
        }
    }

    public function update($id)
    {
        try {
            $this->model::find($id);

        } catch (\Exception $e) {
            return  response()->json(['error' => 'Erro ao atualizar dados'], 400);
        }
    }

    public function checkPolicy($method){

        if(is_array($this->policy[$method])){
            foreach ($this->policy[$method]  as $policy) {
                $policy->check($this->request);
            }

            return;
        }

        $this->policy[$method]->check($this->request);

    }
}
