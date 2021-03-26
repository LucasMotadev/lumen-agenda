<?php

namespace App\Http\Controllers;

use App\Construct\Model\BaseModel;
use App\Model\IModel;
use App\Policies\IPolicy;
use App\Utils\Regex;
use App\Validate\IValidate;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller;

abstract class  BaseController  extends  Controller
{

    public $model;
    public $request;

    public function __construct(Request $request,Model $model, IPolicy $policy = null)
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
        try {
            $resource = $this->model->queryStringToElequente($this->request);
            return response()->json($resource->paginate(), 200);
        } catch (\Exception $e) {
            return $this->responseError($e, 'Erro ao consultar dados');
        }
    }

    public function store()
    {
        try {
            //validação
            $rules = $this->model->getCreateRules();

            $validate = Validator::make($this->request->all(), $rules);
            if ($validate->fails()) return response()->json($validate->errors(), 422);
            // fim validação

            return  response()->json($this->model::create($this->request->all()), 201);
        } catch (\Exception $e) {
            return $this->responseError($e, 'Erro ao persistir dados');
        }
    }

    public function update($id)
    {
        try {
            //validação formulario

            $rules = $this->model->getUpdateRules($id);
            $validate = Validator::make($this->request->all(), $rules);
            if ($validate->fails()) return $validate->errors();


            // fim validação formulario
            $recuso = $this->model::find($id);

            if (empty($recuso)) {
                return response()->json(['error' => 'Recurso nao encontrado'], 401);
            }

            $response = $recuso->update($this->request->all());

            return response()->json($response, 204);
        } catch (\Exception $e) {
            return $this->responseError($e, 'Erro ao alterar dados');
        }
    }

    public function destroy($id)
    {
        try {

            $rules = $this->model->getDestroyRules();
            $validate = Validator::make([$this->model->getPrimaryKey() => $id], $rules);
            if ($validate->fails()) return $validate->errors();

            $resource = $this->model::find($id);
            if (is_null($resource)) {
                return response()->json(['Erro' => 'Recurso não encontrado'], 404);
            }
            return response()->json($resource->delete(), 204);
        } catch (\Exception $e) {
            return $this->responseError($e, 'Erro ao deletar');
        }
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
