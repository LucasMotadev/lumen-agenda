<?php

namespace App\Construct\Controller;

use App\Policies\IPolicy;
use App\Utils\Regex;
use App\Validate\IValidate;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        try {
            $arrQueryString = $this->request->all();
            $recurso = $this->model::select('*')->where('table_schema', env('DB_DATABASE_MYSQL'));

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
