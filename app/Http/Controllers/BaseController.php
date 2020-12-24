<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

abstract class  BaseController  extends  Controller
{

    public $model;
    public $request;

    public function __construct(Request $request, $model)
    {
        $this->request = $request;
        $this->model =  $model;
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
}
