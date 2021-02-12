<?php

namespace App\Providers\Validate;

use App\Models\EmpresaFuncao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\NotIn;

class UniqueCompositeServiceProvider extends ServiceProvider
{
    private $request;

    public function boot(Request $request)
    {
        $this->request = $request->all();
        Validator::extend(
            'unique_composite',
            function ($attribute, $value, $parameters, $validator) {

                $model =  DB::table($parameters[0]);
                for ($i = 1; $i < count($parameters); $i++) {
                    $notIn =  preg_match('/\w+\s+!=\s+\w+/',$parameters[$i]);
                    if($notIn){
                        $columnValue = explode('!=',$parameters[$i]);
                        $model->where(trim($columnValue[0]), '<>', trim($columnValue[1]));
                        continue;
                    }
                    $model->where($parameters[$i], $this->request[$parameters[$i]]);
                }

                if ($model->count()) {
                    return false;
                }
                return true;
            },
            
        );
    }

    public function register()
    {
        //
    }
}
