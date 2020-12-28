<?php

namespace App\Http\Controllers;

use App\Policies\IPolicy;
use App\Utils\Regex;
use App\Validate\IValidate;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller;

abstract class  BaseController  extends  Controller
{

    public $model;
    public $request;

    public function __construct(Request $request, $model, IValidate $validate = null, IPolicy $policy = null)
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
            $arrQueryString = $this->request->all();
            $recurso = $this->model::select('*');

            // retorna apenas colunas informadas.
            if (
                isset($arrQueryString['column'])  &&
                !empty($arrQueryString['column']) &&
                is_array($arrQueryString['column'])
            ) {
                $recurso->select($arrQueryString['column']);
            }
            // fim retorna apenas colunas informadas.

            // queryString to eloquent
            if (!empty($arrQueryString)) {

                $recurso =  $this->queryStringToElequente($arrQueryString, $recurso);
            }


            return response()->json($recurso->paginate(), 200);
        } catch (\Exception $e) {
            return $this->responseError($e, 'Erro ao consultar dados');
        }
    }

    public function store()
    {
        try {

            //validação
            if (!empty($this->validate)) {
                $rules = $this->validate->getCreateRules();
                $messagens = $this->validate->messagens();

                $validate = Validator::make($this->request->all(), $rules, $messagens);
                if ($validate->fails()) return $validate->errors();
            }
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
            if (!empty($this->validate)) {
                $rules = $this->validate->getUpdateRules($id);
                $messagens = $this->validate->messagens();
                $validate = Validator::make($this->request->all(), $rules, $messagens);
                if ($validate->fails()) return $validate->errors();
            }

            // fim validação formulario
            $recuso = $this->model::find($id);

            if (empty($recuso)) {
                return response()->json(['error' => 'Recurso nao encontrado'], 401);
            }


            // policiticas 
            if (!empty($this->policy)) {
                if (!($this->policy->authorize('update', $recuso))) {
                    return response()->json(['error' => 'Usuario não autorizado'], 403);
                }
            }

            $response = $recuso->update($this->request->all());

            return response()->json($response, 204);
        } catch (\Exception $e) {
            return $this->responseError($e, 'Erro ao alterar dados');
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

    protected function queryStringToElequente(array $arrQueryString, $model)
    {

        $valuesInKeys = array_fill_keys($this->model->getFillable(), '1');
        $arr = array_intersect_key($arrQueryString, $valuesInKeys);

        $regex =  new Regex();
        $regexDate = $regex->date()->get('i');

        foreach ($arr as $key => $value) {

            if (is_array($value)) { // is array

                $exist0 = array_key_exists(0, $value);
                $exist1 = array_key_exists(1, $value);

                if ($exist0 && $exist1) { // O array possui duas posição
                    $date0 = preg_match($regexDate, $value[0]);
                    $date1 = preg_match($regexDate, $value[1]);

                    if ($date0 && $date1) { // as posição são datas

                        if (strtotime($value[0]) > strtotime($value[1])) { // a data meno primeiro
                            $aux = $value[1];
                            $value[1] = $value[0];
                            $value[0] = $aux;
                        }

                        $model->whereBetWeen($key, $value);
                    } else { // as posição são datas

                        $model->whereIn($key, $value);
                    }
                } else { // O array possui duas posição

                    $model->whereIn($key, $value);
                }
            } else { // is array
                $model->where($key, $value);
            }
        } // fim for

        return $model;
    }
}
